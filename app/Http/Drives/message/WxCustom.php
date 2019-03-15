<?php
namespace App\Http\Drives\message;

class WxCustom
{
	
	/**
	 * 发送消息
	 * 
	 * @param  string  $openid  [微信唯一识别号]
	 * @param  string  $data    [发送的内容]
	 */
	public function send($openid, $data)
	{

		$url  = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$this->access_token}";

        $data =  $this->buildCustomContent($openid, $content);

        $result  =  json_decode(httpRequest($url,'POST',$data),true);

        if($result['errcode'] == 0){

            return true;
        }

       return false;
	}



	/**
     * [buildCustomContent description]
     * @return [type] [description]
     */
    public function buildCustomContent($openid, $content)
    {
        
       $data['msgtype'] =  'text';
       $data['touser']  =  $openid;
       $data['text']['content'] = $content;
       return json_encode($data,JSON_UNESCAPED_UNICODE);

    }




}