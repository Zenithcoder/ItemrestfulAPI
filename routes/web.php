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

/*

Route::get('/', 'EventController@index')->name('home');
Route::post('/store-event', 'EventController@store')->name('home.store');
*/
Route::get('/', function () {
    return view('index');
});

Route::resource('api/items', 'ItemsController');