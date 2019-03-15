<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    

	//protected $table = 'admin';
	public $timestamps = true;
	
	//白名单
	protected $fillable = ['username','password','mobile','realname','status'];
	
	//设置密码属性
	public function setPasswordAttribute($value)
    {
		if($value){
			
			$this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
		}	
    }
	
	
	/**
	 * 关联角色
	 *
	 */
	public function roles()
	{
		return $this->belongsToMany('\App\Models\Role');
	}
	

}
