<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AttachmentPost;
use App\AttachmentPublication;

class AttachmentController extends Controller
{
    public static function addAttachment($id_subject, $type_subject, $fileinpost){
      //passare $request->file('fileUpload1') come $fileinpost

      //CARICAMENTO FILE
          if ($fileinpost== null) {
              echo "Errore";
            }else{
              $file = $fileinpost->store('uploads');
              return $file;
            }

      //AGGIORNAMENTO DB
      if($type_subject == 0){ //post
        $attachment = new AttachmentPost;
        $attachment->posts_id = $id_subject;
        $attachment->namefile =
        $attachment->typefile =
      }
      else { //publication
        $attachment = new AttachmentPublication;
        $attachment->publication_id = $id_subject;
        $attachment->namefile =
        $attachment->typefile =

    }
}
