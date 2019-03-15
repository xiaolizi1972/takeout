<?php
namespace drive\alipay;


/**
 * explain:阿里支付数据处理
 * date:2018-9-15
 * author:小李子
 */

class AlipayData
{
	

	/**
	 * [将xml转数组]
	 * @param  xml    $xml 	 [xml数据]
	 * @return array  $values  [返回数组]
	 */
    public static  function xmlToArray($xml)
    {                
        
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;

    }



    /**
     * [支付宝请求参数拼接-(键=值&方式)]
     * @param   array  $para [需要请求的参数]
     * @return  string $arg  [返回已拼接好的参数]
     */
	public static function ToUrlParams($para)
	{
		$para  = self::argSort($para);

		$arg  = "";
		while (list ($key, $val) = each ($para)) {
			$arg.=$key."=".$val."&";
		}
		//去掉最后一个&字符
		$arg = substr($arg,0,count($arg)-2);
		
		//如果存在转义字符，那么去掉转义
		if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
		
		return $arg;
	}



	/**
	 * [将数组以升序排序]
	 * @param  array   $para [需要排序的数组]
	 * @return [返回已处理的排序数组]
	 */
	public static function argSort($para) 
	{
		ksort($para);
		reset($para);
		return $para;
	}



    /**
     * [支付宝curl模拟get请求]
     * @param  string   $url [请求地址]
     * @return [返回请求响应]
     */
  	public static function curlGet($url)
	{
	    //初始化
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL,$url);
	    // 执行后不直接打印出来
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    // 跳过证书检查
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    // 不从证书中检查SSL加密算法是否存在
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

	    //执行并获取HTML文档内容
	    $output = curl_exec($ch);

	    //释放curl句柄
	    curl_close($ch);

	    return $output;
	}



	/**
	 * [MD5签名]
	 * @param  string $prestr [待签名字符串]
	 * @param  string $key    [商户秘钥]
	 * @return [返回加密的签名]
	 */
	public static function md5Sign($prestr,$key)
	{

		$prestr = $prestr . $key;
		return md5($prestr);
	}



	/**
	 * /
	 * @param  string $prestr [待签名字符串]
	 * @param  string  $sign   [完整的签名]
	 * @param  strign  $key    [商家秘钥]
	 * @return boolean [返回布尔值]
	 */
	public static function md5Verify($prestr,$sign,$key)
	{
		$prestr = $prestr . $key;
		$mysgin = md5($prestr);

		if($mysgin == $sign) {

			return  true;
		}
		
		return false;
	}




}