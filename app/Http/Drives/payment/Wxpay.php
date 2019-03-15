<?php
namespace App\Http\Drives\payment;


/**
 | -------------------
 | 微信支付
 | -------------------
 |
 | 作者:小李子
 |
 | 日期:2019-3-10
 |
 | 版本:1.0.0
 */

class Wxpay extends Drive
{
	
	protected $appid  = ''; 
    protected $merid  = '';
    protected $merkey = '';



	/**
	 * 统一下单支付
	 * 
	 * @param float  $amount  支付金额
	 */
	public  function pay($amount)
	{

		return '你用微信支付了￥'.$amount;
	}
	
	
	/**
	 * 订单退款
	 * 
	 * @param float   $amount   [退款金额]
     * @param string  $trade_no [第三方单号]
	 */
	public  function refund($amount, $trade_no)
	{

		$refund_fee		*=   100;
        $total_fee      *=   100;
        $nonce_str       =   WxpayData::randStr();
        $out_refund_no   =   date('YmdHis',time()).rand(1000,9999);
        $url             =   'https://api.mch.weixin.qq.com/secapi/pay/refund';

        $data   =   array(

                'appid'             =>  $appid,
                'mch_id'            =>  $mch_id,
                'nonce_str'         =>  $nonce_str,
                'out_refund_no'		=>  $out_refund_no,
                'transaction_id'    =>  $trade_no,
                'refund_fee'        =>  $amount,
                'total_fee'         =>  $amount,
                'refund_account'    => 'REFUND_SOURCE_UNSETTLED_FUNDS',
                'refund_desc'		=> '订单退款'
        );

        $data['sign'] =  WxpayData::makeSign($data,$mer_key);

        $xml     	  =  WxpayData::arrToXml($data);  

        $result  	  =  WxpayData::postXmlCurl($xml, $url, $type);

        $arr 		  =  WxpayData::xmlToArr($result);

        if($arr['return_code'] == 'SUCCESS' && $arr['result_code'] == 'SUCCESS')
        {
            return array('status'=>1,'msg'=>'退款成功');
        }

        return array('status'=>0,'msg'=>$arr['err_code_des'],'data'=>$arr);
	}
	
	

	/**
	 * 企业付款(提现)
	 * 
	 * @param  float  $amount 	     [转账金额] 
	 * @param  string $payee_account [转入账户]
	 * @param  string $realname      [真实姓名]
	 */
	public  function transfer($amount, $payee_account, $realname)
	{

		$total_amount =  (100) * $amount;
        $nonce_str    =  WxpayData::randStr();
        $ip 	      =  get_client_ip();
        $trade_no     =  date('YmdHis').rand(1000, 9999);
        $url  		  =  'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
   
        $data   =   array(
            
              'mch_appid'           =>  $appid,//商户账号appid
              'mchid'               =>  $merid,//商户号
              'nonce_str'           =>  $nonce_str,
              'partner_trade_no'    =>  $trade_no,
              'openid'              =>  $payee_account,
              'check_name'          =>  'NO_CHECK',
              're_user_name'        =>  $realname,
              'amount'              =>  $total_amount,
              'desc'                =>  '提现金额',
              'spbill_create_ip'    =>  $ip,
        );

        //生成签名算法
        $data   =   array_filter($data);

        $data['sign'] 	=   WxpayData::makeSign($data,$key);

        $xml  	=   WxpayData::arrToXml($data);

        $result =   WxpayData::curlPostSsl($url,$xml);

        $arr    =   WxpayData::xmlToArr($result);

        if($arr['return_code'] == 'SUCCESS' && $arr['result_code'] == 'SUCCESS'){

        	return array('status'=>1,'msg'=>'操作成功');
        } 

        return array('status'=>0,'msg'=>$arr['err_code_des'],$arr);
	}




}