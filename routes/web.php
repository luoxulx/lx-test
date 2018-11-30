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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/login', 'Auth\LoginController@index')->name('login');
//Route::group(['namespace'=>'Front'], function (){
//    Route::get('/xxx', 'ArticleController@index');
//    Route::get('/{slug}', 'ArticleController@show');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
