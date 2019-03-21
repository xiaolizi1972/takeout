<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoleNode;


class Role extends Model
{
   
	public $timestamps = true;
	
	//白名单
	protected $fillable = ['name'];
	
	/**
	 * 关联权限节点
	 *
	 */
	public function nodes()
	{
		return $this->belongsToMany('\App\Models\Node','roles_has_nodes');//->using('RoleNode');
	}
}
