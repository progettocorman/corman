<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Publication;
use App\UsersPublication;
use App\User;
use App\Notification;

class Api extends Controller
{
    //SI OCCUPA DI INVOCARE LE RESTFUL API DI dblp E PROCESSARE IL RISULTATO
    public function dblpApi(Request $request){
      //IMPOSTA LA RISORSA curl CON L'URL DA INTERROGARE
      // $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$name."%3A&format=json");
      $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$request->name."%3A&format=json");

      //IMPOSTA L'OPZIONE CURLOPT_RETURNTRANSFER A true IN MODO DA POTER CONSERVARE IL RISULTATO IN UNA VARIABILE
      //CON LA FUNZIONE curl_multi_getcontent();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      //ESEGUE LA RICHIESTA HTTP (GET DI DEFAULT) ATTRAVERSO LA RISORSA curl
      curl_exec($ch);
      //DECODIFICA IL RISULTATO JSON
      $jsonResult= json_decode(curl_multi_getcontent($ch));
      //SE L'UTENTE NON È PRESENTE IN dblp, RIPORTA MESSAGGIO
      if(!isset($jsonResult->result->hits->hit)){
        echo "L'utente non è presente il dblp";//TODO MESSAGGIO ERRORE
        return redirect('/');
      }
      //ESTRAE IN MODO APPROPRIATO I DATI DI INTERESSE DALLA VARIABILE
      //Array che contiene i nomi dei campi da utilizzare come chiavi(tranne authors, trattato separatamente);
      $fields = array("title",//titolo della pubblicazione
                    "venue",//rivista di pubblicazione
                    "volume",//volume della rivista
                    "number",//numero della rivista
                    "pages",//pagine della rivista
                    "year",//anno di pubblicazione
                    "type",//tipo di pubblicazione
                    "key",//The key can also be found as the "key" attribute of the record in the record's XML export.(dal faq di dblp)
                    "doi",// id identificativo della pubblicazione (http://dblp.uni-trier.de/doi/)
                    "ee",// Link alla risorsa (pdf o sito su cui comprare il pdf)
                    "url");// Link alla pagina di dblp

