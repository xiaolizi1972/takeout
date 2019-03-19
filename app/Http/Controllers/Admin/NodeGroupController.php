<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\Admin\NodeGroupRepository;


/**
 | ------------------
 | 权限分组管理
 | ------------------
 | 作者:小李子
 |
 | 日期:2019-03-18
 | 
 | 版本:1.0.0 
 */

class NodeGroupController extends Controller
{
    

    public function __construct(NodeGroupRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * 首页 
     */
    public function index()
    {

        $lists =  $this->repository->paginate(15);

        return view('admin.node_group.index',['lists'=>$lists]);
    }


    /**
     * 新增
     */
    public function create()
    {
        return view('admin.node_group.create');
    }


    /**
     * 保存
     * 
     */
    public function store(Request $request)
    {
        $this->repository->create($request->all());

        return json(200, lang('create success'));
    }


    /**
     * 编辑
     */
    public function edit($id)
    {

        $node_group = $this->repository->find($id);

        return view('admin.node_group.edit',['node_group'=>$node_group]);
    }


    /**
     * 更新
     * 
     */
    public function update(Request $request, $id)
    {

        $guarded = ['_token'];
        
        $this->repository->update($request->except($guarded), $id);

        return json(200, lang('update success'));
    }


    /**
     * 删除
     * 
     */
    public function destroy($id)
    {
        
        $this->repository->delete($id);

        return json(200, lang('delete success'));
    }

}
