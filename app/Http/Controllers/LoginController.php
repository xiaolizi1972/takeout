<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\AdminTraits;


class LoginController extends Controller
{
	
	use AdminTraits;

	public function loginForm()
	{
		return view('login.login');
	}


	/**
	 * 登录
	 */
	public function login(LoginRequest $request)
	{
        //超出限制登录次数
        if($this->hasTooManyLoginAttempts($request)){

            throw new \App\Exceptions\Custom('登录失败达到最大次数', 419);
        }

        //登录处理
        if(!$this->loginHandle($request)){

        	$this->loginFailureResponse($request);
        }

    	$this->loginSuccessLog($request);

    	return json(200, '登录成功');
	}
		

	/**
	 * 退出登录  
	 *
	 */
	public function logout()
	{
		session()->flush();
        
        return redirect('login/loginForm');
	}
	
}