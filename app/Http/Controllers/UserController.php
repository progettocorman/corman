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
      $mail2 = $request->input('user_email2');

      $user->user_image = "defaultprofile.png";
      $query = DB::table('users')->select('email')->where('email',$user->email)->first();

      //verifica se c'è già la email
       if($query != NULL){
        //todo ottimizzazione nel caso vi sia gia user con stessa mail
        return view('formview')->with('error',"Mail already on use! Choose another one :)");
        }
        if($user->email!=$mail2){
            return view('formview')->with('error',"E-mail does not match! Try again! :(");
        }
      $password = $request->input('user_password');
      $password2 = $request->input('user_password2');

      if($password!=$password2){
          return view('formview')->with('error',"Password does not match! Try again! :(");
      }
      $user->password = md5($request->input('user_password'));
      $user->research = $request->input('user_research');
      $user->save();

      $query = DB::table('users')->select('id')->where('email',$user->email)->first();
      $request->session()->put('id',$query->id);
      $request->session()->put('password',$user->password);

      if(isset($user->second_name))$userName = $user->name."_".$user->second_name."_".$user->last_name;
      else $userName = $user->name."_".$user->last_name;

      Api::dblpApi($request,$userName);
      return redirect('/home'); //a seguito della registrazione indirizzaimo l'user in 'welcome'

  }

  public function loginData(Request $request)
  {

    $email = $request->input('user_email');
    $password =md5($request->input('user_password'));

    $query = DB::table('users')->select('*')->where('email',$email)->first();

      if(!isset($query)){
          return view('welcome')->with('error',"Oh yeah...There's no such mail, try another one :o");
      }

      /**verifico correttezza di email e password ed evenuatuale presenza imagine profilo */
      if($email == $query->email && $password == ($query->password)){
        $request->session()->put('id',$query->id);
        $request->session()->put('password',$query->password);
        return view('userlogindone')->with("user_image", $query->user_image)->with("name", $query->name)->with("last_name", $query->last_name)->with("affiliation", $query->affiliation);
          }else{
              return view('welcome')->with('error',"Mmm...Seems like that's the wrong password, try another one :o");
              }
    }


  public function passDataToAccount(Request $request)
  {

    $id = session('id');// mantego le info su un dato utente conservando l'id

    $query = DB::table('users')->select('*')->where('id',$id)->first();

    /*restituisco la view settingaccount e le passo i dati sull'utente */
    return view('settingaccount')->with("name", $query->name)->with("second_name", $query->second_name)
    ->with("last_name", $query->last_name)->with("birth_date", $query->birth_date)->with("affiliation", $query->affiliation)
    ->with("email", $query->email)->with("research", $query->research)->with("user_image", $query->user_image);

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

        /*ASSEGNA IL SESSO */
        $gender =  $_POST['gender'];
        foreach ($gender as $value) {
                 $user->sex = $value;
                }

        //verifica se c'è già la email asseganta ad altri, in caso restiuisce la view settingaccount
         $queryid = DB::table('users')->select('id')->where('email', $user->email)->first();
         $queryemail = DB::table('users')->select('email')->where('email',$user->email)->first();

         if(($queryemail != NULL) && ($queryid->id != $id)){
             $error = "Woops...Seems like that mail's already on use! Try another one :)";
             return view('settingaccount')->with('error',$error)->with("name", $user->name)->with("second_name", $user->second_name)->with("email", $user->email)->with("user_image", $user->user_image)
                    ->with("last_name", $user->last_name)->with("research",$user->research)->with("birth_date", $user->birth_date)->with("affiliation", $user->affiliation);
            }





        //aggiornamento dei dati nel DB
         DB::table('users')->where('id',$id)
         ->update(array('name' =>$user->name,'second_name'=>$user->second_name,'last_name'=>$user->last_name,
                        'birth_date'=>$user->birth_date,'affiliation'=>$user->affiliation,
                        'email'=>$user->email,'research'=>$user->research,'sex'=>  $user->sex
                      ));



        /*Salvo id e password per le session */
        $query = DB::table('users')->select('password')->where('email',$user->email)->first();
        $request->session()->put('id',$id);
        $request->session()->put('password',$query);

        if(isset($user->second_name))$userName = $user->name."_".$user->second_name."_".$user->last_name;
        else $userName = $user->name."_".$user->last_name;

        Api::dblpApi($request, $userName);
        return view('settingaccount')->with("name", $user->name)->with("second_name", $user->second_name)->with("email", $user->email)->with("user_image", $user->user_image)
               ->with("last_name", $user->last_name)->with("research",$user->research)->with("birth_date", $user->birth_date)->with("affiliation", $user->affiliation);
    }

    public function getHome(Request $request)
    {

        $id = session('id'); // mantego le info su un dato utente conservando l'id
        $query = DB::table('users')->select('*')->where('id', $id)->first();
        return view('userlogindone')->with("name", $query->name)->with("user_image", $query->user_image)
        ->with("last_name", $query->last_name)->with("affiliation", $query->affiliation);

    }

    public function mostfollowed()
    {
      $users = DB::table('users')
                  ->select('id as idutente', DB::raw('count(*) as contatore'))
                  ->join('friendships', 'friendships.user_id', '=', 'users.id')
                  ->groupBy('id')
                  ->orderBy('contatore', 'desc')
                  ->get();
      $i = 0;
      foreach ($users as $current_user) {
          $mostfollowed[$i]=$current_user->idutente;
          if($i == 9){
            break;
          }
          $i++;
      }
      return $mostfollowed;
    }

    public static function getProfile(Request $request)
    {

        $id = $request->id; // mantego le info su un dato utente conservando l'id
        $query = DB::table('users')->select('*')->where('id', $id)->first();
        return view('userprofile')->with('id',$id)->with("name", $query->name)->with("user_image", $query->user_image)
        ->with("last_name", $query->last_name)->with("affiliation", $query->affiliation);

    }

    public static function getNumberFollow($user_id){
      $users = DB::table('friendships')->where('user_follow',$user_id)->count();
      return $users;
    }

    public static function getNumberFollower($user_id){
      $users = DB::table('friendships')->where('user_id',$user_id)->count();
      return $users;
    }

    public static function getFollow(){
      $user_id = session('id');
      $user = \App\User::find($user_id);

      $follows = $user->follows;

      return view('follow')->with(['follows' => $follows]);
    }

    public static function getFollower(){
      $user_id = session('id');
      $user = \App\User::find($user_id);

      $followers = $user->followers;

      return view('follower')->with(['followers' => $followers]);
    }
    public static function logout(Request $request){

        $request->session()->flush();
        return redirect('/');
    }

}
