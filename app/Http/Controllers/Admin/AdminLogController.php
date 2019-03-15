<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{AdminLog,AdminLoginLog};


class AdminLogController extends Controller
{
   

   	/**
   	 * 登录日志
	 *
	 * @return view [日志列表]
   	 */
	public function login()
	{

		$lists =  AdminLoginLog::orderBy('created_at','desc')->paginate(20);

		return view('admin_log.login',['lists'=>$lists]);
	}



	/**	
     * 操作日志
	 *
	 * @return  view  [日志列表]
     */
	public function action()
	{

		$lists =  AdminLog::orderBy('created_at','desc')->paginate(20);

		return view('admin_log.action',['lists'=>$lists]);
	}



}
