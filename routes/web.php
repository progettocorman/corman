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

<<<<<<< HEAD
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
=======

Route::get('formregister', function () {
    return view('formview');
});

//inserisce i dati nel database
Route::post('insert_form', 'Controller@inviaDati');

//prende i dati dal database
Route::post('login', 'Controller@verificaDati');
>>>>>>> 8bbff71aeff76f0d5390b0dbfcbd450452764667
