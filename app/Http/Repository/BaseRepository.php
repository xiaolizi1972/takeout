<?php
namespace App\Http\Repository;

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

abstract Class BaseRepository extends Repository
{
	
	protected $model;


	/**
	 * 查询全部
	 *
	 * @param  array  $columns   需要查询的字段
	 * @param  string $order_by  排序字段 
	 * @return array  
	 */
	public function all($columns = array('*'), $order_by='created_at')
	{

		return $this->model->orderBy($order_by)->get();
	}


	/**
	 * 根据条件查询全部
	 *
	 * @param  array   $columns  需要查询的字段
	 * @param  string  $order_by 排序字段
	 * @return array 
	 */
	public function allBy($map,$columns = array('*'), $order_by='created_at')
	{

		return $this->model->where($map)->orderBy($order_by)->get();
	}


	/**
	 * 查询分页
	 * 
	 * @param  int    $limit    分页条数限制
	 * @param  array  $columns  需要查询的字段
	 * @param  string $order_by 排序字段
	 * @return array    
	 */
    public function paginate($limit = 20, $columns = array('*'), $order_by='created_at')
    {

   		return $this->model->orderBy($order_by)->select($columns)->orderBy($order_by,'desc')->paginate($limit);
    }


    /**
     * 根据条件查询分页
     *
     * @param  array  $map      查询条件
     * @param  int    $limit    分页条数限制
	 * @param  array  $columns  需要查询的字段
	 * @param  string $order_by 排序字段
	 * @return array    
     */
    public function paginateBy($map, $limit = 15, $columns = array('*'), $order_by='created_at')
    {

    	return $this->model->where($map)->orderBy($order_by,'desc')->select($columns)->paginate($limit);
    }


    /**
     * 新增数据
     * 
     * @param  array  $data  新增数据
     * @return int    $id    新增id
     */
    public function create(array $data)
    {
        //pr($data);die;

    	try {
    		
    		$id = $this->model->create($data);

    	} catch (\Exception $e) {
    		
           // echo $e->getMessage();die;
            throw new \App\Exceptions\CustomException($e->getMessage());

    		//throw new \App\Exceptions\CustomException(lang('create error'));
    	}

    	return $id;
    }



    /**
     * 更新数据
     * 
     * @param  array  $data  更新数据
     * @param  int    $id    更新记录id
     */
    public function update(array $data, $value, $field='id')
    {

    	try {
    		
    		$this->model->where($field, $value)->update($data);

    	} catch (\Exception $e) {
    		
    		throw new Exception(lang('update error'));	
    	}

    	return true;
    }



    /**
     * 删除数据
     * 
     * @param  int  $id  记录id
     * @return boole;
     */
    public function delete($id)
    {
    	try {
    		
    		$this->model->destroy($id);

    	} catch (\Exception $e) {
    		
    		throw new Exception(lang('delete error'));	
    	}

   		return true;
    }


    /**
     * 查询单条数据
     * 
     * @param  int    $id       记录id
     * @param  array  $columns  需要查询的字段
     * @return array 
     */
    public function find($id, $columns = array('*'))
    {
    	return $this->model->select($columns)->find($id);
    }


    /**
     * 根据条件查询单条
     *
     * @param  string  $field   条件字段
     * @param  string  $value   条件值
     * @param  array   $columns 需要查询的条件字段
     * @param  array 
     */
    public function findBy($field, $value, $columns = array('*'))
    {
    	return $this->where($field, $value)->field($columns)->first();
    }


}