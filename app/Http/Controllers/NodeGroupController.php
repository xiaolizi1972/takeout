<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NodeGroupRequest;
use App\Http\Repository\NodeGroupRepository;

class NodeGroupController extends Controller
{
    
    protected $repository;

    protected $inputOnly =  ['name','icon','visible','sort'];

    public function __construct(NodeGroupRepository $repository)
    {
        $this->repository =  $repository;

    }


    //列表
    public function index()
    {
        return view('node_group.index',[

            'lists' => $this->repository->paginate()
        ]);
    }


    //新增
    public function create()
    {
        return view('node_group.create');
    }


    //保存
    public function store(NodeGroupRequest $request)
    {
        $this->repository->create($request->only($this->inputOnly));

        return json(200, lang('create success'));
    }


    //编辑
    public function edit($id)
    {
        return view('node_group.edit',[

            'node_group' =>  $this->repository->find($id),
        ]);
    }


    //更新
    public function update(NodeGroupRequest $request, $id)
    {

        $this->repository->update($request->only($this->inputOnly), $id);

        return json(200, lang('update success'));

    }


    //删除
    public function delete($id)
    {

        $this->repository->delete($id);

        return json(200, lang('delete success'));
    }


    //显示隐藏
    public function visible($id, $visible)
    {

        // echo $id;
        // echo $status;die;

        $this->repository->update(['visible'=>$visible], $id);

        return json(200, lang('action success'));
    }


}