<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Categorie extends Model
{
    use Searchable;

    public function toSearchableArray(){
      $array =  $this->toArray();

      $attributes = array('category_name');

      $newArray = array();

      foreach ($attributes as $attribute) {
        array_push($newArray,$array[$attribute]);
      }

      return $newArray;
    }
}
