<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RoleNode extends Model
{
   
    public $timestamps = true;

    protected $table = 'roles_has_nodes';

}
