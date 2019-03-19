<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('id');

       //echo $id;die;

        return [

            'username'              => 'required|unique:admins,username,'.$id,
           // 'password'              => 'filled|alpha_num|confirmed',
            'mobile'                => 'filled|numeric|unique:admins,mobile,'.$id,
            'status'                => 'required|integer',
        ];
    }



    /**
     * 获取被定义验证规则的错误消息
     *
     * @return array
     * @translator laravelacademy.org
     */
    public function messages()
    {
        return [
            'required'              =>  ':attribute 必须',
            'unique'                =>  ':attribute 已存在',
            'alpha_num'             =>  ':attribute 格式错误',
            'numeric'               =>  ':attribute 纯数字',
            'integer'               =>  ':attribute 整型',
			'confirmed'				=>  ':attribute 不一致',
        ];
    }

    public function attributes()
    {
        return [
            'username'             =>  '管理员账号',
            'password'             =>  '密码',
            //'confirme'   		   =>  '密码两次输入',
            'mobile'               =>  '手机号',
            'status'               =>  '账号状态'
        ];
    }


}
