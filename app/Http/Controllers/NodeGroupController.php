<?php
namespace App\Http\Controllers;

use App\Http\Repository\NodeGroupRepository;

class NodeGroupController extends Controller
{
	
	protected $repository;

	public function __construct(NodeGroupRepository $repository)
	{
		$this->repository =  $repository;

	}


	//列表
	public function index()
	{
		//dd($this->repository->paginate());die;
		return view('node_group.index',[

			'lists'	=> $this->repository->paginate(2)
		]);
	}


	//新增
	public function create()
	{

		return view('node_group.create');
	}


	//保存
	public function store()
	{


	}

	//编辑
	public function edit()
	{


		return view('node_group.edit');
	}


	//更新
	public function update()
	{



	}


	//删除
	public function delete()
	{



	}


	//显示隐藏
	public function visible($id, $status)
	{



	}


}