<?php
namespace App\Http\Controllers;

/**
 * ----------------------- 
 *  首页控制器
 * -----------------------
 *
 */

class IndexController extends Controller
{
	
	public function index()
	{

		return view('index.index');
	}


	
	public function welcome()
	{
		return view('index.welcome');
	}


}