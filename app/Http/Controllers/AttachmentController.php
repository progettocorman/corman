<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AttachmentPost;
use App\AttachmentPublication;

class AttachmentController extends Controller
{
    public static function addAttachment($id_subject, $type_subject, $name_attachment, $type_file, $file_name){
      if($type_subject == 0){ //post
        $attachment = new AttachmentPost;
        $attachment->posts_id = $id_subject;
        $attachment->namefile = "$type_subject-$id_subject-$name_attachment";
        $attachment->typefile= $type_file;
        $attachment-> save();
      }
      else { //publication
        $attachment = new AttachmentPublication;
        $attachment->posts_id = $id_subject;
        $attachment->namefile = "$type_subject-$id_subject-$name_attachment";
        $attachment->typefile= $type_file;
        $attachment-> save();
      }
      $path = $request->file($file_name)->storeAs('uploads','$type_subject-$id_subject-$name_attachment');
    }
}
