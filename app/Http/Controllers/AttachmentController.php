<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\AttachmentsPost;
use \App\AttachmentsPublication;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public static function addAttachment($id_subject, $type_subject, $fileinpost){
      //passare $request->file('fileUpload1') come $fileinpost

      //CARICAMENTO FILE
          if ($fileinpost== null) {
              echo "Errore";
            }else{
              $file = $fileinpost->store('uploads');
            }
      $pieces = explode(".", $file);
             // Estensione $pieces[1]


      //AGGIORNAMENTO DB
      if($type_subject == 0){ //post
        $attachment = new AttachmentsPost;
        $attachment->posts_id = $id_subject;
        $attachment->namefile = $file;
        $attachment->typefile = $pieces[1];
        $attachment->save();
      }
      else { //publication
        $attachment = new AttachmentsPublication;
        $attachment->publication_id = $id_subject;
        $attachment->namefile = $file;
        $attachment->typefile = $pieces[1];
        $attachment->save();

      }

    }
}
