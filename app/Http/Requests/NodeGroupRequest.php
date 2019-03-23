<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NodeGroupRequest extends FormRequest
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
     * 定义规则
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name'              => 'required',
            'visible'           => 'required|numeric',
            'sort'              => 'numeric',
            'icon'              => 'required'
        ];
    }


    /**
     * 定义错误消息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'              =>  ':attribute 必须',
            'numeric'               =>  ':attribute 数字',
        ];
    }


    /**
     * 翻译字段
     * 
     * 
     */
    public function attributes()
    {
        return [
            'name'              => '名称',
            'visible'           => '菜单',
            'sort'              => '排序',
            'icon'              => '图标'
        ];
    }




}