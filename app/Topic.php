<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Topic extends Model
{
    use Searchable();

    public function toSearchableArray(){
      $array =  $this->toArray();

      $attributes = array('topic_name');

      $newArray = array();

      foreach ($attributes as $attribute) {
        if(!isset($array[$attribute])) continue;
        array_push($newArray,$array[$attribute]);
      }

      return $newArray;
    }


}
