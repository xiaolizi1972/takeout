<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeGroup extends Model
{
    

    protected $table = 'node_has_groups';
    public $timestamps = true;

    //白名单
    protected $fillable = ['name','icon','visible','sort'];
    

}
