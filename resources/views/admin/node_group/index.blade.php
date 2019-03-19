@extends('admin.public.table')

@section('content')
<!--主体内容部分 -->
<div class="content-wrapper">
    <section class="content-header">
        <h1>分组列表</h1>
    </section>
    <!-- 表格 -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <div class="col-sm-2">
                                <a href="{{url('NodeGroup/create')}}" class="btn btn-success" title="添加">
                                    <i class="fa fa-plus"></i> 添加
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-sm" >
                                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="th-inner ">
                                                    <input name="all_list[]" type="checkbox">
                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>名称</th>
                                            <th>图标</th>
                                            <th>排序</th>
                                            <th>菜单</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lists as $list)
                                        <tr>
                                            <td>
                                                <div class="th-inner ">
                                                    <input name="all_list[]" type="checkbox">
                                                </div>
                                            </td>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->name}}</td>
                                            <td>{{$list->icon}}</td>
                                            <td>{{$list->sort}}</td>
                                            <td>{{$list->visible}}</td>
                                            <td>
                                                <a href="{{url('admin/edit',array('id'=>$list->id))}}" class="btn btn-xs btn-success btn-editone">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-xs btn-danger btn-delone" >
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- 分页 -->
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                   共 {{$lists->total()}}条
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    {{$lists->links()}}  
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection