<?php
namespace App\Http\Traits;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\Auth;
use \App\Http\Repository\{AdminLoginLogRepository, AdminRepository};


trait AdminTraits
{
    
  
    /**  
     * 今日登录失败是否超过次数(默认限制5次)
     */
    public function hasTooManyLoginAttempts(Request $request)
    {
        $num =  $this->guard()->failuresDayCount($request->input('usernmae'));

        return $num == config('app.login_failures_num') ? true : false;
    }


    /**
     * 登录处理
     * 
     * @param   Request $request  登录数据
     * @return  void
     */
    public function loginHandle(Request $request)
    {  

        $Admin  = new AdminRepository;

        $login_admin = $Admin->findBy('username', $request->input('username'));

        if(!$login_admin['status']){

            throw new \App\Exceptions\Custom("该账号已被冻结请联系管理员", 419);
        }

        if (!password_verify($request->input('password'), $login_admin['password'])) {
            
            return false;
        } 

        Auth::login($login_admin['id']);

        return true;
    }
    

    /**
     * 登录成功日志
     */
    public function loginSuccessLog(Request $request)
    {
        try {
                 
            //存入最新成功日志
            $data = [

                'status'   => 1,
                'remark'   => '登录成功',
                'ip'       => get_client_ip(),
                'username' => $request->input('username'),
            ];
                
            $this->guard()->create($data);
            $this->guard()->updateFailuresRecord($request->input('username'));
                
        } catch (\Exception $e){
                
            log_record('登录成功-记录管理员登录日志错误');
        }
    }


    /**
     * 返回登录失败响应
     */
    public function loginFailureResponse(Request $request)
    {
        try {
            
            $data  = [
                'status'    =>  0,
                'remark'    =>  '登录失败',
                'ip'        =>  get_client_ip(),
                'username'  =>  $request->input('username')
            ];

            $this->guard()->create($data);

        } catch (\Exception $e) {
            
            log_record('登录失败-记录管理员登录日志错误');
        }

        throw new \App\Exceptions\Custom("账号或密码错误", 500);
    }



    public function guard()
    {
        return new AdminLoginLogRepository;
    }

}