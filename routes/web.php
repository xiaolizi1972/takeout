<?php

/*
|-------------------------------
| 后台路由管理
|-------------------------------
|
| 作者:小李子
|
| 日期:2019-3-5
| 
| 版本:1.0.0
*/


// Route::group(['namespace' => 'Admin','middleware'=>'admin'], function () {

// 	/*首页路由*/
//     Route::get('/','IndexController@index');
//     Route::get('index/welcome','IndexController@welcome')->name('welcome');
//     Route::get('index/notFound','IndexController@notFound');
//     Route::get('index/serverError','IndexController@serverError');

//     /*管理员日志*/
//     Route::get('adminLog/login','AdminLogController@login');
//     Route::get('adminLog/action','AdminLogController@action');

//     /*管理员*/
//     Route::get('admin/index','AdminController@index');
//     Route::get('admin/create','AdminController@create');
//     Route::get('admin/edit/{id}','AdminController@edit');
//     Route::post('admin/store','AdminController@store');
//     Route::any('admin/update/{id}','AdminController@update');
//     Route::get('admin/destroy/{id}','AdminController@destroy');

//     /*权限节点*/
//     Route::get('node/index','NodeController@index');
//     Route::get('node/create','NodeController@create');
//     Route::post('node/store','NodeController@store');
//     Route::get('node/edit/{id}','NodeController@edit');
//     Route::any('node/update/{id}','NodeController@update');
//     Route::get('node/destroy/{id}','NodeController@destroy');

//     /*权限组*/
//     Route::get('NodeGroup/index','NodeGroupController@index');
//     Route::get('NodeGroup/create','NodeGroupController@create');
//     Route::post('NodeGroup/store','NodeGroupController@store');
//     Route::get('NodeGroup/edit/{id}','NodeGroupController@edit');
//     Route::any('NodeGroup/update/{id}','NodeGroupController@update');
//     Route::get('NodeGroup/destroy/{id}','NodeGroupController@destroy');

//     /*角色*/
//     Route::get('role/index','RoleController@index');
//     Route::get('role/create','RoleController@create');
//     Route::post('role/store','RoleController@store');
//     Route::get('role/edit/{id}','RoleController@edit');
//     Route::any('role/update/{id}','RoleController@update');
//     Route::get('role/destroy/{id}','RoleController@destroy');

// });

// Route::group(['namespace' => 'Admin'], function () {

//     /*登陆路由*/
//     Route::post('login/login','LoginController@login')->name('login');
//     Route::get('login/loginForm','LoginController@loginForm')->name('loginForm');
//     Route::get('login/logout','LoginController@logout')->name('logout');

// });

//使用admin中间件
Route::middleware(['admin'])->group(function () {
    
    /*首页路由*/
    Route::get('/','IndexController@index');
    Route::get('index/welcome','IndexController@welcome')->name('welcome');
    // Route::get('index/notFound','IndexController@notFound');
    // Route::get('index/serverError','IndexController@serverError');


    //节点
    Route::get('node/index','NodeController@index');
    Route::post('node/store','NodeController@store');






});

//不使用中间件
Route::post('login/login','LoginController@login')->name('login');
Route::get('login/logout','LoginController@logout')->name('logout');
Route::get('login/loginForm','LoginController@loginForm')->name('loginForm');