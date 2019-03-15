<?php
namespace App\Http\Repository\Admin;

/*
 | ---------------------
 |  登陆数据仓库
 | ---------------------
 |  
 | 作者:小李子
 | 
 | 日期:2019-3-5
 | 
 | 版本:1.0.0
 */

abstract Class Repository
{
	

	//查询全部
	abstract public function all($columns = array('*'), $order_by='created_at');


	//根据条件查询全部
	abstract public function allBy($map, $columns = array('*'), $order_by='created_at');


	//查询分页
    abstract public function paginate($limit = 15, $columns = array('*'), $order_by='created_at');


    //根据条件查询分页
    abstract public function paginateBy($map, $limit = 15, $columns = array('*'), $order_by='created_at');


    //新增数据
    abstract public function create(array $data);


    //更新数据
    abstract public function update(array $data, $id);


    //删除数据
    abstract public function delete($id);


    //查询单条数据
    abstract public function find($id, $columns = array('*'));


    //根据条件查询单条
    abstract public function findBy($field, $value, $columns = array('*'));


}