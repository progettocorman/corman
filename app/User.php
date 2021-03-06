<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class User extends Model
{
   use Searchable;

   protected $table='users';
   //Define relationshi with post
   public function posts(){
      return $this->belongsToMany('\App\Post','users_posts','user_id','posts_id')->withPivot('visibility');
   }

   public function publications(){
     return $this->belongsToMany('\App\Publication','users_publication','user_id','publication_id')->withPivot('visibility','author_name');
   }


   public function followers(){
   		return $this->belongsToMany('\App\User', 'friendships', 'user_id', 'user_follow');
    }

    public function follows(){
      return $this->belongsToMany('\App\User', 'friendships', 'user_follow', 'user_id');
    }


   public function getFullName()
   {
          return $this->name . ' ' . $this->second_name . ' ' . $this->last_name;
   }
   public function toSearchableArray(){
     $array =  $this->toArray();

     $attributes = array('name','second_name','last_name');

     $newArray = array();

     foreach ($attributes as $attribute) {
       if(!isset($array[$attribute])) continue;
       array_push($newArray,$array[$attribute]);
     }

     return $newArray;
   }

}
