<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NodeRequest extends FormRequest
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
        return [

            'name'              => 'required',
            'route'             => 'required',
            'group_id'          => 'required|numeric',
            'pid'               => 'required|numeric',
            'visible'           => 'required|numeric',
            'sort'              => 'numeric',
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
            'integer'               =>  ':attribute 整型',
        ];
    }

    public function attributes()
    {
        return [
            'name'              => '名称',
            'route'             => '路由',
            'group_id'          => '分组',
            'pid'               => '父级',
            'sort'              => '排序',
            'visible'           => '菜单显示',
        ];
    }


}
