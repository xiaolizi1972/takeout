<?php
namespace App\Http\Controllers;

use App\Http\Requests\NodeRequest;
use App\Http\Repository\{NodeRepository, NodeGroupRepository};

class NodeController extends Controller
{
    
    protected $NodeGroup;
    protected $repository;
    protected $inputOnly  =  ['name','group_id','pid','route','sort','visible'];

    public function __construct(NodeRepository $repository, NodeGroupRepository $NodeGroup)
    {
        $this->NodeGroup  =  $NodeGroup;
        $this->repository =  $repository;
    }


    //列表
    public function index()
    {
        $pid = 0;

        return view('node.index',[

            'groups'    => $this->NodeGroup->all(),
            'lists'     => $this->repository->tree(),
            'parents'   => $this->repository->nodeBychildAll($pid)
        ]);
    }


    //新增
    public function store(NodeRequest $request)
    {

        $this->repository->create($request->all());

        return json(200, lang('create success'));
    }


    //编辑
    public function edit($id)
    {
        $node = $this->repository->find($id);

        return json(200, '获取成功', $node);
    }   


    //更新
    public function update(NodeRequest $request, $id)
    {
        $this->repository->update($request->only($this->inputOnly), $id);

        return json(200, lang('update success'));
    }


    //删除
    public function destroy($id)
    {
        $this->repository->delete($id);

        return json(200, lang('delete success'));
    }
}