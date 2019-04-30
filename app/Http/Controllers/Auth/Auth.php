<?php
namespace App\Http\Controllers\Auth;

use App\Models\{Admin,AdminLog,AdminLoginLog};

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



	/**
	 * 操作日志 
	 *
	 *
	 */
	public function actionLog()
	{


	}


	/**
	 * 登录日志 
	 *
	 * @param  string  $username  [账号]
	 * @param  int     $status    [登录状态:1成功2失败]
	 * @param  string  $remark    [日志描述]
	 */
	public static function loginLog($username, $status, $remark)
	{
		$data = [

			'admin_id' 	=>  self::id(),
			'username'	=>  $username;,
			'ip'		=>  get_client_ip(),
			'status'	=>  $status,
			'remark'	=>	,
		];

		try {
			
			AdminActionLog::create($data);

		} catch (\Exception $e) {

			actionLog('username', 'error')
		}
	}

}