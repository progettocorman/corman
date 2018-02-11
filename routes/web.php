<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
//indirizza alla home
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'UserController@getHome'); //indirizzamneto alla home con passaggio parametri
Route::get('/apiCall',function(Request $request){
  $user = \DB::table('users')->where('id',session('id'))->first();
  if(isset($user->second_name))$userName = $user->name."_".$user->second_name."_".$user->last_name;
  else $userName = $user->name."_".$user->last_name;
  // echo $userName;
  \App\Http\Controllers\Api::dblpApi($request, $userName);
  return redirect('/home');
});
Route::get('/userprofile', 'UserController@getProfile');//indirizzameneto al profilo utente con passaggio parametri

Route::get('/logout','UserController@logout');//logout utente da ogni pagina
Route::get('/notAcc','Notification@notificationManager');
//ENRICO E RICCARDO

Route::get('/api','Api@dblpApi');//Aggiornamento automatico pubblicazioni
Route::get('/search','Search@generalSearch');
Route::post('/update_file', 'UpdateFile@fileUpdate');//Caricamento allegati
Route::post('/addPublication', 'PublicationController@manualAdd'); //Caricamento manuale
Route::get('/most_followed', 'UserController@mostfollowed');//più seguiti
Route::get('/logout', 'UserController@logout');//uscire dal profilo
Route::get('/setVisibilityPost','PostController@modifyPostVisibility');
Route::get('/setVisibilityPub','PublicationController@modifyPublicationVisibility');
Route::get('/follow','Follow@followManager');
Route::get('/invite','Group@inviteManager');
Route::get('/createGroup','Group@createGroup');
Route::get('/condivisione', function () {  return view('condivisione');});
Route::get('/condivisione2','CondivisionController@addcondivision');
Route::get('/createGroup','Group@createGroup');
Route::post('/modifyGroup','Group@modifyGroup');
Route::get('/members','Group@getMembers');

//ANTONIO
Route::get('/formregister', function () {
    return view('formview');
});

Route::get('/pubblicazionemod', function () {
    return view('pubblicazionemod');
});

Route::get('/setting_group', function () {
    return view('setting_group');
});

Route::get('/tot_pubblicazioni', function () {
    return view('tot_pubblicazioni');
});

Route::get('/tot_pubblicazioni_group', function () {
    return view('tot_pubblicazioni_group');
});

Route::get('/notifications', function () {
    return view('notifications');
});

Route::get('/tot_post', function () {
    return view('tot_post');
});

Route::get('/tot_post_group', function () {
    return view('tot_post_group');
});

Route::get('/modifica_post', function () {
    return view('modifica_post');
});
Route::get('/f.a.q', function () {
    return view('faq');
});
Route::post('/modifyPost', 'PostController@modifyPost');//modifica post

Route::get('/group',function(){
    $id = session('id');
    $query = DB::table('users')->select('*')->where('id', $id)->first();
    return view('group')->with("name",$query->name)->with("last_name",$query->last_name)
    ->with("affiliation",$query->affiliation);
});//indirizzamneto ai gruppi



Route::get('/modifica_pubblicazione', function () { //mostra l'uri per la modifica delle
    return view('modifica_pubblicazione');
});

Route::post('modifyPublication', 'PublicationController@modifyPublication');//modifica pubblicazioni

Route::get('/post', 'PostController@getPostView'); //restituisce la view post con passaggio parametri

Route::get('/pubblicazione', 'PublicationController@getPubblicazioneView');//  return view('pubblicazione')con parametri;

Route::post('/publicPost','PostController@addUserPost');

Route::post('/update_image_profile', 'UpdateImageProfile@imageUpdate'); //caricale imagini profilo nella cartella profile_images
Route::post('/update_group_profile', 'Group@imageUpdate'); //caricale imagini gruppo nella cartella group_images

Route::post('/insert_form', 'UserController@registerData');//registrazione al db
Route::post('/login', 'UserController@loginData');//effettua login
Route::get('/settingaccount', 'UserController@passDataToAccount');//passa i dati all'account
Route::post('/modify_user_settings', 'UserController@modifyData');//consente all'user loggato di modificare l'account
Route::post('/publicPost','PostController@addUserPost');
Route::get('/followers','UserController@getFollower');
Route::get('/follows','UserController@getFollow');
Route::get('/group','Group@getViewGroup');
Route::get('/joinGroup','Group@joinManager');

////////////////////////TESTING/////////////////////////////////////////////////////
Route::get('/apiTest','Test@apiTest');
// Route::get('/test','Test@test');
