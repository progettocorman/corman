<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use DB;

class PublicationController extends Controller
{


  public function getPubblicazioneView(Request $request)
  {

    $id = session('id');
    $query = DB::table('users')->select('*')->where('id', $id)->first();
    return view('/pubblicazione')->with("name",$query->name)->with("last_name",$query->last_name)
    ->with("user_image", $query->user_image)->with("affiliation",$query->affiliation);
  }


  public static function manualAdd(Request $request){
    $user_id = $request->session()->get('id');

    $publicationModel = new \App\Publication;
    $publicationModel->title = $request->input('title');
    $publicationModel->venue = $request->input('venue');
    $publicationModel->volume = $request->input('volume');
    $publicationModel->number = $request->input('number');
    $publicationModel->pages = $request->input('pages');
    $publicationModel->year = $request->input('year');
    $publicationModel->type = $request->input('type');

    $authors = explode(",", $request->input('coautori'));


    $publicationModel->dbKey = md5($publicationModel->title.$publicationModel->year);

    //Ricostruzione del nome dell'utente
    $query_user_name = \DB::table('users')->where('id',$user_id)->first();
    if(isset($query_user_name->second_name)){
      $user_name = $query_user_name->name.' '.$query_user_name->second_name.' '.$query_user_name->last_name;
    }
    else {
      $user_name = $query_user_name->name.' '.$query_user_name->last_name;
    }

    if($authors[0]=="")$authors[sizeof($authors)-1] = $user_name;
    else $authors[sizeof($authors)] = $user_name;
    var_dump($authors);

    //SE LA PUBBLICAZIONE È GIA' PRESENTE NEL DB, AGGIUNGILA ALL'UTENTE SENZA RE-INSERIRLA
    try{
      $publicationModel->save();
    }catch(QueryException $exception){
      //TODO Messaggio
      //Aggiungi pubblicazione all'autore

      $publication_id = \DB::table('publications')->select('id')->where('dbKey',$publicationModel->dbKey)->first();

      PublicationController::addPublicationToAuthor($user_id, $publication_id->id ,$user_name);

      // echo $publicationModel->title."è già presente <br>";//DEBUG

    }//...SE INVECE LA PUBBLICAZIONE NON È ANCORA PRESENTE NEL DB, VIENE INSERITA

    $publication_id =  \DB::table('publications')->select('id')->orderBy('id','desc')->first();

    $fileinpost =$request->file('fileUpload1');
    //Aggiunta allegato
    if(isset($fileinpost)){
      //Ritira l'id della Pubblicazione appena aggiunta al db
       AttachmentController::addAttachment($publication_id->id, 1, $fileinpost);
      }
    PublicationController::processCoAuthors($request, $user_name,$user_id,$authors,$publication_id->id);
      //invoca la funzione per salvare i tag della pubblicazione

      $tags =  explode(",",$request->input('tags'));
      foreach($tags as $tag){
        if($tag =="")continue;
        TagsPublicationsController::saveTags($tag,$publication_id->id);
      }

      return redirect('home');
  }

  //PERMETTE DI AGGIUNGERE UNA PUBBLICAZIONE AD UN AUTORE
  public static function addPublicationToAuthor($user_id, $publication_id, $author){
    $user_publication = new \App\UsersPublication;
    $user_publication->user_id = $user_id;
    $user_publication->publication_id = $publication_id;
    $user_publication->author_name = $author;
    $user_publication->visibility = 1; // Private di default

    $user_publication->save();
  }

