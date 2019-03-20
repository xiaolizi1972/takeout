<?php
namespace App\Http\Traits\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Models\{Admin,AdminLoginLog};

trait AdminTraits
{
	
	/**
     * 登录参数验证
     *
     * @param Request $request  验证参数 
     */
    public function loginValidate(Request $request)
    {

        $rules    =   [
            'username' => 'required',
            'password' => 'required'
        ];

        $messages =   [
            'username.required' => '请输入用户名',
            'password.required' => '请输入密码'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $errors = $validator->errors();

        if($errors->first('username')) {

            throw new \App\Exceptions\CustomException($errors->first('username'), 500);
        }

        if($errors->first('password')) {

            throw new \App\Exceptions\CustomException($errors->first('password'), 500);
        }

    }


    /**  
     * 今日登录失败是否超过次数
     */
    public function hasTooManyLoginAttempts(Request $request)
    {

        $num =  AdminLoginLog::where([
					['status','=',0],
					['ip','=',get_client_ip()],
					['username','=',$request->input('username')]
				])
                ->whereDate('created_at', date('Y-m-d'))
                ->count();
        return $num >= 5 ? true : false;
    }


	/**
	 * 新增登录失败记录
	 */
    public function incrementLoginAttempts(Request $request)
    {
        try {
           
			$data  = [
				'status'	=> 	0,
				'remark'	=>	'登录失败',
				'ip'		=> 	get_client_ip(),
				'username' 	=> 	$request->input('username')
			];
			
			AdminLoginLog::create($data);
			
        } catch (\Exception $e) {
            
           log_record('增加管理员登录日志错误');
        }
    }

	
    /**
     * 尝试登录
     * 
     * @param   Request $request  登录数据
     * @return  boole
     */
    public function loginAttempts(Request $request)
    {  

        $result  =  Admin::where('username', $request->input('username'))->first();

        if(!$result){

            throw new \App\Exceptions\CustomException("该账号不存在", 500);
        }
        if(!$result['status']){

            throw new \App\Exceptions\CustomException("该账号已被冻结请联系管理员", 500);
        }

        if (!password_verify($request->input('password'), $result['password'])) {
            
			return false;
        } 
		
		session(['admin'=>$result]);
		
		return true;	
    }
	
	
	/**	
	 * 登录成功记录日志
	 *
	 * @return boole
	 */
	public function loginSuccessLog(Request $request)
	{
		try {
			
			//更新之前错误日志
			AdminLoginLog::where([
				['status', '=', 0],
				['username','=',$request->input('username')]
			])
			->whereDate('created_at', date('Y-m-d'))
			->update(['status'=>1]);
			
			//存入最新成功日志
			$data = [
				'status'   => 1,
				'remark'   => '登录成功',
				'ip' 	   => get_client_ip(),
				'username' => $request->input('username'),
			];
			
			AdminLoginLog::create($data);
			
		} catch (\Exception $e){
			
			log_record('登录成功-记录管理员登录日志错误');
		}
		
		return true;
	}
	

}