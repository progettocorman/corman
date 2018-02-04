<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AttachmentPost;
use App\AttachmentPublication;

class AttachmentController extends Controller
{
    public static function addAttachment($id_subject, $type_subject, $file){
      if($type_subject == 0){ //post
        $attachment = new AttachmentPost;
      }
      else { //publication
        $attachment = new AttachmentPublication;

    }
}
