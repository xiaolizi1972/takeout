<?php
namespace App\Http\Drives\payment;


/**
 | -------------------
 | 支付宝支付
 | -------------------
 |
 | 作者:小李子
 |
 | 日期:2019-3-10
 |
 | 版本:1.0.0
 */

class Alipay extends Drive
{
	

	/**
	 * 统一下单支付
	 * 
	 * @param float  $amount  支付金额
	 */
	public  function pay($amount)
	{

		return '你用支付宝支付了￥'.$amount;
	}
	
	
	/**
	 * 订单退款
	 * 
	 * @param float   $amount   [退款金额]
     * @param string  $trade_no [第三方单号]
	 */
	public  function refund($amount, $trade_no)
	{




	}
	
	
	/**
	 * 企业付款(提现)
	 * 
	 * @param  float  $amount 	     [转账金额] 
	 * @param  string $payee_account [转入账户]
	 * @param  string $realname      [收款方姓名]
	 */
	public  function transfer($amount, $payee_account, $realname)
	{

		$aop = new \AopClient();

        $aop->gatewayUrl            = 'https://openapi.alipay.com/gateway.do';
        $aop->appId                 =  $config['app_id'];
        $aop->rsaPrivateKey         =  $config['merchant_private_key'];
        $aop->alipayrsaPublicKey    =  $config['alipay_public_key'];
        $aop->apiVersion            =  $config['api_version'];
        $aop->signType              =  $config['sign_type'];
        $aop->postCharset           =  $config['charset'];
        $aop->format                =  $config['format'];

        $request = new \AlipayFundTransToaccountTransferRequest();

        $data   =  array(

            'out_biz_no'      =>    time(),
            'payee_type'      =>    'ALIPAY_LOGONID',
            'payee_account'   =>    $payee_account,
            'amount'          =>    $amount,
            'payer_show_name' =>    '校园购',
            'remark'          =>    '提现',
            'payee_real_name' =>    $realname
        );


        $json  =  json_encode($data,JSON_FORCE_OBJECT);
        $request->setBizContent($json);
        $result = $aop->execute($request); 

        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";

        $resultCode   = $result->$responseNode->code;

        if(!empty($resultCode) && $resultCode == 10000){

          return array('status'=>1,'msg'=>'操作成功');

        }else{

            return array('status'=>0,'msg'=>'操作失败',$result);
        }

	}




}