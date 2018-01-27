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


Route::get('formregister', function () {
    return view('formview');
});

//inserisce i dati nel database
Route::post('insert_form', 'Controller@inviaDati');

//prende i dati dal database
Route::post('login', 'Controller@verificaDati');