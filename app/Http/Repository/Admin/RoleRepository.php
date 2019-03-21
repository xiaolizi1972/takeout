<?php
namespace App\Http\Repository\Admin;

use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository
{
	
	public function __construct()
	{

		$this->model = new \App\Models\Role;

	}


	/**
	 * 
	 * @param  [type] $data  [description]
	 * @param  [type] $nodes [description]
	 * @return [type]        [description]
	 */
	public function create(array $data)
	{

		DB::beginTransaction();
		try{
	
			$admin = $this->model->create($data);
			//$admin_has_role['admin_id'] = $admin->id;
			//$admin_has_role['role_id']  = $data['role_id'];
			$admin->nodes()->sync($data['all_list']);
	
			DB::commit();
			
		} catch (\Exception $e) {

			pr($e->getMessage());die;
			
			DB::rollBack();
			throw new \App\Exceptions\CustomException(lang('create error'),500);
		}
		
		return true;
	}



}