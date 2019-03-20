<?php
namespace App\Http\Repository\Admin;

use App\Models\{Node,NodeGroup;

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

		$groups = NodeGroup::get();

		foreach ($groups as $key => $val) {
			# code...
		}


	}



}