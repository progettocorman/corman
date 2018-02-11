<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use App\Publication;
use App\UsersPublication;
use App\User;


class Api extends Controller
{
    //SI OCCUPA DI INVOCARE LE RESTFUL API DI dblp E PROCESSARE IL RISULTATO
    public static function dblpApi(Request $request,$name){
      $user_name = Api::formatName($name);
      $user_id = $request->session()->get('id');
      //IMPOSTA LA RISORSA curl CON L'URL DA INTERROGARE
      // $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$name."%3A&format=json");
      $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$name."%3A&format=json");

      //IMPOSTA L'OPZIONE CURLOPT_RETURNTRANSFER A true IN MODO DA POTER CONSERVARE IL RISULTATO IN UNA VARIABILE
      //CON LA FUNZIONE curl_multi_getcontent();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      //ESEGUE LA RICHIESTA HTTP (GET DI DEFAULT) ATTRAVERSO LA RISORSA curl
      curl_exec($ch);
      //DECODIFICA IL RISULTATO JSON
      $jsonResult= json_decode(curl_multi_getcontent($ch));
      //SE L'UTENTE NON È PRESENTE IN dblp, RIPORTA MESSAGGIO
      if(!isset($jsonResult->result->hits->hit)){
        // echo "L'utente non è presente il dblp";//TODO MESSAGGIO ERRORE
        return redirect('/home');
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
          $currentPubId = PublicationController::processPublication($request, $user_name, $currentPub->info, $fields);

          if($currentPubId != -1){
            PublicationController::processCoAuthors($request, $user_name, $user_id,$currentPub->info->authors->author,$currentPubId);
          }

      }
      //LIBERA LA RISORSA ALLOCATA
      curl_close($ch);
      // return redirect('/home');
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
