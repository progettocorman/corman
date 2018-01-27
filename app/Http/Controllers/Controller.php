<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request; 
use App\Http\Controllers\Auth;
use Illuminate\Database\Seeder;
use App\Contatto;
use DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function inviaDati(Request $request)
    {
        $contatto = new Contatto;
        $contatto->name = strtolower($request->input('user_name'));
        $contatto->last_name = strtolower($request->input('user_lastname'));
        $contatto->birth_date = $request->input('user_date');
        $contatto->affiliation = strtolower($request->input('user_affiliation'));
        $contatto->email = $request->input('user_email');
        $contatto->password = $request->input('user_password');
        $contatto->research = strtolower($request->input('user_research'));
        $contatto->save();
        return view('welcome'); //a seguito della registrazione indirizzaimo l'user in 'welcome'
        
    }

    public function verificaDati(Request $request)
    {
        $contatto = new Contatto;
        $email = $request->input('user_email');
        $password = $request->input('user_password');

        /*query che ci interessa attuare sulla tabella*/
        $query = "SELECT * FROM user";

        /*ci connettiamo al db corman */
        $db_connect = mysqli_connect("localhost","root", "","corman"); 
       
       /*verifichiamo che la query sia true*/
       if( $result = mysqli_query( $db_connect, $query)){
           // $row = mysqli_num_rows($result); //restiruisce il numero di tuple per la query $query
            
           /*cicla su tutte le tuple restituite */
            while ($obj=mysqli_fetch_object($result)){
                if($obj->email == $email && $obj->password == $password){
                    session_start();
                    $_SESSION["id"] = $obj->id;
                    echo $_SESSION["id"];
                    mysqli_close($db_connect);
                    return view('userlogindone'); //a seguito del login indirizzaimo l'user in 'userlogindone'
                   }
                } 
                 
        }
    
        echo "fail login, are you register? ";
        mysqli_close($db_connect);
         return view('welcome'); //a seguito del mancato login l'user è indirizzato in 'welcome'
    }
    
}


