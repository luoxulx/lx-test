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

/* Dashboard Index *///, 'middleware' => ['auth', 'admin']
Route::group(['prefix' => 'uslx'], function () {
   Route::get('{path?}', function(){
   		return view('app.dashboard');
   })->where('path', '[\/\w\.-]*');
});
