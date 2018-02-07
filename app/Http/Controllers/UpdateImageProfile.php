<?php

namespace App\Http\Controllers;
use  Input, Redirect;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Http\Controllers\Exception;
use App\Http\Controllers\Auth;
use Illuminate\Database\Seeder;
use DB;

class UpdateImageProfile extends Controller
{
    public static function imageUpdate(Request $request){
      
        $id = session('id');
        $fileinpost = $request->file('user_image');
        if ( $fileinpost != null) {
            $file =  $fileinpost->store('profile_images');
            Storage::delete($file);
            $nomefiledacaricare = explode("/", $file);
            $filee = $fileinpost->move(public_path('profile_images'),$id.".png");
            DB::table('users')->where('id',$id)->update(['user_image'=>$id.".png" ]);
            $query = DB::table('users')->select('*')->where('id',$id)->first();
        }else{
            DB::table('users')->where('id',$id)->update(['user_image'=>"defaultprofile.png" ]);
            $query = DB::table('users')->select('*')->where('id',$id)->first();
        }
        
        return view('settingaccount')->with("name", $query->name)->with("second_name", $query->second_name)->with("email", $query->email)->with("user_image", $query->user_image)
        ->with("last_name", $query->last_name)->with("research",$query->research)->with("birth_date", $query->birth_date)->with("affiliation", $query->affiliation);
    }
}
