<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Group extends Model
{
    use Searchable;

    public function toSearchableArray(){
      $array =  $this->toArray();

      $attributes = array('group_name','group_description');

      $newArray = array();

      foreach ($attributes as $attribute) {
        array_push($newArray,$array[$attribute]);
      }

      return $newArray;
    }
}
