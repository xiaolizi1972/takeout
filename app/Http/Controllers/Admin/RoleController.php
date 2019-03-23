<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Repository\Admin\{RoleRepository,NodeRepository};
use App\Http\Controllers\Admin\Auth;

class RoleController extends BaseController
{

    protected $repository;
    protected $NodeRepository;
    protected $inputOnly =  ['name','all_list'];

    public function __construct(RoleRepository $repository,NodeRepository $NodeRepository)
    {
        $this->repository     =  $repository;
        $this->NodeRepository =  $NodeRepository;
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        
        $lists =  $this->repository->paginate();

        return view('admin.role.index',['lists'=>$lists]);
    }

    /**
     * 新增
     */
    public function create()
    {

        $node_tree =  $this->NodeRepository->nodeTree();

        return view('admin.role.create',['node_tree'=>$node_tree]);
    }

    /**
     * 保存
     */
    public function store(Request $request)
    {
       
        $this->repository->create($request->only($this->inputOnly));

        return json(200, lang('create success'));

    }


    /**
     * 编辑
     *
     */
    public function edit($id)
    {
            
        $role =  $this->repository->find($id);
        $node_tree =  $this->NodeRepository->nodeTree();

        $select_nodes  = Auth::selectNode();
        $select_groups = Auth::selectGroup();

        return view('admin.role.edit',[
            'role'  =>  $role,
            'node_tree' => $node_tree,
            'select_nodes'  => $select_nodes,
            'select_groups' => $select_groups
        ]);
    }


    /**
     * 更新
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request->only($this->inputOnly), $id);

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
