<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Repository\Admin\AdminRepository;


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



class AdminController extends Controller
{

    protected $repository;

    public function __construct(AdminRepository $repository)
    {
        $this->repository =  $repository;
    }


    /**
     * 管理员列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->repository->paginate();

        return view('admin.index',['lists'=>$lists]);
    }


    /**
     * 创建管理员
     *
     */
    public function create()
    {
        return view('admin.create');
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
     */
    public function edit($id)
    {
        //
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
        //
    }


    /**
     * 删除管理员
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }




}
