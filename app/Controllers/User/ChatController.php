<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\{
	ChannelModel,
	ChatModel
};
use Carbon\Carbon;

class ChatController extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		return view("user/chat");
	}

	public function chat($id){
		$channelModel = new ChannelModel();
		$chatModel = new ChatModel();
		$pager = \Config\Services::pager();

		$dataChannel = $channelModel->where('id',$id)->first();

		if($dataChannel['sender_id'] != session('user')['id']){
			if($dataChannel['accepter_id'] != session('user')['id']){
				return $this->setResponseFormat('json')
				->respond([
					"message" => "Failed"
				],500);
			}
		}

		$dataChat = $chatModel->where('channel_id',$id)
				->where('status','active')
				->orderBy('id','desc')
            	->paginate(10);

		$data = [
			'chat' => $dataChat,           
            'last_page' => $chatModel->pager->getLastPage()
		];
	
		foreach ($data['chat'] as $key => $value) {
			$data['chat'][$key]['channel'] = $dataChannel;
		}

		return $this->setResponseFormat('json')
			->respond([
				'data' => $data,
				'message' => "Success"
			],200);      
	}

	public function message($id){
		if(intval($id) < 1){
			return $this->setResponseFormat('json')
			->respond([
				'message' => "Failed"
			],500);
		}

		$rules = [
			"message" => "required"
		];

		$messages = [
			"message" => [
				"required" => "Message harus diisi"
			]
		];

		if(!empty($this->request->getFile('file'))){			
			$imageMime = "image/jpg,image/jpeg,image/png";		

			$rules = array_merge($rules,[
				"file" => "uploaded[file]|max_size[file,10024]|mime_in[file,".$imageMime."]"
			]);

			$messages = array_merge($messages,[
				"file" => [
					"uploaded" => "file harus diisi",
					"max_size" => "Max file 10 mb",
					"mime_in" => "File tidak valid",
				]
			]);
		}

		$this->validation->setRules($rules,$messages);

		$this->validation->withRequest($this->request)->run();

		if(count($this->validation->getErrors())){
			return $this->setResponseFormat('json')
			->respond([
				"message" => "Failed",
				"failed" => $this->validation->getErrors()[array_keys($this->validation->getErrors())[0]]
			],500);
		}

		$chatModel = new ChatModel();
		$channelModel = new ChannelModel();

		$dataChannel = $channelModel->where('id',$id)->first();

		if(!$dataChannel){
			return $this->setResponseFormat('json')
			->respond([
				"message" => "Failed",
			],500);
		}

		if($chatModel->insert([
			"channel_id" => $id,
			"sender" => session('user')['id'] == $dataChannel['sender_id'] ? 'sender' : 'accepter',
			"message" => htmlspecialchars($this->request->getPost('message')),
		])){
			if(!empty($this->request->getFile('file'))){			
				$file = $this->request->getFile('file');    
  	 			$name = $file->getRandomName(); 
  	 			$type = $file->getExtension();
    			$file->move('./assets/files/', $name);    			
    			
    			$chatModel->insert([
    				"channel_id" =>  $id,
					"sender" => session('user')['id'] == $dataChannel['sender_id'] ? 'sender' : 'accepter',
					"message" => $name,				
					"type" => in_array($type, ['image/jpg','image/jpeg','image/png','png','jpg','jpeg']) ? 'image' : 'file'
				]);					
			}

			$channelModel
			->where('id',$id)
			->set([
				"time" => Carbon::now()->toDateTimeString()
			])
			->update();

			return $this->setResponseFormat('json')
			->respond([
				"message" => "Success",
			],201);
		}
		
		return $this->setResponseFormat('json')
			->respond([
				"message" => "Failed",
			],500);
	}
}