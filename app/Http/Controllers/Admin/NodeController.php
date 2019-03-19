<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\Admin\NodeRepository;
use App\Http\Requests\NodeRequest;

/**
 | -------------------
 | 权限节点
 | -------------------
 | 
 | 作者:小李子
 |
 | 日期:2019-13-17
 |
 | 版本:1.0.0
 */

class NodeController extends Controller
{

    protected $repository;
    protected $parent_node;

    public function __construct(NodeRepository $repository)
    {
        $this->repository =  $repository;

        $pid = 0;
        $this->parent_node  =  $repository->nodeBychildAll($pid);
    }


    /**
     * 首页
     */
    public function index()
    {
        $lists =  $this->repository->paginate();

        return view('admin.node.index',['lists'=> $lists]);
    }


    /**
     * 新增
     */
    public function create()
    {
        return view('admin.node.create', ['parent_node'=> $this->parent_node]);
    }


    /**
     * 保存
     */
    public function store(NodeRequest $request)
    {
        $this->repository->create($request->all());

        return json(200, lang('create success'));
    }


    /**
     * 编辑
     */
    public function edit($id)
    {
        $node = $this->repository->find($id);

        return view('admin.node.edit',['node'=>$node]);
    }


    /**
     * 更新
     */
    public function update(NodeRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return json(200, lang('update success'));
    }


    /**
     * 删除
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return json(200, lang('delete success'));
    }
}
