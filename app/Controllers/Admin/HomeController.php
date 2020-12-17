<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\{
	UserModel,
	ChatModel,
	ChannelModel
};
class HomeController extends BaseController
{
	public function index()
	{
		$userModel = new UserModel();
		$chatModel = new ChatModel();
		$channelModel = new ChannelModel();

		$data = [
			"user" => $userModel->select('count(*) as amount')->first()['amount'],
			"chat_active" => $chatModel->select('count(*) as amount')->where('status','active')->first()['amount'],
			"chat_nonactive" => $chatModel->select('count(*) as amount')->where('status','nonactive')->first()['amount'],
			"channel" => $channelModel->select('count(*) as amount')->first()['amount']
		];

		return view("admin/home",$data);
	}	
}
