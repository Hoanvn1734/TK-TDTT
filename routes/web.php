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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ping', 'SolariumController@ping');

Route::get('/suggest', 'SolariumController@suggest');

Route::get('/search', 'SolariumController@getSearch');

Route::get('/result', [
	'as'=>'ketqua',
	'uses'=>'SolariumController@result'
]);
