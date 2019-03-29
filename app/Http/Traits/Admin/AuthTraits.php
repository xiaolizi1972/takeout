<?php
namespace App\Http\Traits\Admin;

use Illuminate\Http\Request;
use App\Models\{Admin,Node,AdminRole,RoleNode};

trait AdminTraits
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
        //根据用户查出角色
        //根据角色查出菜单节点
        //根据节点查出分组
        //返回组装数据
   
        $role_id    =   AdminRole::where('admin_id', self::id())->value('id');
        $node_arr   =   RoleNode::where('role_id', $role_id)->pluck('node_id');
        $group_arr  =   Node::whereIn('id', $node_arr)->groupBy('group_id')->pluck('group_id');

        $nodes      =   Node::whereIn('id', $node_arr)
                        ->where([['pid','=','0'],['visible','=','1']])
                        ->orderBy('sort desc')
                        ->get();

        $groups     =  NodeGroup::whereIn('id',$group_arr)->orderBy('sort desc')->get();

        foreach ($groups as $key => $val) {
    
            $groups[$key]['node'] =  Node::where([['pid','=','0'],['visible','=','1'],['group_id','=',$val['group_id']]])
                                    ->orderBy('sort desc')
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
        return Admin::find(self::id());
    }


    /**
     * 当前登录用户的id
     * 
     * @return [type] [description]
     */
    public static function id()
    {
        return session('admin_id');
    }

}