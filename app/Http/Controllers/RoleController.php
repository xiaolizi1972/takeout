<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Repository\{RoleRepository,NodeRepository};

class RoleController extends Controller
{
    
    protected $repository;
    protected $NodeRepository;

    protected $inputOnly =  ['name','icon','visible','sort','nodes'];

    public function __construct(RoleRepository $repository, NodeRepository $NodeRepository)
    {
        $this->repository =  $repository;
        $this->NodeRepository =  $NodeRepository;
    }


    //列表
    public function index()
    {
        return view('role.index',[

            'lists' => $this->repository->paginate()
        ]);
    }


    //新增
    public function create()
    {

        //pr($this->NodeRepository->nodeTree());die;

        return view('role.create',[

            'nodes' => $this->NodeRepository->nodeTree(),
        ]);
    }


    //保存
    public function store(Request $request)
    {
        //pr($request->only($this->inputOnly));die;

        $this->repository->create($request->only($this->inputOnly));

        return json(200, lang('create success'));
    }


    //编辑
    public function edit($id)
    {

        //pr($this->repository->find($id));die;

        return view('role.edit',[

            'role' =>  $this->repository->find($id),
        ]);
    }


    //更新
    public function update(RoleRequest $request, $id)
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

        $this->repository->update(['visible'=>$visible], $id);

        return json(200, lang('action success'));
    }


    //角色数据
    public function RoleData($id)
    {   

        if($id){

            $data = $this->NodeRepository->roleNode(8);

        }else{

            $data = $this->NodeRepository->nodeTree();
        }

        //pr($data);die;

        return json(200, 'ok', $data);

    }


}