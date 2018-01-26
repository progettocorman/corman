<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use App\Publication;
use App\UsersPublication;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/apiTest',function(Request $request){
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
    var_dump($publication);
    $publication["authors"] = array();//DATO CHE USIAMO SEMPRE LA STESSA VARIABILE, PER PULIRE L'ARRAY DEGLI AUTORI
    echo '<br><br><br>';

  }
    //LIBERA LA RISORSA ALLOCATA
    curl_close($ch);
});

Route::get('api',function(Request $request){
  //IMPOSTA LA RISORSA curl CON L'URL DA INTERROGARE
  // $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$name."%3A&format=json");
  $ch = curl_init("http://dblp.org/search/publ/api?q=author%3A".$request->name."%3A&format=json");
  //IMPOSTA L'OPZIONE CURLOPT_RETURNTRANSFER A true IN MODO DA POTER CONSERVARE IL RISULTATO IN UNA VARIABILE
  //CON LA FUNZIONE curl_multi_getcontent();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //ESEGUE LA RICHIESTA HTTP (GET DI DEFAULT) ATTRAVERSO LA RISORSA curl
  curl_exec($ch);
  //ESTRAE IN MODO APPROPRIATO I DATI DI INTERESSE DALLA VARIABILE
  $jsonResult= json_decode(curl_multi_getcontent($ch));
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
      if(isset($currentPub->info->$curField))$publication->$curField ="'".$currentPub->info->$curField."'";
      else $publication->$curField = "//";
    }

    $publication->save();

    $publication_id = DB::table('publications')->select('id')->orderBy('id','desc')->first();

    //TRATTAZIONE DELL'ARRAY DI AUTORI: SE E' UN ARRAY (più autori)...
    if(is_array($currentPub->info->authors->author)){
      foreach ($currentPub->info->authors->author as $author) {
        //FORMATTAZIONE DEL NOME
        $temp = preg_split("/_/", $request->name);
        if(sizeof($temp)==3){
          $user_name = $temp[0]." ".$temp[1]." ".$temp[2];
        }else{
          $user_name = $temp[0]." ".$temp[1];
        }
        //SE SE STESSO, PRENDI L'ID DALLA SESSIONE
        if($user_name == $author){
          $user_id = 1; //todo Sessioni
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
            $coAuthors = DB::table('users')->select('id')->where('name',$tempName[0])
                                          ->where('second_name',$tempName[1])
                                          ->where('last_name',$tempName[2])->get();

          }else{
            $authorName = $tempName[0]." ".$tempName[1];
            $coAuthors = DB::table('users')->where('name',$tempName[0])
                                          ->where('last_name',$tempName[1])->get();
          }
          if(isset($coAuthors)){
            foreach ($coAuthors as $coAuthor) {
               //NOTIFICA todo
            }
          }else{
            $user_publication->author_name = $authorName;
            $user_publication->save();
          }

        }

      }
    }
  }
  //LIBERA LA RISORSA ALLOCATA
  curl_close($ch);
});

Route::get('query',function(Request $request){
  $temp = preg_split("/_/", $request->name);

  if(sizeof($temp)==3){
    $user_name = $temp[0]." ".$temp[1]." ".$temp[2];
    $users_id = DB::table('users')->select('id')->where('name',$temp[0])
                                              ->where('second_name',$temp[1])
                                              ->where('last_name',$temp[2])->get();
  }else{
    $user_name = $temp[0]." ".$temp[1];
    $users_id = DB::table('users')->select('id')->where('name',$temp[0])
                                               ->where('last_name',$temp[1])->get();
  }

  echo $user_name."<br>";

  foreach ($users_id as $user_id) {
    echo($user_id->id);
  }

$publication_id = DB::table('publications')->select('id')->orderBy('id','desc')->first();
var_dump($publication_id);
});


Route::get('prova',function(Request $request){

    $temp = DB::table('users')->select('email')->where('email','sbagliato')->first();


    if(!isset($temp)) echo "Yes";
    else echo "no";
    return redirect('/formregister?email=mail sbagliata&password=password sbagliata');
});
