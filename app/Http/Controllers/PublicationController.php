<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationController extends Controller
{


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
  public static function processPublication($user_name, $publication, $fields){

    $publicationModel = new \App\Publication;
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

      PublicationController::addPublicationToAuthor($user_id, $publication_id->id ,$user_name);

      echo $publicationModel->title."è già presente <br>";//DEBUG
      return -1;
    }
    //...SE INVECE LA PUBBLICAZIONE NON È ANCORA PRESENTE NEL DB, VIENE INSERITA
    //Ritira l'id della Pubblicazione appena aggiunta al db
    $publication_id =  \DB::table('publications')->select('id')->orderBy('id','desc')->first();

    return $publication_id->id;
  }



  //SI OCCUPA DI PROCESSARE I COAUTORI
  public static function processCoAuthors($user_name, $user_id, $authors, $publication_id){

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


}
