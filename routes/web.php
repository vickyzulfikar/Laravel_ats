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
    return view('hello');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/template', function () {
    return view('tampilan_template');
});

Route::get('/coba', function () {
    return view('test_templating.cobaaja');
});

Route::get('/cobadua', function () {
    return view('test_templating.dua');
});

Route::get('/informasi','BiodataController@index');
Route::post('/biodata/add','BiodataController@store');
Route::get('/biodata/{id}/edit','BiodataController@edit');
Route::post('/biodata/update','BiodataController@update');
Route::get('/biodata/destroy/{id}','BiodataController@destroy');