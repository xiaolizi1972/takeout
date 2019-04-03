<?php
namespace App\Http\Traits\Admin;

use Validator;
use Illuminate\Http\Request;


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
     * 新增登录失败记录
     */
    public function incrementLoginAttempts(Request $request)
    {
        try {
           
            $data  = [
                'status'    =>  0,
                'remark'    =>  '登录失败',
                'ip'        =>  get_client_ip(),
                'username'  =>  $request->input('username')
            ];
            
            AdminLoginLog::create($data);
            
        } catch (\Exception $e) {
            
           log_record('增加管理员登录日志错误');
        }
    }

    
    /**
     * 登录处理
     * 
     * @param   Request $request  登录数据
     * @return  void
     */
    public function loginHandle(Request $request)
    {  

        $result  =  Admin::where('username', $request->input('username'))->first();

        if(!$result['status']){

            throw new \App\Exceptions\Custom("该账号已被冻结请联系管理员", 419);
        }

        if (!password_verify($request->input('password'), $result['password'])) {
            
            return false;
        } 
        
        session(['admin'=>$result]);    
    }
    
    
    /** 
     * 登录成功记录日志
     *
     * @return boole
     */
    // public function loginSuccessLog(Request $request)
    // {
    //  try {
            
    //      //更新之前错误日志
    //      AdminLoginLog::where([
    //          ['status', '=', 0],
    //          ['username','=',$request->input('username')]
    //      ])
    //      ->whereDate('created_at', date('Y-m-d'))
    //      ->update(['status'=>1]);
            
    //      //存入最新成功日志
    //      $data = [
    //          'status'   => 1,
    //          'remark'   => '登录成功',
    //          'ip'       => get_client_ip(),
    //          'username' => $request->input('username'),
    //      ];
            
    //      AdminLoginLog::create($data);
            
    //  } catch (\Exception $e){
            
    //      log_record('登录成功-记录管理员登录日志错误');
    //  }
        
    //  return true;
    // }
    

    public function guard()
    {

        return new AdminLoginLogRepository;
    }

}