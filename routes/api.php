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
Route::post('/auth/login', 'Api\\V1\\AuthController@login');
Route::group(['namespace'=>'Api\\V1', 'middleware'=>['auth:api']], function () { //'middleware'=>['auth:api']

    Route::post('/auth/logout', 'AuthController@logout');

    Route::resource('tag', 'TagController', ['names'=>[
        'index' => 'api.tag.index',
        'show' => 'api.tag.show',
        'store' => 'api.tag.store',
        'update' => 'api.tag.update',
        'destroy' => 'api.tag.destroy',
    ], 'except'=>['create', 'edit']]);

    Route::resource('article', 'ArticleController', ['names'=>[
        'index' => 'api.article.index',
        'show' => 'api.article.show',
        'store' => 'api.article.store',
        'update' => 'api.article.update',
        'destroy' => 'api.article.destroy',
    ], 'except'=>['create', 'edit']]);

    Route::resource('category', 'CategoryController', ['names'=>[
        'index' => 'api.category.index',
        'show' => 'api.category.show',
        'store' => 'api.category.store',
        'update' => 'api.category.update',
        'destroy' => 'api.category.destroy',
    ], 'except'=>['create', 'edit']]);
});
