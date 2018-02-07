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
        $pieces = explode(".", $file);
        echo "</br> Percorso + nome ---> ";
        echo $pieces[0]; // piece1
        echo "</br> Estensione ---> ";
        echo $pieces[1]; // piece2
        echo "</br>";
    }
}

