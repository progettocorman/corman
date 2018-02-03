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

Route::get('/home', 'UserController@getHome'); //reindirizzamneto alla home con passaggio parametri


//ENRICO E RICCARDO
Route::get('/api','Api@dblpApi');//Aggiornamento automatico pubblicazioni

//ANTONIO
Route::get('/formregister', function () {
    return view('formview');
});

Route::get('/userprofile', function () {
    return view('userprofile');
});
Route::get('/group', function () {
    return view('group');
});
Route::get('/test2', function () {
    return view('test');
});
Route::get('/post', function() {
  return view('post');
});

Route::post('/insert_form', 'UserController@registerData');//registrazione al db
Route::post('/login', 'UserController@loginData');//effettua login
Route::get('/settingaccount', 'UserController@passDataToAccount');//passa i dati all'account
Route::post('/modify_user_settings', 'UserController@modifyData');//consente all'user loggato di modificare l'account

////////////////////////TESTING/////////////////////////////////////////////////////
Route::get('/apiTest','Test@apiTest');
Route::get('/test','Test@test');
