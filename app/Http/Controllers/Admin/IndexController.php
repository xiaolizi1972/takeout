<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/**
 * ======================
 * 作者:小李子
 *
 * 说明:后台首页
 *
 * 日期:2019-3-5
 * =======================
 */

class IndexController extends BaseController
{


    /**
     * 首页
     *
     * @return [返回视图]
     */
    public function index()
    {

        // echo Route::current(); 
        // // 获取当前路由名称
        // echo Route::currentRouteName();
        // // 获取当前路由action属性
        // echo Route::currentRouteAction();

        return view('admin.index.index');
    }



    /**
     * 欢迎页
     *
     * @return [返回视图]
     */
    public function welcome()
    {
        
        return view('admin.index.welcome');
    }


    /**
     * 未找到
     * 
     * @return [type] [description]
     */
    public function notFound()
    {
        return view('admin.public.404');
    }


    /**
     * 服务器错误
     * 
     * @return [type] [description]
     */
    public function serverError()
    {
        return view('admin.public.500');
    } 

    

    /**
     * 未授权
     * @return [type] [description]
     */
    public function serverDenied()
    {

        return view('admin.public.403');
    }


}
