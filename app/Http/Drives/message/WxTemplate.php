<?php
namespace App\Http\Drives\message;

class WxTemplate
{
	
	/**
	 * 发送消息
	 *
	 * @param  string  $openid  [微信唯一识别号]
	 * @param  string  $data    [发送的内容]
	 * @param  int     $typ     [微信模板类型]
	 */
	public function send($openid, $data, $type)
	{

		$url    =  'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->access_token;

        $data   =  $this->buildTemplateContent($order_id,$type);

        $result  =  json_decode(httpRequest($url,'POST',$data),true);

        if($result['errcode'] == 0){

            return true;
        }

       return false;


	}





	 /**
     * [构建模板信息内容]
     * @param  integer  $order_id [订单id]
     * @param  integer  $type     [模板类型]
     * @return void     array     [返回json]
     */
    public function buildTemplateContent($order_id,$type)
    {

        $order  =   Order::alias('o')
                    ->join('users u','o.user_id = u.user_id','left')
                    ->join('shops s','s.shop_id = o.shop_id','left')
                    ->where('order_id',$order_id)
                    ->field('o.order_sn,o.user_note,o.order_status,o.order_id,u.openid,s.shop_name,o.mobile as user_mobile,s.mobile,o.address,s.shop_name,o.total_amount')
                    ->find();

      //  pr($order);die;

        $template   =   array(
                    'touser'        => $order['openid'],
                    'template_id'   => $this->templates[$type],
                    'url'           => request()->domain().'/#/orderdetails?order_id='.$order['order_id'],          
                );

        //pr($template);die;

        switch ($type) {

            case 1:

                $template['data'] =  array(

                    'first'       => array(
                        'value' => '下单成功',
                        'color' => '#173177'
                    ),
                    'keyword1'    =>  array(
                        'value' => $order['order_sn'],
                        'color' => '#173177'
                    ),
                    'keyword2'    =>array(

                        'value' => $order['user_mobile'],
                        'color' => '#173177'

                    ),
                    'keyword3'    =>array(

                        'value' => $order['address'],
                        'color' => '#173177'

                    ),
                    'remark'      => array(
                        'value' => $order['user_note'],
                        'color' => '#173177'
                    )
                );
                break;
            case 2:

                $template['data'] =  array(

                    'first'       => array(
                        'value' => '订单状态更新',
                        'color' => '#173177'
                    ),
                    'keyword1'    =>  array(
                        'value' => $order['shop_name'],
                        'color' => '#173177'
                    ),
                    'keyword2'    =>array(
                        'value' => $order['mobile'],
                        'color' => '#173177'

                    ),
                    'keyword3'    => array(
                        'value' => $order['order_sn'],
                        'color' => '#173177'
                    ),
                    'keyword4'    => array(
                        'value' => config("ORDER_STATUS.".$order['order_status']),
                        'color' => '#173177'
                    ),
                    'keyword5'    => array(
                        'value' =>  $order['total_amount'],
                        'color' => '#173177'
                    ),
                    'remark'      => array(
                        'value' => $order['user_note'],
                        'color' => '#173177'
                    )
                );
               
                break;
        }

        return json_encode($template);

    }




	
}