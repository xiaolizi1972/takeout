<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
   
	public $timestamps = true;
	
	//白名单
	protected $fillable = ['name','pid','route','visible'];
	

}
