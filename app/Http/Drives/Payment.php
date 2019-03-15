<?php
namespace App\Http\Drives;


class Payment
{
	
	public static function name($name)
	{

		switch ($name) {

			case 'alipay':
				
				return new \App\Http\Drives\payment\Alipay;

				break;

			case 'wxpay':
				
				return new \App\Http\Drives\payment\Wxpay;

				break;
		
			default:
				
				throw new \Exception("该支付还未开通", 500);
	
				break;
		}
	}

}