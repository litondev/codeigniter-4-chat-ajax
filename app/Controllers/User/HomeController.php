<?php namespace App\Controllers\User;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
	public function index()
	{
		return view("user/home");
	}

	public function signin(){
		return view("user/signin");
	}

	public function signup()
	{
		return view("user/signup");
	}
}
