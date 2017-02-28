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

Route::resource('/', 'ConfessionController');

Auth::routes();

Route::get('list', 'ListController@index');
Route::get('list/{id}/send', 'ListController@send');
Route::get('list/{id}/delete', 'ListController@delete');
