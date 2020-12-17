<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\{
	ChannelModel,
	UserModel,
	ChatModel
};
use Carbon\Carbon;

class ChannelController extends BaseController
{
	use ResponseTrait;

	public function addChannel(){
		return view("user/add-channel");
	}

	public function index()
	{
		$channelModel = new ChannelModel();
		$pager = \Config\Services::pager();
 		 
		if(!empty($this->request->getGet('search'))){
			$dataChannel = $channelModel
			->where('id',$this->request->getGet('search'))
			->groupStart()
				->orWhere('sender_id',session('user')['id'])
				->orWhere('accepter_id',session('user')['id'])
			->groupEnd();
		}else{
			$dataChannel = $channelModel
			->groupStart()
				->orWhere('sender_id',session('user')['id'])
				->orWhere('accepter_id',session('user')['id'])
			->groupEnd();			
		}

		$dataChannel = $dataChannel->groupBy('id')
				->orderBy('time','desc')
            	->paginate(6);

		$data = [
			'channels' => $dataChannel,            
            'last_page' => $channelModel->pager->getLastPage()
		];

		foreach ($data['channels'] as $key => $value) {
			$chatModel = new ChatModel();
			$userModel = new UserModel();

			$opponentUserId = $value['sender_id'] == session('user')['id'] ? $value['accepter_id'] : $value['sender_id'];			

			$data['channels'][$key]['user'] = $userModel
				->where('id',$opponentUserId)
				->first();

			$data['channels'][$key]['message'] = $chatModel
				->where('status','active')
				->where('channel_id',$value['id'])
				->orderBy('id','desc')
				->first();
		}

		return $this->setResponseFormat('json')
			->respond([
				'data' => $data,
				'message' => "Success"
			],200);      
	}

	public function getUser(){
		$userModel = new UserModel();

		$userModel = $userModel
			->orWhere('username',$this->request->getGet('search'))
			->orWhere('email',$this->request->getGet('email'))
			->groupBy('id')
			->paginate(10);

		foreach ($userModel as $key => $value) {		
			if(intval($value['id']) === intval(session('user')['id'])){
				unset($userModel[$key]);
			}
		}

		return $this->setResponseFormat('json')
			->respond([
				"data" => !empty($this->request->getGet('search')) ? $userModel : [],
				"message" => "Success"
			],200);
	}

	public function createChannel($id){
		if(intval($id) < 1){
			return $this->setResponseFormat('json')
			->respond([
				"message" => "Failed"
			],500);
		}

		$channelModel = new ChannelModel();

		if($channelModel->where('sender_id',$id)
				->where('accepter_id',session('user')['id'])
				->first()){

			$channelModel
			->where('sender_id',$id)
			->where('accepter_id',session('user')['id'])			
    		->set([
				"time" => Carbon::now()->toDateTimeString()
			])
    		->update();	
			
			return $this->setResponseFormat('json')
			->respond([
				"message" => "Success"
			],201);
		}

		if($channelModel->where('accepter_id',$id)
				->where('sender_id',session('user')['id'])
				->first()){

			$channelModel
			->where('accepter_id',$id)
			->where('sender_id',session('user')['id'])
			->set([
				"time" => Carbon::now()->toDateTimeString()
			])
			->update();

			return $this->setResponseFormat('json')
			->respond([
				"message" => "Success"
			],201);
		}

		if($channelModel->insert([
			"sender_id" => session('user')['id'],
			"accepter_id" => $id,
			"time" => Carbon::now()->toDateTimeString()
		])){
			return $this->setResponseFormat('json')
			->respond([
				"message" => "Success"
			],201);
		}

		return $this->setResponseFormat("json")
			->respond([
				"message" => "Failed"
			],500);
	}
}