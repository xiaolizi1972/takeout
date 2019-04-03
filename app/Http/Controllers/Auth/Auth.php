<?php
namespace App\Http\Controllers\Auth;

use App\Models\Admin;

class Auth
{
	
	//登录管理员ID
	public static function id()
	{
		return session('admin_id');
	}


	//是否有权限此操作
	public static function check()
	{
		return session('admin_id') ?  true :false;
	}


	//登录管理员信息
	public static function user()
	{
		return Admin::find(session('admin_id'));
	}


	//记住登录管理员
	public static function login($admin_id)
	{

		session(['admin_id' => $admin_id]);
	}
	

	//清除登录管理员信息
	public static function logout()
	{


	}


	public static function isLogin()
	{
		return session('admin_id') ?  true :false;
	}


}