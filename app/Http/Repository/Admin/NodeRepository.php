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



	public function tree()
	{

		$lists =  $this->model->where('pid',0)->get();

		foreach ($lists as $key => $val) {
			

			$lists[$key]['child'] =  $this->model->where('pid', $val['id'])->get();

			// if($val['pid'] ==  0){

			// 	$data[$key] =  $val;

			// 	foreach ($lists as $k => $v) {
				
			// 		if($val['id'] ==  $v['pid']){

			// 			$data[$key]['child'] =  $v;
			// 		}
			// 	}
			// }
		}

		return $lists;
	}



}