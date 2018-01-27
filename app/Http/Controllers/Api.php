<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Publication;
use App\UsersPublication;
use App\User;
use App\Notification;

class Api extends Controller
{
    public function dblpApi(Request $request){

      //TODO: Controllare che le opere non siano già presenti nel database


      //IMPOSTA LA RISORSA curl CON L'URL DA INTERROGARE
      // $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$name."%3A&format=json");
      $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$request->name."%3A&format=json");

      //IMPOSTA L'OPZIONE CURLOPT_RETURNTRANSFER A true IN MODO DA POTER CONSERVARE IL RISULTATO IN UNA VARIABILE
      //CON LA FUNZIONE curl_multi_getcontent();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      //ESEGUE LA RICHIESTA HTTP (GET DI DEFAULT) ATTRAVERSO LA RISORSA curl
      curl_exec($ch);

      $jsonResult= json_decode(curl_multi_getcontent($ch));
      //ESTRAE IN MODO APPROPRIATO I DATI DI INTERESSE DALLA VARIABILE
      //Array che contiene i nomi dei campi da utilizzare come chiavi(tranne authors, trattato separatamente);
      $field = array("title",//titolo della pubblicazione
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
    $publication = new Publication;
    //PER OGNI CAMPO (descritto in $field)...
    foreach ($field as $curField) {

      //... SE IL CAMPO, PER QUELLA ISTANZA, NON è NULLO, ASSEGNA ALL'ARRAY DI SALVATAGGIO IL CORRISPONDENTE VALORE (no authors)
      if(isset($currentPub->info->$curField)){
          if(!is_array($currentPub->info->$curField)) $publication->$curField ="'".substr($currentPub->info->$curField,0,189)."'";
          else{
            foreach ($currentPub->info->$curField as $innerValue) {
              $value = $innerValue." ";
            }
             $publication->$curField = "'".substr($value,0,189)."'";
          }
      }
      else $publication->$curField = "//";
    }

    $publication->save();

    $publication_id =  \DB::table('publications')->select('id')->orderBy('id','desc')->first();
    // var_dump($publication);
    // echo "<br><br>";
    //TRATTAZIONE DELL'ARRAY DI AUTORI: SE E' UN ARRAY (più autori)...
    if(is_array($currentPub->info->authors->author)){
      foreach ($currentPub->info->authors->author as $author) {
        //FORMATTAZIONE DEL NOME
        $user_name = Api::formatName($request->name);
        //SE SE STESSO, PRENDI L'ID DALLA SESSIONE
        if($user_name == $author){
          $user_id = $request->session()->get('id');
          // $user_id = 1;//For testing <-->Maria Francesca Costabile
          $user_publication = new UsersPublication;
          $user_publication->user_id = $user_id;
          $user_publication->publication_id = $publication_id->id;
          $user_publication->author_name = $author;
          $user_publication->save();
        }//...ALTRIMENTI PRENDI GLI ID DEI POSSIBILI COAUTORI
        else{
          $tempName = preg_split("/ /",$author);

          if(sizeof($tempName)==3){
            $authorName = $tempName[0]." ".$tempName[1]." ".$tempName[2];
            $coAuthors = \DB::table('users')->select('id')->where('name',$tempName[0])
                                          ->where('second_name',$tempName[1])
                                          ->where('last_name',$tempName[2])->get();

          }else{
            $authorName = $tempName[0]." ".$tempName[1];
            $coAuthors = \DB::table('users')->select('id')->where('name',$tempName[0])
                                          ->where('last_name',$tempName[1])->get();
          }


          foreach ($coAuthors as $coAuthor) {
            // TODO: Controllare se il coautore è nel database

            // if(isset($coAuthor->id)){
            //NOTIFICA AD OGNI COAUTORE
            $notification = new Notification;
            $notification->user_id = $coAuthor->id;
            $notification->object_id = $publication_id->id;
            $notification->type_id = 0;
            $notification->save();

            // echo $coAuthor->id." ".$currentPub->info->title." ".$authorName."<br>";
            // }else{
            //   $user_publication = new UsersPublication;
            //   $user_publication->user_id = $user_id;
            //   $user_publication->publication_id = $publication_id->id;
            //   $user_publication->author_name = $authorName;
            //   echo $currentPub->info->title." ".$authorName."<br>";
            //   // $user_publication->save();
            // }
          }

        }
      }
    }
  }
  //LIBERA LA RISORSA ALLOCATA
  curl_close($ch);
  return view('welcome');
}

  public function formatName($name){
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
