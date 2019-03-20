<?php
namespace App\Http\Repository\Admin;

class RoleRepository extends BaseRepository
{
	
	public function __construct()
	{

		$this->model = new \App\Models\Role;

	}



	/**
	 * 
	 * 
	 * 
	 */
	public function getRoletree()
	{

		//1.查出权限分组
		//2.查询第一级权限
		//3.查询自己分类


	}




}