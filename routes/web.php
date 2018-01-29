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


//ENRICO E RICCARDO
Route::get('/api','Api@dblpApi');//Aggiornamento automatico pubblicazioni

//ANTONIO
Route::get('/formregister', function () {
    return view('formview');
});
Route::post('/insert_form', 'UserController@inviaDati');//inserisce i dati nel database
Route::post('/login', 'UserController@verificaDati');//prende i dati dal database

////////////////////////TESTING/////////////////////////////////////////////////////
Route::get('/apiTest','Test@apiTest');
Route::get('/test','Test@test');
