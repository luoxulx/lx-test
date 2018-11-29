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

Route::post('/login/login', 'Api\\V1\\AuthController@login');

Route::group(['namespace'=>'Api\\V1', 'middleware'=>['auth:api', 'operation']], function () { //'middleware'=>['auth:api']

    Route::post('/login/logout', 'AuthController@logout');
    Route::get('/user/user_info', 'UserController@user_info');
    Route::get('/user/transaction/list', 'UserController@transaction_list');

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
    Route::resource('comment', 'CommentController', ['names'=>[
        'index' => 'api.comment.index',
        'show' => 'api.comment.show',
        'store' => 'api.comment.store',
        'update' => 'api.comment.update',
        'destroy' => 'api.comment.destroy',
    ], 'except'=>['create', 'edit']]);


    // extend
    Route::get('/extend/laravel_log', 'LaravelLogController@index');

});

//open api
Route::group(['namespace'=>'Api\\V1', 'middleware'=>['operation']], function () {

    // qiniu tool 部分接口
    Route::post('/tool/image/upload', 'ImageController@store');
    Route::post('/tool/image/token', 'ImageController@upload_token');
    Route::post('/tool/image/list', 'ImageController@index');
    Route::post('/tool/image/delete', 'ImageController@delete');

});
