<?php
namespace App\Http\Repository\Admin;

use App\Models\{Node,NodeGroup};

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

        $lists =  NodeGroup::get();

        foreach ($lists as $key => $val) {
            
            $parent =  $this->model->where([['pid','=',0],['group_id','=', $val['id']]])->get();

            $lists[$key]['parent'] =  $parent;

            foreach ($parent as $k => $v) {
                
                $lists[$key]['parent'][$k]['child'] =  $this->model->where('pid', $v['id'])->get();
            }
        }

        return $lists;
    }



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