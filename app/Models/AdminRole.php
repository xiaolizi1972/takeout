<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AdminRole extends Model
{
   
    public $timestamps = true;

    protected $table = 'admins_has_roles';

}
