<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * 设置请求规则
     *
     * @return array
     */
    public function rules()
    {
        return [

            'username'              => 'required|exists:admins,username',
            'password'              => 'required|alpha_dash',
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
            'exists'                =>  ':attribute 不存在或被冻结',
            'alpha_dash'            =>  ':attribute 格式错误'
        ];
    }

    public function attributes()
    {
        return [
            'username'             =>  '账号',
            'password'             =>  '密码',
        ];
    }


}
