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

// 原本的Auth login
Auth::routes();
// Socialite Auth
Route::group(['namespace'=>'Auth'], function (){
    Route::get('/github/auth/login', 'AuthGithubController@redirectToProvider')->name('github.auth.login');
    Route::get('/github/auth/callback', 'AuthGithubController@handleProviderCallback')->name('github.auth.callback');
    Route::get('/github/privacy_policy', 'AuthGithubController@privacyPolicyView')->name('github.privacy_policy');

    Route::get('/facebook/auth/login', 'AuthFacebookController@redirectToProvider')->name('facebook.auth.login');
    Route::get('/facebook/auth/callback', 'AuthFacebookController@handleProviderCallback')->name('facebook.auth.callback');
    Route::get('/facebook/privacy_policy', 'AuthFacebookController@privacyPolicyView')->name('facebook.privacy_policy');

    Route::get('/google/auth/login', 'AuthGoogleController@redirectToProvider')->name('google.auth.login');
    Route::get('/google/auth/callback', 'AuthGoogleController@handleProviderCallback')->name('google.auth.callback');
    Route::get('/google/privacy_policy', 'AuthGoogleController@privacyPolicyView')->name('google.privacy_policy');
});

Route::group(['namespace'=>'Front'], function (){
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/post', 'ArticleController@index');
    Route::get('/{slug}', 'ArticleController@show');
});

