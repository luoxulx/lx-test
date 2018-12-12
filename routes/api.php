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

Route::post('/login/login', 'Api\\V1\\AuthController@login')->name('api.login.login');

//Route::group(['middleware' => 'jwt.refresh'], function(){
//    Route::get('/login/refresh', 'Api\\V1\\AuthController@refresh');
//});

// 后台接口  会JWT鉴权
Route::group(['namespace'=>'Api\\V1', ], function () { //'middleware'=>['auth:api', 'operation']

    Route::post('/login/logout', 'AuthController@logout')->name('api.login.logout');
    Route::get('/user/user_info', 'UserController@user_info')->name('api.user.user_info');
    Route::get('/user/transaction/list', 'UserController@transaction_list');

    Route::resource('user', 'UserController', ['names'=>[
        'index' => 'api.user.index',
        'show' => 'api.user.show',
        'store' => 'api.user.store',
        'update' => 'api.user.update',
        'destroy' => 'api.user.destroy',
    ], 'except'=>['create', 'edit']]);

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
    Route::get('/extend/laravel_log', 'LaravelLogController@index')->name('api.extend.laravel_log');

    // qiniu tool 部分接口
    Route::post('/qiniu_file/upload', 'QniuFileController@store')->name('api.qiniu_file.upload');
    Route::post('/qiniu_file/token', 'QniuFileController@upload_token')->name('api.qiniu_file.upload_token');
    Route::post('/qiniu_file/list', 'QniuFileController@index')->name('api.qiniu_file.index');
    Route::post('/qiniu_file/delete', 'QniuFileController@delete')->name('api.qiniu_file.delete');

    //上传至磁盘 部分接口

});

//open api 只校验 Access-Key
Route::group(['namespace'=>'Api\\V1', ], function () {//'middleware'=>['operation','open.api']

    Route::post('/mail/send', 'MailController@sendMail');
    Route::get('/mail/show', 'MailController@show');

});
