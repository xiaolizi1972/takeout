<?php
namespace App\Http\Controllers;

use App\Http\Requests\NodeRequest;
use App\Http\Repository\{NodeRepository, NodeGroupRepository};

class NodeController extends Controller
{
	
	protected $repository;
	protected $NodeGroup;

	public function __construct(NodeRepository $repository, NodeGroupRepository $NodeGroup)
	{
		$this->repository =  $repository;

		$this->NodeGroup  =  $NodeGroup;
		//$this->repository =  d
	}


	public function index()
	{
		$pid = 0;

		return view('node.index',[

			'groups'	=> $this->NodeGroup->all(),
			'lists'		=> $this->repository->tree(),
			'parents'	=> $this->repository->nodeBychildAll($pid)
		]);
	}


	public function store(NodeRequest $request)
	{

		$this->repository->create($request->all());

		return json(200, lang('action success'));
	}


	//
	public function edit($id)
	{
		$node = $this->repository->find($id);

		return json(200, '获取成功', $node);

	}	


}