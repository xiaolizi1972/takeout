<?php
namespace App\Http\Repository\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Admin;

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

Class AdminRepository extends BaseRepository
{
	//初始化
    public function __construct()
    {
        $this->model =  new Admin;
    }

	
	/**
	 * 创建
	 *
	 */
	public function create(array $data)
	{
		
		DB::beginTransaction();
		try{
	
			$admin = $this->model->create($data);
			//$admin_has_role['admin_id'] = $admin->id;
			//$admin_has_role['role_id']  = $data['role_id'];
			//$admin->roles()->create($admin_has_role);
	
			DB::commit();
			
		} catch (\Exception $e) {
			
			DB::rollBack();
			throw new \App\Exceptions\CustomException(lang('create error'),500);
		}
		
		return true;
	}

	
	/**
	 * 更新
	 *
	 */
	public function update(array $data, $value, $attribute='id')
	{
		DB::beginTransaction();
		try{
			
			$admin = $this->model->where($attribute, $value)->update($data);
			
			//$admin_has_role['admin_id'] = $value;
			//$admin_has_role['role_id']  = $data['role_id'];
			//$admin->roles()->save($admin_has_role);
		
			DB::commit();
		} catch (\Exception $e) {
			
			DB::rollBack();
			throw new \App\Exceptions\CustomException(lang('update error'), 500);
		}
		
		return true;
	}
	
	

}