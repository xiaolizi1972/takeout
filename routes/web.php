<?php

/*
|--------------------------------------------------------------------------
| 后台路由管理
|--------------------------------------------------------------------------
|
| 作者:小李子
|
| 日期:2019-3-5
| 
| 版本:1.0.0
*/


Route::group(['namespace' => 'Admin','middleware'=>'admin'], function () {

	//首页路由
    Route::get('/','IndexController@index');
    Route::get('index/welcome','IndexController@welcome')->name('welcome');

    //管理员日志
    Route::get('adminLog/login','AdminLogController@login');
    Route::get('adminLog/action','AdminLogController@action');

    //管理员
    Route::get('admin/index','AdminController@index');
    Route::get('admin/create','AdminController@create');
    Route::get('admin/edit','AdminController@edit');
    Route::post('admin/store','AdminController@store');

});

Route::group(['namespace' => 'Admin'], function () {

    //登陆路由
    Route::post('login/login','LoginController@login')->name('login');
    Route::get('login/loginForm','LoginController@loginForm')->name('loginForm');
    Route::get('login/logout','LoginController@logout')->name('logout');

});
