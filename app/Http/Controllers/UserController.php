<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\User;
use App\Http\Controllers\Exception;
use App\Http\Controllers\Auth;
use Illuminate\Database\Seeder;
use DB;

class UserController extends Controller
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function registerData(Request $request)
  {
      $user = new \App\User;
      $user->name = $request->input('user_name');
      $user->second_name = $request->input('second_name');
      $user->last_name = $request->input('user_lastname');
      $user->birth_date = $request->input('user_date');
      $user->affiliation = $request->input('user_affiliation');

      $user->email = $request->input('user_email');

      $query = DB::table('users')->select('email')->where('email',$user->email)->first();
      
      //verifica se c'è già la email
       if($query != NULL){
        print "Email  $user->email già utilizzata";
        return view('formview');
       }

      $user->password = md5($request->input('user_password'));
      $user->research = $request->input('user_research');
      $user->save();

      $query = DB::table('users')->select('id')->where('email',$user->email)->first();
      $request->session()->put('id',$query->id);
      $request->session()->put('password',$user->password);

      if(isset($user->second_name))$userName = $user->name."_".$user->second_name."_".$user->last_name;
      else $userName = $user->name."_".$user->last_name;

      return redirect('/api?name='.$userName); //a seguito della registrazione indirizzaimo l'user in 'welcome'

  }

  public function loginData(Request $request)
  {

      $email = $request->input('user_email');
      $password =md5($request->input('user_password'));

      $query = DB::table('users')->select('*')->where('email',$email)->first();


      if(!isset($query)){
          return redirect('/?errore=email non presente ');
      }

      if($email == $query->email && $password == ($query->password)){
         $request->session()->put('id',$query->id);
         $request->session()->put('password',$query->password);
        return view('userlogindone');
          }else{
              return redirect('/?errore=password sbagliata ');
              }
  }




  public function passDataToAccount(Request $request)
  {
     
    $value = session('id');// mantego le info su un dato utente conservando l'id 
   
    $query = DB::table('users')->select('*')->where('id',$value)->first();
    
    /*restituisco la view settingaccount e le passo i dati sull'utente */
    return view('settingaccount')->with("name", $query->name)->with("second_name", $query->second_name)
    ->with("last_name", $query->last_name)->with("birth_date", $query->birth_date)->with("affiliation", $query->affiliation)
    ->with("email", $query->email)->with("research", $query->research);
    
   }

   public function modifyData(Request $request)
   {
    
   }


}
