<?php
namespace App\Http\Drives\message;

class Alisms
{

	static $acsClient = null;

    public function __construct()
    {
        //require_once './vendor/aliyun-sms/api_sdk/lib/Core/Config.php';
        //require_once './vendor/aliyun-sms/api_sdk/vendor/autoload.php';
        Config::load();
    }


	
	/**
	 * 发送短信验证码
	 * 
	 * @param  string  $mobile  [接收者手机号]
	 * @param  string  $data    [发送的内容]
	 * @param  string  $scene   [发送的场景：默认登录]
	 */
	public function send($mobile, $data, $scene='login')
	{
		$request = new SendSmsRequest();

        //可选-启用https协议
        //$request->setProtocol("https");

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($mobile);

        // 必填，设置签名名称，
        $request->setSignName("迪速帮");

        // 必填，设置模板CODE，
        $request->setTemplateCode("SMS_149405182");

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值

            "code"      =>  $data,
            "product"   =>  "dsd"

        ), JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
        $request->setOutId('dsb'.time());

        // 选填，上行短信扩展码
        $request->setSmsUpExtendCode("1234567");

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);

        if($acsResponse->Message == 'OK' && $acsResponse->Code == 'OK'){

            return  true;
        }

        return false;
	}


	
    /**
     * 取得AcsClient
     * @return DefaultAcsClient
     */
    public static function getAcsClient()
    {

        //产品名称:云通信短信服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        // TODO 此处需要替换成开发者自己的AK (https://ak-console.aliyun.com/)
        $accessKeyId = "LTAI3G34vIXFmE7x"; // AccessKeyId

        $accessKeySecret = "XUalIVLWfKZgDMtK437OF4n7eBjODe"; // AccessKeySecret

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";

        if(static::$acsClient == null) {

            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

            // 增加服务结点
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

            // 初始化AcsClient用于发起请求
            static::$acsClient = new DefaultAcsClient($profile);
        }

        return static::$acsClient;

    }

       

    /**
     * 短信模板
     * 
     * @param  string   $type [模板类型]
     * @param  string   [返回模板]
     */
    public function template($type)
    {

        $template   =   [
                            'register'      =>  'SMS_149400189',  //用户注册
                            'login'         =>  'SMS_149400190',  //用户登录
                            'bind_phone'    =>  'SMS_149405182',  //绑定手机
                            'update_phone'  =>  'SMS_149405184',  //修改手机
                        ];

        return $template[$type];
    }

} 