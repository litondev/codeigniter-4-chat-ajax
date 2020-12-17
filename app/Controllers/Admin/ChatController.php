<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\{
	UserModel,	
	ChatModel,
	ChannelModel
};
use Bcrypt\Bcrypt;

class ChatController extends BaseController
{
	public function index(){
		$chatModel = new ChatModel();		
		$pager = \Config\Services::pager();

		$dataChat = $chatModel->orderBy('id','desc');

		if(!empty($this->request->getGet('search'))){
			$dataChat = $dataChat
			->groupStart()
				->orWhere('message',$this->request->getGet('search'))
				->orWhere('channel_id',$this->request->getGet('search'))
				->orWhere('id',$this->request->getGet('search'))
			->groupEnd();
		}

		$dataChat = $dataChat->paginate(10,'query');

		$data = [
			"chat" => $dataChat,
			"pager" => $chatModel->pager
		];

		foreach($data['chat'] as $key => $item){
			$channelModel = new ChannelModel();
			$userModel = new UserModel();

			$dataChannel = $channelModel->where('id',$item['channel_id'])->first();

			$data['chat'][$key]['sender_username'] = $userModel->where('id',$item['sender'] == 'sender' ? $dataChannel['sender_id'] : $dataChannel['accepter_id'])->first()['username'];
			$data['chat'][$key]['accepter_username'] = $userModel->where('id',$item['sender'] == 'sender' ? $dataChannel['accepter_id'] : $dataChannel['sender_id'])->first()['username'];
		}

		return view("admin/chat",$data);
	}

	public function status($id){
		if(intval($id) < 1){
			return redirect()->back()->with("fallback",[
				"message" => "failed",
				"failed" => "Terjadi kesalahan"
			]);
		}

		$chatModel = new ChatModel();

		$chatData = $chatModel->where('id',$id)->first();

		if($chatModel
			->where('id',$id)
			->set([
				"status" => $chatData['status'] == 'active' ? "nonactive" : 'active'
			])
			->update()){
			return redirect()->back()->with("fallback",[
				"message" => "success",
				"success" => "Berhasil mengubah status"
			]);
		}		

		return redirect()->back()->with("fallback",[
			"message" => "failed",
			"failed" => "Terjadi kesalahan"
		]);
	}
}