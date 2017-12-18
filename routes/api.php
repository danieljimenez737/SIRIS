<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::resource('read_htmls', 'readHtmlAPIController');
Route::get('readHtmls', 'readHtmlAPIController@start');
Route::get('getLocations2', 'readHtmlAPIController@search');
Route::get('tfidf', 'readHtmlAPIController@getDocumentosDB');
Route::get('getLocations', 'readHtmlAPIController@getLocations');
Route::post('filtrar', 'readHtmlAPIController@filtrar');

Route::resource('users', 'usersAPIController');

Route::resource('terminos', 'terminosAPIController');

Route::resource('documentos', 'documentoAPIController');

Route::resource('ubicacions', 'ubicacionAPIController');