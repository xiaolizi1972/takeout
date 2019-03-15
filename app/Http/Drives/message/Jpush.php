<?php
namespace App\Http\Drives\message;

/**
 | ---------------------
 | 说明:极光推送消息
 | ---------------------
 | 
 | 作者:小李子
 |
 | 日期:2019-3-10
 |
 | 版本:1.0.0
 */
class Jpush
{
	
	protected $key         =  '';
    protected $secret      =  '';


	/**
	 * 发送消息
	 *
	 * @param  string|array  $push_id  [接收者id]
	 * @param  strng   $data     [发送的内容]
	 * @param  int     $type     [发送类型1广播,0单发]
	 *
	 */
	public function send($push_id , $data, $type=0)
	{

		$client   =  new \JPush\Client($key,$secret);

        $pusher   =  $client->push();

        $pusher->setPlatform('all'); //推送设备平台['ios', 'android']
        $pusher->setNotificationAlert($content); //简单地给所有平台推送相同的 alert 消息
        $pusher->iosNotification($content, ['sound' => 'order.mp3']); //推送ios
        $pusher->androidNotification($content); //推送安卓
        $pusher->options(['apns_production'=>true]); //设置生产环境

        if($type){

            $pusher->addAllAudience(); 
        }else{
            $pusher->addRegistrationId($push_id);
        }

        try {
        	
            $pusher->send();
        } catch (\Exception $e) {
        	
        	throw new \Exception($e->getMessage(), 500);
        	
        }

       	return true;
	}


}