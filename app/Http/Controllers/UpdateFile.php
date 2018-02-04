<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UpdateFile extends Controller
{
    public static function fileUpdate(Request $request){
      if ($request->file('fileUpload1') == null) {
          echo "Errore";
        }else{
          $file = $request->file('fileUpload1')->store('uploads');
          echo $file;
        }
<<<<<<< HEAD

        $id = session('id');// mantego le info su un dato utente conservando l'id

        $user = new \App\User;
        $user->user_image = $file;

=======
        $pieces = explode(".", $file);
        echo "</br> Percorso + nome ---> ";
        echo $pieces[0]; // piece1
        echo "</br> Estensione ---> ";
        echo $pieces[1]; // piece2
        echo "</br>";
>>>>>>> 370864dc0e5b444653586c7902afd43f679cdede
    }
}

