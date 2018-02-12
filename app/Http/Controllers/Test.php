<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Publication;
use \App\UsersPublication;

use Illuminate\Database\QueryException;
class Test extends Controller{


  public function test(Request $request){
    echo $request->visibility;
  }


  public static function formatTimestamp ($created_at, $flag){
    //ELABORAZIONE DATA E ORA PER ORDINAMENTO
    $tmpDate = explode("-",$created_at);
    $tmpTime = explode(":",$tmpDate[2]);
    $day = explode(" ",$tmpTime[0]);

    $date = $tmpDate[0].$tmpDate[1].$day[0];
    $time = $day[1].$tmpTime[1].$tmpTime[2];

    if($flag ==1) return $date.$time;
    else return $time;
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

  public static function condivisioneposts_test (){
      $shareposts = \DB::table('condivision_posts')->select('post_id as posts_id', 'users_posts.visibility','users.name','users.second_name', 'users.last_name','users.user_image','posts.text','posts.created_at')
                    ->join('posts','condivision_posts.post_id', '=','posts.id')
                    ->join('users_posts', 'users_posts.user_id', '=', 'condivision_posts.user_id')
                    ->join('users','users_posts.user_id', '=','users.id')
                    ->where('group_id', 2)->where('users_posts.visibility',0)->orWhere('group_id', 2)->where('users_posts.visibility',1)->orderBy('posts.created_at','desc')
                    ->distinct()
                    ->get();
      var_dump($shareposts);
  }
}