      //CICLA SU TUTTE LE ISTANZE DI HIT CONTENUTE IN HITS (CONTENUTE IN RESULT)
      foreach ($jsonResult->result->hits->hit as $currentPub) {
          $currentPubId = Api::processPublication($request, $currentPub->info, $fields);

          if($currentPubId != -1){
            Api::processCoAuthors($request,$currentPub->info->authors->author,$currentPubId);
          }

      }
      //LIBERA LA RISORSA ALLOCATA
      curl_close($ch);
      // return redirect('/');
    }

    //SI OCCUPA DI PROCESSARE LE PUBBLICAZIONI
    public static function processPublication(Request $request, $publication, $fields){
      $user_name = Api::formatName($request->name);
      $publicationModel = new Publication;
      //PER OGNI CAMPO (descritto in $field)...
      foreach ($fields as $curField) {
        //... SE IL CAMPO, PER QUELLA ISTANZA, NON è NULLO, AVVALORA IL MODEL IL CORRISPONDENTE VALORE (no authors)
        if(isset($publication->$curField)){
            if(!is_array($publication->$curField)) $publicationModel->$curField ="'".substr($publication->$curField,0,189)."'";
            else{
              foreach ($publication->$curField as $innerValue) {
                $value = $innerValue." ";
              }
               $publicationModel->$curField = "'".substr($value,0,189)."'";
            }
        }
        else $publicationModel->$curField = "//";
      }

      $publicationModel->dbKey = md5($publicationModel->title.$publicationModel->year);

      //SE LA PUBBLICAZIONE È GIA' PRESENTE NEL DB, AGGIUNGILA ALL'UTENTE SENZA RE-INSERIRLA
      try{
        $publicationModel->save();
      }catch(QueryException $exception){
        //TODO Messaggio
        //Aggiungi pubblicazione all'autore
        $user_id = $request->session()->get('id');
        $publication_id = \DB::table('publications')->select('id')->where('dbKey',$publicationModel->dbKey)->first();

        Api::addPublicationToAuthor($request, $user_id, $publication_id->id ,$user_name);

        echo $publicationModel->title."è già presente <br>";//DEBUG
        return -1;
      }
      //...SE INVECE LA PUBBLICAZIONE NON È ANCORA PRESENTE NEL DB, VIENE INSERITA
      //Ritira l'id della Pubblicazione appena aggiunta al db
      $publication_id =  \DB::table('publications')->select('id')->orderBy('id','desc')->first();

      return $publication_id->id;
    }

    //PERMETTE DI AGGIUNGERE UNA PUBBLICAZIONE AD UN AUTORE
    public static function addPublicationToAuthor(Request $request, $user_id, $publication_id, $author){
      $user_publication = new UsersPublication;
      $user_publication->user_id = $user_id;
      $user_publication->publication_id = $publication_id;
      $user_publication->author_name = $author;
      $user_publication->searchable(); //Per la ricerca
      $user_publication->save();
    }

    //SI OCCUPA DI PROCESSARE I COAUTORI
    public static function processCoAuthors(Request $request, $authors, $publication_id){
      //FORMATTAZIONE DEL NOME
      $user_name = Api::formatName($request->name);
      $user_id = $request->session()->get('id');
      //TRATTAZIONE DELL'ARRAY DI AUTORI: SE E' UN ARRAY (più autori)...
      if(is_array($authors)){
        foreach ($authors as $author) {

          //ARRAY DI TUTTI GLI AUTORI, NON ANCORA TRATTATI
          $coAuthorsNotDone = array();
          array_push($coAuthorsNotDone,$author);

          //SE SE STESSO, PRENDI L'ID DALLA SESSIONE E AGGIUNGI LA PUBBLICAZIONE ALL'AUTORE
          if($user_name == $author){
            // $user_id = 1;//For testing <-->Maria Francesca Costabile
            Api::addPublicationToAuthor($request,$user_id, $publication_id,$user_name);
          }

          //...ALTRIMENTI PRENDI GLI ID DEI POSSIBILI COAUTORI
          else{

            /////////////////////////////////////////////////////////////////////////////////////
            //CONTROLLO SUL SECONDO NOME
            $tempName = preg_split("/ /",$author);
            if(sizeof($tempName)==3){
              //RICOSTRUZIONE DEL NOME DELL'AUTORE CHE SI STA CONSIDERANDO
              $authorName = $tempName[0]." ".$tempName[1]." ".$tempName[2];

              $coAuthors = \DB::table('users')->select('id','name','second_name','last_name')->where('name',$tempName[0])
                                            ->where('second_name',$tempName[1])
                                            ->where('last_name',$tempName[2])->get();

            }else{
              //RICOSTRUZIONE DEL NOME DELL'AUTORE CHE SI STA CONSIDERANDO
              $authorName = $tempName[0]." ".$tempName[1];
              $coAuthors = \DB::table('users')->select('id','name','last_name')->where('name',$tempName[0])
                                            ->where('last_name',$tempName[1])->get();
                }
            /////////////////////////////////////////////////////////////////////////////////////

            //ARRAY DI COAUTORI TROVATI NEL DATABASE ED ELABORATI
            $coAuthorsDone = array();

            //PER OGNI COAUTORE PRESENTE NEL SISTEMA...
            foreach ($coAuthors as $coAuthor) {
              //COSTRUZIONE DELL'ARRAY DEI COAUTORI PRESENTI NEL DB E RICOSTRUZIONE DEI RISPETTIVI NOMI
              $tempCoAuthor = $coAuthor->name." ";
              if(isset($coAuthor->second_name))   $tempCoAuthor = $tempCoAuthor.$coAuthor->second_name." ";
              $tempCoAuthor = $tempCoAuthor.$coAuthor->last_name;
              array_push($coAuthorsDone,$tempCoAuthor);

              //NOTIFICA AD OGNI COAUTORE PRESENTE NEL SISTEMA
              Notification::sendNotification(0, $coAuthor->id, $publication_id,$user_id);
            }
            //PER OGNI COAUTORE NON PRESENTE NEL SISTEMA...
            foreach ($coAuthorsNotDone as $toDo) {

              if(!in_array($toDo,$coAuthorsDone)){
                //AGGIUNGE LA PUBBLICAZIONE ALL'AUTORE PER CUI SI STA FACENDO LA RICERCA, CON IL NOME DEL COAUTORE
                Api::addPublicationToAuthor($request,$user_id, $publication_id,$toDo);
              }
            }
          }//Gestione CoAutori
        } //Per Ogni Autore (nell'Array) della Pubblicazione
      }//Se è un Array di Autori
      //SE NON VIENE RESTUITO UN ARRAY DI AUTORI, VUOL DIRE CHE L'AUTORE PER CUI SI STA FACENDO LA RICERCA E' L'UNICO PRESENTE
      else{
        echo "Nessun Coautore per '".$publication_id."'<br>"; //DEBUG
        $user_id = $request->session()->get('id');
        // $user_id = 1;//For testing <-->Maria Francesca Costabile
        Api::addPublicationToAuthor($request,$user_id, $publication_id,$user_name);
      }

    }

    //FORMATTA LA STRINGA PASSATA COME PARAMETRO
    public static function  formatName($name){
      //FORMATTAZIONE DEL NOME
      $temp = preg_split("/_/", $name);
      if(sizeof($temp)==3){
        $user_name = $temp[0]." ".$temp[1]." ".$temp[2];
      }else{
        $user_name = $temp[0]." ".$temp[1];
      }
      return $user_name;
    }


}
