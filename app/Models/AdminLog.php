<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    //protected $table = 'admin_log';
	public $timestamps = true;
	protected $fillable = ['admin_id','ip','uri','method','description'];
}
