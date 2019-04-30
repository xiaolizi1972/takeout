<?php

use Illuminate\Support\Facades\{Log,Crypt};


/**
 | --------------------------
 | 说明:辅助函数库
 | --------------------------
 |
 | 作者:小李子
 |
 | 日期:2019-3-09
 |
 | 版本:1.0.0
 */


if (! function_exists('json')) {

    /**
     * 返回json数据
     *
     * @param  int     $status     [状态]
     * @param  string  $message    [描述]
     * @param  array   $data       [数据]
     * @return json 
     */
    function json($status, $message, $data=[])
    {
        return response()->json(['status'=>$status, 'message'=>$message, 'data'=>$data]);
    }
}


if (! function_exists('pr')) {

    /**
     * 格式化打印数据
     *
     * @param   mixed  $data  [需要打印的数据]
     * @return  
     */
    function pr($data)
    {
       
        echo "<pre>";

        print_r($data);

        echo "<pre>";
    }
}


if(! function_exists('log_record')){


    /**
     * 记录日志
     *
     * @param string  $message  记录信息
     * @param string  $type     记录类型
     */
    function log_record($message, $type='debug')
    {
        switch ($type) {

            case 'emergency':

                    Log::emergency($message);
                break;

            case 'alert':
                    Log::alert($message);
                break;

            case 'critical':

                    Log::critical($message);
                break;
            case 'error':
                
                    Log::error($message);
                break;
            case 'warning':
               
                    Log::warning($message);
                break;
            case 'notice':
                
                    Log::notice($message);
                break;
            case 'info':
               
                    Log::info($message);
                break;    
            default:
                    Log::debug($message);
                break;
        }
    }



    if(! function_exists('lang')){

        /**
         * 获取语言包配置信息
         * 
         * @param  string  $message [配置参数]
         */
        function lang($message)
        {

            return trans("action.{$message}");
        }
    }



    if(! function_exists('encrypt')){


        /**
         * 字符串加密
         * 
         * @param  string  $string  [需要加密的字符]
         * @return string  [返回加密后的字符串]
         */
        function  encrypt($string)
        {
            return Crypt::encryptString($string);
        }
    }


    if(! function_exists('decrypt')){

        /**
         * 字符串解密
         *
         * @param  string  $string  [需要解密的字符串]
         * @return string  [返回解密后的字符串]
         */
        function  decrypt($string)
        {
            return Crypt::decryptString($string);
        }
    }



    if(! function_exists('get_client_ip')){

        /**
         * 字符串解密
         *
         * @param  string  $string  [需要解密的字符串]
         * @return string  [返回解密后的字符串]
         */
        function  get_client_ip($type=0)
        {
            if(!empty($_SERVER["HTTP_CLIENT_IP"]))
            {
                $cip = $_SERVER["HTTP_CLIENT_IP"];
            }
            else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            {
                $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            else if(!empty($_SERVER["REMOTE_ADDR"]))
            {
                $cip = $_SERVER["REMOTE_ADDR"];
            }
            else
            {
                $cip = '';
            }
            preg_match("/[\d\.]{7,15}/", $cip, $cips);
            $cip = isset($cips[0]) ? $cips[0] : 'unknown';
            unset($cips);
     
            return $cip;

        }
    }






}


