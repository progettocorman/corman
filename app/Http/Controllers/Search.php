<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Search extends Controller
{

    public static function generalSearch(Request $request){

      $keyword = $request->keyword;

      $publications = Search::publicationSearch($keyword);
      // if(empty($publications))echo "Nessuna Pubblicazione";
      // else var_dump($publications);
      // echo "<br>";

      $users = Search::userSearch($keyword);
      // if(empty($users))echo "Nessun Utente";
      // else var_dump($users);
      // echo "<br>";

      $groups = Search::groupSearch($keyword);
      // if(empty($groups))echo "Nessun Gruppo";
      // else var_dump($groups);
      // echo "<br>";

        return view('search_result')->with('users',$users);
    }

    public static function searchByTag(Request $request){
      //todo
    }

    public static function searchByCategory(Request $request){
      //todo
    }

    public static function searchByTopic(Request $request){
      //todo
    }

    public static function searchByPost(Request $request){
      //todo
    }




  //Ricerca di Pubblicazioni
    public static function publicationSearch($publicationKeyword){

      $tempResults = \App\Publication::search($publicationKeyword)->get();
      $result = array();

      foreach ($tempResults as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Utenti
    public static function userSearch($userKeyword){

      $tempResults = \App\User::search($userKeyword)->get();
      $result = array();

      foreach ($tempResults as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Gruppi
    public static function groupSearch($groupKeyword){

      $tempResults = \App\Group::search($groupKeyword)->get();
      $result = array();

      foreach ($tempResults as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Categorie
    public static function categorySearch($categoryKeyword){

      $tempResults = \App\Category::search($categoryKeyword)->get();
      $result = array();

      foreach ($tempResults as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Post
    public static function postSearch($postKeyword){

      $tempResults = \App\Post::search($postKeyword)->get();
      $result = array();

      foreach ($tempResults as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Post
    public static function topicSearch($postKeyword){

      $tempResults = \App\Post::search($postKeyword)->get();
      $result = array();

      foreach ($tempResults as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

}
