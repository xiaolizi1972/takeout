<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * ======================
 * 作者:小李子
 *
 * 说明:后台首页
 *
 * 日期:2019-3-5
 * =======================
 */

class IndexController extends Controller
{


    /**
     * 首页
     *
     * @return [返回视图]
     */
    public function index()
    {

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

    
}
