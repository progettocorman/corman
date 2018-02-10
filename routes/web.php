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
//indirizza alla home
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'UserController@getHome'); //indirizzamneto alla home con passaggio parametri

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

//ANTONIO
Route::get('/formregister', function () {
    return view('formview');
});

Route::get('/modify', function () {
    return view('modify');
});

Route::get('/setting_group', function () {
    return view('setting_group');
});

Route::get('/tot_pubblicazioni', function () {
    return view('tot_pubblicazioni');
});

Route::get('/notifications', function () {
    return view('notifications');
});

Route::get('/tot_post', function () {
    return view('tot_post');
});



Route::get('/group',function(){
    $id = session('id');
    $query = DB::table('users')->select('*')->where('id', $id)->first();
    return view('group')->with("name",$query->name)->with("last_name",$query->last_name)
    ->with("affiliation",$query->affiliation);
});//indirizzamneto ai gruppi

Route::get('/test2', function () {
    return view('test');
});

Route::get('/post', 'PostController@getPostView'); //restituisce la view post con passaggio parametri

Route::get('/pubblicazione', 'PublicationController@getPubblicazioneView');//  return view('pubblicazione')con parametri;

Route::post('/publicPost','PostController@addUserPost');

Route::post('/update_image_profile', 'UpdateImageProfile@imageUpdate'); //caricale imagini profilo nella cartella profile_images

Route::post('/insert_form', 'UserController@registerData');//registrazione al db
Route::post('/login', 'UserController@loginData');//effettua login
Route::get('/settingaccount', 'UserController@passDataToAccount');//passa i dati all'account
Route::post('/modify_user_settings', 'UserController@modifyData');//consente all'user loggato di modificare l'account
Route::post('/publicPost','PostController@addUserPost');
Route::get('/followers','UserController@getFollower');
Route::get('/follows','UserController@getFollow');
Route::get('/group','Group@getViewGroup');
////////////////////////TESTING/////////////////////////////////////////////////////
Route::get('/apiTest','Test@apiTest');
// Route::get('/test','Test@test');
