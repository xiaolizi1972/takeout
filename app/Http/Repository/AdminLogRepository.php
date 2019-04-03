<?php
namespace App\Http\Repository;

use App\Models\{AdminLog};

/**
 | -------------------
 | 登录日志数据仓库
 | -------------------
 | 
 | 作者:小李子
 | 
 | 日期:2019-3-17
 |
 | 版本:1.0.0 
 */

class AdminLogRepository extends BaseRepository
{
    
    public function __construct()
    {
        $this->model = new AdminLog;
    }



    /**
	 * 登录日志
	 */
	public function login($username, $remark, $ip=get_client_ip(), $status=0)
	{
		try {

			$data = [

				'ip'		=> 	$ip,
				'status'	=> 	$status,
				'remark'	=>	$remark,
				'username' 	=> 	$username
			];

			AdminLoginLog::create($data);
			
		} catch (\Exception $e) {
			
			log_record('记录管理员登录日志错误');
		}
	}




}