<?php
namespace App\Http\Repository;

use App\Models\{AdminLoginLog};

/**
 | -------------------
 | 管理员登录日志数据仓库
 | -------------------
 | 
 | 作者:小李子
 | 
 | 日期:2019-3-17
 |
 | 版本:1.0.0 
 */

class AdminLoginLogRepository extends BaseRepository
{
    
    public function __construct()
    {
        $this->model = new AdminLoginLog;
    }



    /**
     * 登录日志
     */
    public function create(array $data)
    {
        try {

            $this->model->create($data);
            
        } catch (\Exception $e) {
            
            log_record('记录管理员登录日志错误');
        }
    }



    /**
     * 今日登录失败次数
     */
    public function failuresDayCount($username)
    {

        $map =  [

            ['status',   '=',  1],
            ['username', '=',  $username],
            ['ip',       '=',  get_client_ip()]
        ];

        return  $this->model->where($map)
                ->whereDate('created_at', date('Y-m-d'))
                ->count();
    }



    /**
     * 更新今日登录失败记录为成功
     */
    public function updateFailuresRecord($username)
    {

        $map = [

            ['status',   '=', 0],
            ['username', '=', $username]
        ];

        try {

            $this->model->where($map)
            ->whereDate('created_at', date('Y-m-d'))
            ->update(['status'=>1]);
            
        } catch (\Exception $e) {

            log_record('更新管理员登录日志错误');  
        }
    }


}