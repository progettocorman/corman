<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UpdateFile extends Controller
{
    public static function fileUpdate(Request $request){
      // var_dump($request->file());
      if ($request->file('fileUpload1') == null) {
          echo "Errore";
        }else{
          $file = $request->file('fileUpload1')->store('uploads');
          return $file;
        }

        $id = session('id');// mantego le info su un dato utente conservando l'id

        $user = new \App\User;
        $user->user_image = $file;

    }
}

