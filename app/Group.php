<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Group extends Model
{
    use Searchable;

    protected $table = 'groups';

    public function members(){
        return $this->belongsToMany('\App\User','partecipations','group_id','user_id');
    }

    public function toSearchableArray(){
      $array =  $this->toArray();

      $attributes = array('group_name','group_description');

      $newArray = array();

      foreach ($attributes as $attribute) {
        if(!isset($array[$attribute])) continue;
        array_push($newArray,$array[$attribute]);
      }

      return $newArray;
    }
}
