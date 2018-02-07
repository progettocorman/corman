<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condivision extends Model
{
    //
    protected $table = 'condivisions';

    public function shareable(){
      return $this->morphTo();
    }
}
