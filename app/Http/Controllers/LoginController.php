<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Traits\Admin\AdminTraits;


class LoginController extends Controller
{
	
	use AdminTraits;

	public function loginForm()
	{

		return view('login.login');
	}


	public function login(LoginRequest $request)
	{

		$data = $request->only(['username', 'password']);

 
        //超出限制登录次数
        if($this->hasTooManyLoginAttempts($request)){

            throw new \App\Exceptions\Custom('登录失败达到最大次数', 419);
        }

        //尝试登录
        if(!$this->loginAttempts($request)){

            $this->incrementLoginAttempts($request);

            throw new \App\Exceptions\Custom('用户名或密码错误', 419);
        }
		
		//登录成功日志
		$this->loginSuccessLog($request);

        return json(200, '登录成功');

	}
		


	/**
	 *   
	 *
	 */
	public function logout()
	{
		session()->flush();
        
        return redirect('login/loginForm');

	}
	
}