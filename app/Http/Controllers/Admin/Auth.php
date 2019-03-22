<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\{Admin,Node,AdminRole,RoleNode,NodeGroup};

class Auth
{

    /**
     * 验证管理员是否
     * 
     */
    public static function check(Request $request)
    {

        //$request->dd();

    }
    

    /**
     * 获取当前登录用户菜单权限
     * 
     * 
     * @return [type] [description]
     */
    public static function menu()
    {

        $role_id    =   AdminRole::where('admin_id', self::id())->value('role_id');
        $node_arr   =   RoleNode::where('role_id', $role_id)->pluck('node_id');
        $group_arr  =   Node::whereIn('id', $node_arr)->groupBy('group_id')->pluck('group_id');

        $groups     =  NodeGroup::whereIn('id',$group_arr)->orderBy('sort','desc')->get();

        foreach ($groups as $key => $val) {
    
            $groups[$key]['node'] =  Node::where([['pid','=','0'],['visible','=','1'],['group_id','=',$val['id']]])
                                    ->orderBy('sort','desc')
                                    ->get();
        }

        return $groups;
    }


    /**
     * 获取当前登录用户信息
     * 
     * 
     * @return admin
     */
    public static function user()
    {
        return Admin::find($this->id());
    }


    /**
     * 当前登录用户的id
     * 
     * @return [type] [description]
     */
    public static function id()
    {
        return session('admin.id');
    }

}