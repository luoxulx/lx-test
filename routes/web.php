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

//Route::get('/', function () {
//    return view('welcome');
//});

//原本的Auth login
Auth::routes();
//Auth
Route::group(['namespace'=>'Auth'], function (){
    Route::get('/github/auth/login', 'AuthGithubController@redirectToProvider')->name('github.auth.login');
    Route::get('/github/auth/callback', 'AuthGithubController@handleProviderCallback')->name('github.auth.callback');
});

Route::group(['namespace'=>'Front'], function (){
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/post', 'ArticleController@index');
    Route::get('/{slug}', 'ArticleController@show');
});

