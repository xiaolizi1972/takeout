<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Repository\Admin\{AdminRepository,RoleRepository};
use App\Http\Controllers\Admin\Auth;

/**
 | --------------------
 | 管理员控制器
 | --------------------
 |	
 | 作者:小李子
 |
 | 日期:2019-3-15
 |
 | 版本:1.0.0
 */



class AdminController extends BaseController
{

    protected $repository;
    protected $RoleRepository;

    public function __construct(AdminRepository $repository, RoleRepository $RoleRepository)
    {
        //parent::__construct();
        //phpinfo();
        $this->repository     =  $repository;
        $this->RoleRepository =  $RoleRepository;
    }


    /**
     * 管理员列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->repository->paginate();
        
        return view('admin.admin.index',['lists'=>$lists]);
    }


    /**
     * 创建管理员
     *
     */
    public function create()
    {

        $roles =  $this->RoleRepository->all();

        return view('admin.admin.create',['roles'=>$roles]);
    }


    /**
     * 保存管理员
     *
     */
    public function store(AdminRequest $request)
    {
        $this->repository->create($request->all());

        return json(200, lang('create success'));
    }

   
    /**
     * 编辑管理员
     * 
     * @param int  $id  [管理员id]
     */
    public function edit($id)
    {
        $admin =  $this->repository->find($id);

        return view('admin.admin.edit',['admin'=>$admin]);
    }


    /**
     * 更新管理员
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {

        $guarded = ['_token','password_confirmation'];
        
        $this->repository->update($request->except($guarded), $id);

        return json(200, lang('update success'));
    }


    /**
     * 删除管理员
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->repository->delete($id);

        return json(200, lang('delete success'));
    }

    /**
     * Undocumented function
     *
     * @param Type $var
     * @return void
     */
    /* public function FunctionName(Type $var = null)
    {
        # code...
    } */
}
