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


	//404
	public function notFound()
	{

		return view('index.404');
	}


	//403
	public function serverDenied()
	{

		return view('index.403');
	}


	//500
	public function serverError()
	{
		return view('index.500');
	}


}