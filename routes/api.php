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

Route::post('/auth/login', 'Api\\V1\\AuthController@login')->name('api.auth.login');

Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('/auth/refresh', 'Api\\V1\\AuthController@refershToken')->name('api.auth.refresh');
});

// open api
Route::get('/open/captcha', 'Api\\V1\\OpenController@captcha')->name('api.open.captcha');

// 后台接口  会JWT鉴权
Route::group(['namespace'=>'Api\\V1', 'middleware'=>['auth:api', 'operation']], function () { //'middleware'=>['auth:api', 'operation']

    Route::post('/auth/logout', 'AuthController@logout')->name('api.auth.logout');

    Route::get('/user/user_info', 'UserController@user_info')->name('api.user.user_info');
    Route::get('/user/transaction/list', 'UserController@transaction_list');

    Route::resource('user', 'UserController', ['names'=>[
        'index' => 'api.user.index',
        'store' => 'api.user.store',
        'show' => 'api.user.show',
        'update' => 'api.user.update',
        'destroy' => 'api.user.destroy',
    ], 'except'=>['create', 'edit']]);

    Route::resource('tag', 'TagController', ['names'=>[
        'index' => 'api.tag.index',
        'store' => 'api.tag.store',
        'show' => 'api.tag.show',
        'update' => 'api.tag.update',
        'destroy' => 'api.tag.destroy',
    ], 'except'=>['create', 'edit']]);

    Route::resource('article', 'ArticleController', ['names'=>[
        'index' => 'api.article.index',
        'store' => 'api.article.store',
        'show' => 'api.article.show',
        'update' => 'api.article.update',
        'destroy' => 'api.article.destroy',
    ], 'except'=>['create', 'edit']]);

    Route::resource('category', 'CategoryController', ['names'=>[
        'index' => 'api.category.index',
        'store' => 'api.category.store',
        'show' => 'api.category.show',
        'update' => 'api.category.update',
        'destroy' => 'api.category.destroy',
    ], 'except'=>['create', 'edit']]);
    Route::resource('comment', 'CommentController', ['names'=>[
        'index' => 'api.comment.index',
        'store' => 'api.comment.store',
        'show' => 'api.comment.show',
        'update' => 'api.comment.update',
        'destroy' => 'api.comment.destroy',
    ], 'except'=>['create', 'edit']]);

    // extend
    Route::get('/extend/laravel_log', 'LaravelLogController@index')->name('api.extend.laravel_log');

    // file -------------------- manage
    Route::post('/file/upload', 'FileController@fileUpload')->name('api.file.upload');
    Route::post('/pic/upload', 'FileController@picUpload')->name('api.pic.upload');
    Route::post('/file/file_index', 'FileController@fileIndex')->name('api.file.file_index');

});

//open api 只校验 Access-Key
Route::group(['namespace'=>'Api\\V1', ], function () {//'middleware'=>['operation','open.api']

    Route::post('/mail/send', 'MailController@sendMail');
    Route::get('/mail/show', 'MailController@show');

});
