<?php
namespace App\Http\Traits\Admin;

use Illuminate\Http\Request;
use App\Models\{Admin,AdminLoginLog};

trait AdminTraits
{
    protected $id;


    /**
     * 验证权限
     * 
     */
    public function check()
    {



    }
    

    /**
     * [menu description]
     * @return [type] [description]
     */
    public function menu()
    {

        // Admin::where()-

    }


    //获取详情
    public function info()
    {
        return Admin::where('id', $this->id)->first();
    }






}