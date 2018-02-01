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
        //todo ottimizzazione nel caso vi sia gia user con stessa mail
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
     
    $id = session('id');// mantego le info su un dato utente conservando l'id 
   
    $query = DB::table('users')->select('*')->where('id',$id)->first();
    
    /*restituisco la view settingaccount e le passo i dati sull'utente */
    return view('settingaccount')->with("name", $query->name)->with("second_name", $query->second_name)
    ->with("last_name", $query->last_name)->with("birth_date", $query->birth_date)->with("affiliation", $query->affiliation)
    ->with("email", $query->email)->with("research", $query->research);
    
   }

   public function modifyData(Request $request)
   {

        $id = session('id');// mantego le info su un dato utente conservando l'id 
    

        $user = new \App\User;
        $user->name = $request->input('user_name');
        $user->second_name = $request->input('second_name');
        $user->last_name = $request->input('user_lastname');
        $user->birth_date = $request->input('user_date');
        $user->affiliation = $request->input('user_affiliation');
        $user->email = $request->input('user_email');
        $user->research = $request->input('user_research');
        $user->user_image = $request->input('user_image');
        
        /*ASSEGNA IL SESSO */
        $gender =  $_POST['gender'];
        foreach ($gender as $value) {
                 $user->sex = $value;
                }


       
         //verifica se c'è già la email asseganta ad altri, in caso restiuisce la view settingaccount 
         $queryid = DB::table('users')->select('id')->where('email', $user->email)->first();
         $queryemail = DB::table('users')->select('email')->where('email',$user->email)->first();
         
         if(($queryemail != NULL) && ($queryid->id != $id)){
             print "Email  $user->email già utilizzata da altro user, sceglierne un'altra!";
             return view('settingaccount')->with("name", $user->name)->with("second_name", $user->second_name)->with("email", $user->email)
                    ->with("last_name", $user->last_name)->with("research",$user->research)->with("birth_date", $user->birth_date)->with("affiliation", $user->affiliation);
            }
        
        



        //aggiornamento dei dati nel DB
         DB::table('users')->where('id',$id)
         ->update(array('name' =>$user->name,'second_name'=>$user->second_name,'last_name'=>$user->last_name,
                        'birth_date'=>$user->birth_date,'affiliation'=>$user->affiliation,
                        'email'=>$user->email,'research'=>$user->research,'sex'=>  $user->sex,
                        'user_image'=>$user->user_image));
        
        /*Salvo id e password per le session */
        $query = DB::table('users')->select('password')->where('email',$user->email)->first();
        $request->session()->put('id',$id);
        $request->session()->put('password',$query);

        return view('userprofile');
    }

    
    /*controlla se che la mail sia inserita correttamnete a prescindere che la si voglia modificare
    @param $email stringa contenete la mail dell'user
    @param $id intero rappresentante l'id dell'user
    @param $user oggetto tipo User avvalorato dall'utente alla compilazione del form  */
  /*  public static function controlEmail( $email, $id , $user)
    {
        $queryid = DB::table('users')->select('*')->where('email',$email)->first();
        $queryemail = DB::table('users')->select('email')->where('email',$email)->first();
        
        //verifica se c'è già la email asseganta ad altri, in caso restiuisce la view settingaccount  
         if(($queryemail != NULL) && ($query->id != $id)){
          print "Email  $user->email già utilizzata da altro user, sceglierne un'altra!";
          return view('settingaccount')->with("name", $user->name)->with("second_name", $user->second_name)
          ->with("last_name", $user->last_name)->with("user_research",$user->research)->with("birth_date", $user->birth_date)->with("affiliation", $user->affiliation);
          }

    } */

}
