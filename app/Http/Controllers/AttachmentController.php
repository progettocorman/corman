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
              Storage::delete($file);
              $nomefiledacaricare = explode("/", $file);
              $filee = $fileinpost->move(public_path('uploads'),$nomefiledacaricare[1]);
            }
      $pieces = explode(".", $file);
      
      //AGGIORNAMENTO DB
      if($type_subject == 0){ //post
        AttachmentController::addAttachmentToPost($id_subject,$file,$pieces[1]);
      }
      else { //publication
        AttachmentController::addAttachmentToPublication($id_subject,$file,$pieces[1]);
      }

    }

    public static function addAttachmentToPost($post_id,$name_file,$type_file){
      $attachment = new AttachmentsPost;
      $attachment->posts_id = $post_id;
      $attachment->namefile = $name_file;
      $attachment->typefile = $type_file;
      $attachment->save();
    }

    public static function addAttachmentToPublication($publication_id,$name_file,$type_file){
      $attachment = new AttachmentsPublication;
      $attachment->publication_id = $publication_id;
      $attachment->namefile = $name_file;
      $attachment->typefile = $type_file;
      $attachment->save();
    }
}
