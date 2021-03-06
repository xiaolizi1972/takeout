<?php
namespace App\Http\Repository;

use App\Models\{Node,NodeGroup,RoleNode};

/**
 | -------------------
 | 菜单数据仓库
 | -------------------
 | 
 | 作者:小李子
 | 
 | 日期:2019-3-17
 |
 | 版本:1.0.0 
 */

class NodeRepository extends BaseRepository
{
    
    public function __construct()
    {
        $this->model = new Node;
    }



    /**
     * 获取节点下的全部子级
     * 
     * @param  int  $pid  [父级id] 
     * @return array  
     */
    public function nodeBychildAll($pid)
    {
        return $this->model->where('pid', $pid)->get();
    }


    /**
     * 权限节点树
     * 
     */
    public function tree()
    {

        $lists =  $this->model->where('pid',0)->get();

        foreach ($lists as $key => $val) {
    
            $lists[$key]['child'] =  $this->model->where('pid', $val['id'])->get();
        }

        return $lists;
    }



    /**
     * 节点树
     * 
     * 
     */
    public function nodeTree()
    {

        $groups =  NodeGroup::with('node_tree')->select('name','id')->get()->toArray();

        $data   =  [];
        //组
        foreach ($groups as $key => $val) {

            $data[$key]['checked']  = false;
            $data[$key]['disabled'] = false;
            $data[$key]['value']    = $val['id'];
            $data[$key]['name']     = $val['name'];

            //父级
            foreach ($val['node_tree'] as $ke => $va) {
               
                $data[$key]['list'][$ke]['checked']  = false;
                $data[$key]['list'][$ke]['disabled'] = false;
                $data[$key]['list'][$ke]['value']    = $va['id'];
                $data[$key]['list'][$ke]['name']     = $va['name'];

                //子级
                $child = $this->model->where('pid', '=', $va['id'])->select('id','name')->get();

                if($child){

                    foreach ($child as $k => $v) {
                        
                        $data[$key]['list'][$ke]['list'][$k]['checked']  = false;
                        $data[$key]['list'][$ke]['list'][$k]['disabled'] = false;
                        $data[$key]['list'][$ke]['list'][$k]['value']    = $v['id'];
                        $data[$key]['list'][$ke]['list'][$k]['name']     = $v['name'];
                    }
                }
            }
        }

        return $data;
    }



    /**
     * 角色节点 
     *
     *
     */
    public function roleNode($role_id)
    {
        //获取
        $node_arr =  RoleNode::where('role_id', $role_id)->pluck('node_id');

        $parents  =  $this->model->whereIn('id', $node_arr)->get()->toArray();

        $group_arr = array_unique(array_column($parents, 'group_id'));

        //pr($group_arr);die;

        $groups   =  NodeGroup::whereIn('id', $node_arr)->select('name')->get();

        $data = [];

        foreach ($groups as $key => $val) {
           
            $data[$key]['checked']  = false;
            $data[$key]['disabled'] = false;
            $data[$key]['value']    = $val['id'];
            $data[$key]['name']     = $val['name'];

            foreach ($parents as $ke => $va) {
                
                if($va['pid'] == 0){

                    $data[$key]['list'][$ke]['checked']  = false;
                    $data[$key]['list'][$ke]['disabled'] = false;
                    $data[$key]['list'][$ke]['value']    = $va['id'];
                    $data[$key]['list'][$ke]['name']     = $va['name'];

                    foreach ($parents as $k => $v) {

                        if($v['pid'] == $va['id']){

                            $data[$key]['list'][$ke]['list'][$k]['checked']  = false;
                            $data[$key]['list'][$ke]['list'][$k]['disabled'] = false;
                            $data[$key]['list'][$ke]['list'][$k]['value']    = $v['id'];
                            $data[$key]['list'][$ke]['list'][$k]['name']     = $v['name'];
                        }
                       
                    }
                }
            }
        }

        return $data;

    }


    /**
     * 删除 
     *
     *
     */
    public function delete($id)
    {

        if($this->model->where('pid',$id)->exists()){

            throw new \App\Exceptions\CustomException("请先删除子节点", 500);
        }

        try {

            $this->model->destroy($id);
            
        } catch (\Exception $e) {
            
            throw new \App\Exceptions\CustomException(lang('delete error'), 500);
        }

        return true;
    }
}