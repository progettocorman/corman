<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class User extends Model
{
   use Searchable;

   public function toSearchableArray(){
     $array =  $this->toArray();

     $attributes = array('name','second_name','last_name');

     $newArray = array();

     foreach ($attributes as $attribute) {
       array_push($newArray,$array[$attribute]);
     }

     return $newArray;
   }

}
