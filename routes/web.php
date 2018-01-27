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
use App\Publication;
use App\UsersPublication;

Route::get('/', function () {
    return view('welcome');
});

//ENRICO E RICCARDO
Route::get('/api','Api@dblpApi');//Aggiornamento automatico pubblicazioni
Route::get('/acceptance','Notification@acceptance');//Accettazione Notifica

//ANTONIO
Route::get('/formregister', function () {
    return view('formview');
});
Route::post('/insert_form', 'UserController@inviaDati');//inserisce i dati nel database
Route::post('/login', 'UserController@verificaDati');//prende i dati dal database

////////////////////////TESTING/////////////////////////////////////////////////////
Route::get('/apiTest','Test@apiTest');
Route::get('/test','Test@test');
Route::get('/acceptanceTest','Notification@acceptance');
