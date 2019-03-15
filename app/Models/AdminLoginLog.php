<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLoginLog extends Model
{
	public $timestamps = true;
	protected $fillable = ['username','ip','status','remark'];
}
