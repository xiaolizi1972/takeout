<?php
namespace App\Http\Repository;

/*
| ---------------------
|  登陆数据仓库
| ---------------------
|  
| 作者:小李子
| 
| 日期:2019-3-5
| 
| 版本:1.0.0
*/

Class NodeGroupRepository extends BaseRepository
{

    public function __construct()
    {

        $this->model =  new \App\Models\NodeGroup;
    }


    //public function setAttrS



}