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
/**
 * rutas utilizadas 
 */
 
Route::get('/', function () {
	   
    return view('home');
});
Route::get('/main', function () {
	   
    return view('main');
});
 
Route::get('/administrador', function () {
	   
    return view('auth.login');
});
Auth::routes();
Route::get('view', 'readHtml@start');

Route::resource('readHtmls', 'readHtmlController');

Route::get('/home', 'HomeController@index');

Route::resource('users', 'usersController');

Route::resource('terminos', 'terminosController');

Route::resource('documentos', 'documentoController');
Route::get('/noticias', 'documentoController@start');

Route::resource('ubicacions', 'ubicacionController');