  //SI OCCUPA DI PROCESSARE LE PUBBLICAZIONI
  public static function processPublication(Request $request, $user_name, $publication, $fields){

    $publicationModel = new \App\Publication;
    //PER OGNI CAMPO (descritto in $field)...
    foreach ($fields as $curField) {
      //... SE IL CAMPO, PER QUELLA ISTANZA, NON è NULLO, AVVALORA IL MODEL IL CORRISPONDENTE VALORE (no authors)
      if(isset($publication->$curField)){
          if(!is_array($publication->$curField)) $publicationModel->$curField =$publication->$curField;
          else{
            foreach ($publication->$curField as $innerValue) {
              $value = $innerValue." ";
            }
             $publicationModel->$curField = "'".$value;
          }
      }
      // else $publicationModel->$curField = "//";
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

      PublicationController::addPublicationToAuthor($user_id, $publication_id->id ,$user_name);

      // echo $publicationModel->title."è già presente <br>";//DEBUG
      return -1;
    }
    //...SE INVECE LA PUBBLICAZIONE NON È ANCORA PRESENTE NEL DB, VIENE INSERITA
    //Ritira l'id della Pubblicazione appena aggiunta al db
    $publication_id =  \DB::table('publications')->select('id')->orderBy('id','desc')->first();


    //AGGIUNGE ALLEGATI (SE PRESENTI) ALLA PUBBLICAZIONE
    if($publicationModel->ee != NULL)  AttachmentController::addAttachmentToPublication($publication_id->id,$publicationModel->ee,"pdf");
    if($publicationModel->url != NULL)  AttachmentController::addAttachmentToPublication($publication_id->id,$publicationModel->url,"dblp");

    return $publication_id->id;
  }



  //SI OCCUPA DI PROCESSARE I COAUTORI
  public static function processCoAuthors(Request $request, $user_name, $user_id, $authors, $publication_id){

    //TRATTAZIONE DELL'ARRAY DI AUTORI: SE E' UN ARRAY (più autori)...
    if(is_array($authors)){
      foreach ($authors as $author) {

        //ARRAY DI TUTTI GLI AUTORI, NON ANCORA TRATTATI
        $coAuthorsNotDone = array();
        array_push($coAuthorsNotDone,$author);

        //SE SE STESSO, PRENDI L'ID DALLA SESSIONE E AGGIUNGI LA PUBBLICAZIONE ALL'AUTORE
        if($user_name == $author){
          // $user_id = 1;//For testing <-->Maria Francesca Costabile
          PublicationController::addPublicationToAuthor($user_id, $publication_id,$user_name);
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
              PublicationController::addPublicationToAuthor($user_id, $publication_id,$toDo);
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
      PublicationController::addPublicationToAuthor($user_id, $publication_id,$user_name);
    }

  }

  public static function modifyPublication(Request $request){
    //Bisonga vedere come passare l'id della pubblicazione
    $newDbKey = md5($request->input('title').$request->input('year'));
    \DB::table('publications')->where('id',$publication_id)//id passato con get
    ->update(array('title' =>$request->input('title'),
                  'venue'=>$request->input('venue'),
                  'volume'=>$request->input('volume'),
                  'number'=>$request->input('number'),
                  'pages'=>$request->input('pages'),
                  'year'=>$request->input('year'),
                  'type'=>$request->input('type'),
                  'dbKey'=>$newDbKey ));
  }

  public static function modifyPublicationVisibility(Request $request){
    $user_id = session('id');
    $publication_id = $request->publication_id;
    \DB::table('users_publications')->where('user_id',$user_id)->where('publication_id',$publication_id)
      ->update(array("visibility"=>$request->visibility));
    // $user_id = session('id');
    // $publication_id = $request->publication_id;
    // $user = \App\User::find($user_id);
    // $publication = $user->publications()->where('publication_id',$publication_id)->get();
    // $publication->pivot->visibility = $request->visibility;

    return redirect('/tot_pubblicazioni?id='.$request->id);
  }



  public static function addCondivison(Request $request,$group){
        $publication_id = 1/*$request->input('publication_id')*/;
        $publication  = \App\Publication::find($publication_id);


        $condivision = new \App\Condivision;
        $condivision->user_id = 2 /*session('id')*/;
        if($group == 1){
          $condivision->group_boolean = true;
          $condivision->group_id = $request->input('group_id');
        } else{
          $condivision->group_boolean = false;
          //$condivision->group_id = NULL;
        }

        $publication->condivisions()->save($condivision);
  }

  public static function modify(Request $request,$publication_id)
  {
    \DB::table('publications')->where('id',$publication_id)//id passato con get
    ->update(array('title' =>$request->input('title'),
                  'venue'=>$request->input('venue'),
                  'volume'=>$request->input('volume'),
                  'number'=>$request->input('number'),
                  'pages'=>$request->input('pages'),
                  'year'=>$request->input('year'),
                  'type'=>$request->input('type'),
                  'dbKey'=>$newDbKey ));
  }

}
