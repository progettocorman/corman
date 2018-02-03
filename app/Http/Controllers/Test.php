<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Publication;
use \App\UsersPublication;

use Illuminate\Database\QueryException;
class Test extends Controller{


  public function test(Request $request){
    $users = \App\Publication::search('Concept')->get();

    foreach ($users as $user) {
      echo $user->title;
      echo "<br>";
    }
  }



  public function apiTest(Request $request){
    //IMPOSTA LA RISORSA curl CON L'URL DA INTERROGARE
    // $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$name."%3A&format=json");
    $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$request->name."%3A&format=json");

    //IMPOSTA L'OPZIONE CURLOPT_RETURNTRANSFER A true IN MODO DA POTER CONSERVARE IL RISULTATO IN UNA VARIABILE
    //CON LA FUNZIONE curl_multi_getcontent();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //ESEGUE LA RICHIESTA HTTP (GET DI DEFAULT) ATTRAVERSO LA RISORSA curl
    curl_exec($ch);

    $jsonResult= json_decode(curl_multi_getcontent($ch));

    if(!isset($jsonResult->result->hits->hit)){
      echo "Vuoto";
      return;
    }
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

    //Array (simil-DAO) in cui vengono salvate le informazioni di ogni hit
    $publication = array("title"=>'', "authors" => array(), "venue"=>'',"volume"=>'',"key"=>'',"number"=>'', "pages"=>'', "year"=>'',"type"=>'',
                                      "doi"=>'',"ee"=>'',"url"=>'' );
    //CICLA SU TUTTE LE ISTANZE DI HIT CONTENUTE IN HITS (CONTENUTE IN RESULT)
    foreach ($jsonResult->result->hits->hit as $currentPub) {
      //PER OGNI CAMPO (descritto in $field)...
      foreach ($field as $curField) {
        //... SE IL CAMPO, PER QUELLA ISTANZA, NON è NULLO, ASSEGNA ALL'ARRAY DI SALVATAGGIO IL CORRISPONDENTE VALORE (no authors)
        if(isset($currentPub->info->$curField))$publication[$curField] = $currentPub->info->$curField;
        else $publication[$curField] = "//";
      }
      //TRATTAZIONE DELL'ARRAY DI AUTORI: SE E' UN ARRAY (più autori)...
      if(is_array($currentPub->info->authors->author)){
        foreach ($currentPub->info->authors->author as $author) {
          array_push($publication["authors"],$author);//AVVALORA L'ARRAY DEGLI AUTORI
        }//...ALTRIMENTI, SE VI è UN SOLO AUTORE...
      }else array_push($publication["authors"],$currentPub->info->authors->author);

      /*DEBUG*/
      // var_dump($publication);
      $publication["authors"] = array();//DATO CHE USIAMO SEMPRE LA STESSA VARIABILE, PER PULIRE L'ARRAY DEGLI AUTORI
      echo '<br><br><br>';

    }
      //LIBERA LA RISORSA ALLOCATA
      curl_close($ch);
  }
}
