<?php


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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['namespace'=>'Api\\V1', ], function () { //'middleware'=>['auth:api']
    Route::get('dashboard', function (){
        return view('welcome');
    });
    Route::post('/auth/login', 'AuthController@login');
    Route::post('/auth/logout', 'AuthController@logout');

    Route::resource('tag', 'TagController', ['names'=>[
        'index' => 'api.article.index',
        'create' => 'api.article.create',
        'show' => 'api.article.show',
        'store' => 'api.article.store',
        'edit' => 'api.article.edit',
        'update' => 'api.article.update',
        'destroy' => 'api.article.destroy',
    ], 'except'=>['']]);
});
