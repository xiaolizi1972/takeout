<?php
namespace App\Http\Repository;

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
    
            $role = $this->model->create($data);

            $role->nodes()->sync($data['nodes']);
    
            DB::commit();
            
        } catch (\Exception $e) {
        
            DB::rollBack();

            throw new \App\Exceptions\Custom($e->getMessage(), 500);
        }
        
        return true;
    }



     /**
     * 
     * @param  [type] $data  [description]
     * @param  [type] $nodes [description]
     * @return [type]        [description]
     */
    public function update(array $data, $value, $field='id')
    {   
        //pr($data);die;
        DB::beginTransaction();
        try{
    
            $role  = $this->model->find($value);
            $role->name =  $data['name'];
            $role->save();

            $role->nodes()->sync($data['all_list']);
    
            DB::commit();
            
        } catch (\Exception $e) {
            
            DB::rollBack();

            throw new \App\Exceptions\Custom($e->getMessage(), 500);
        }
        
        return true;
    }




}