<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;

    protected $table = 'posts';

    //Define relationship with user
    public function users(){
      return $this->belongsToMany('\App\User','users_posts','posts_id','user_id')->withPivot('visibility');
  	}
    public function toSearchableArray(){
      $array =  $this->toArray();

      $attributes = array('text');

      $newArray = array();

      foreach ($attributes as $attribute) {
        if(!isset($array[$attribute])) continue;
        array_push($newArray,$array[$attribute]);
      }

      return $newArray;
    }
}
