<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Search extends Controller
{

    public static function generalSearch($keyword){

      $publications = Search::publicationSearch($keyword);
      $users = Search::userSearch($keyword);
      $groups = Search::groupSearch($keyword);
      $categories = Search::categorySearch($keyword);
      $posts = Search::postSearch($keyword);

      //todo

    }

  //Ricerca di Pubblicazioni
    public static function publicationSearch($publicationKeyword){

      $tempResults = \App\Publication::search($publicationKeyword)->get();
      $result = array();

      foreach ($tempResult as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Utenti
    public static function userSearch($userKeyword){

      $tempResults = \App\User::search($userKeyword)->get();
      $result = array();

      foreach ($tempResult as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Gruppi
    public static function groupSearch($groupKeyword){

      $tempResults = \App\User::search($groupKeyword)->get();
      $result = array();

      foreach ($tempResult as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Categorie
    public static function categorySearch($categoryKeyword){

      $tempResults = \App\User::search($categoryKeyword)->get();
      $result = array();

      foreach ($tempResult as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }

    //Ricerca di Post
    public static function postSearch($postKeyword){

      $tempResults = \App\User::search($postKeyword)->get();
      $result = array();

      foreach ($tempResult as $tempResult) {
        array_push($result, $tempResult->id);
      }

      return $result; //Ritorna l'insieme degli id delle opere trovate per
    }


}
