<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NodeGroup extends Model
{
    

    protected $table = 'node_has_groups';
    public $timestamps = true;

    //白名单
    protected $fillable = ['name','icon','visible','sort'];
    

    public function node_tree()
    {
         return $this->hasMany('App\Models\Node', 'group_id', 'id')->where('pid', '=', '0');//->select('id','name');
    }

}
