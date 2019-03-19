<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\Admin\AdminTraits;


/*
 | -----------------------------
 | 登录处理
 | -----------------------------
 | 
 | 作者:小李子
 | 
 | 日期:2019-3-5
 | 
 | 版本:1.0.0
 */

class LoginController extends Controller
{

    use AdminTraits;


    /**
     * 登陆页
     *
     * @return view
     */
    public function loginForm()
    {
        //echo password_hash('123456', PASSWORD_DEFAULT);

        return view('admin.login.login');
    }


    /**
     * 登陆提交处理
     *
     * @return  json 
     */
    public function login(Request $request)
    {

        $data = $request->only(['username', 'password']);

        $this->loginValidate($request);

        //超出限制登录次数
        if($this->hasTooManyLoginAttempts($request)){

            throw new \App\Exceptions\CustomException('登录失败达到最大次数', 500);
        }

        //尝试登录
        if(!$this->loginAttempts($request)){

            $this->incrementLoginAttempts($request);

            throw new \App\Exceptions\CustomException('用户名或密码错误', 500);
        }
		
		//登录成功日志
		$this->loginSuccessLog($request);

        return json(200, '登录成功');
    }


    /**
     * 退出登陆 
     */
    public function logout()
    {
        session()->flush();
        return redirect('login/loginForm');
    }


}
