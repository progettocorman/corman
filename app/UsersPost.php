<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class UsersPost extends Model
{
  use Searchable;
}
