<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\{
	UserModel,	
};
use Bcrypt\Bcrypt;

class UserController extends BaseController
{
	public function index(){
		$userModel = new UserModel();
		$pager = \Config\Services::pager();

		$dataUser = $userModel->orderBy('id','desc');

		if(!empty($this->request->getGet('search'))){
			$dataUser = $dataUser
			->groupStart()
				->orWhere('username',$this->request->getGet('search'))
				->orWhere('email',$this->request->getGet('search'))
				->orWhere('id',$this->request->getGet('search'))
			->groupEnd();
		}

		$dataUser = $dataUser->paginate(10,'query');

		$data = [
			"user" => $dataUser,
			"pager" => $userModel->pager
		];

		return view("admin/user",$data);
	}

	public function edit(){    	
    	$rules = [
    		"id" => "required",
			"username" => "required|is_unique[users.username,id,".$this->request->getPost('id')."]",
			"email" => "required|valid_email|is_unique[users.email,id,".$this->request->getPost('id')."]",
		];

		$messages = [
			"id" => [
				"required" => "Id harus diisi"
			],
			"username" => [
				"required" => "Username harus diisi",
				"is_unique" => "Username telah dipakai"
			],
			"email" => [
				"required" => "Email Harus diisi",
				"valid_email" => "Email tidak valid",
				"is_unique" => "Email telah dipakai"
			],						
		];

		if(!empty($this->request->getPost('password'))){
			$rules["password"] = "min_length[8]";
			
			$messages["password"] = [
				"min_length" => "Minimal password harus 8 karakter"
			];
		}	

		$this->validation->setRules($rules,$messages);

		$this->validation->withRequest($this->request)->run();

		if(count($this->validation->getErrors())){
			return redirect()->back()->with("fallback",[
				"message" => "failed",
				"failed" => $this->validation->getErrors()[array_keys($this->validation->getErrors())[0]]
			]);
		}

		$hash = new Bcrypt();
		$userModel =  new UserModel();

		$payload = [
			"username" => htmlspecialchars($this->request->getPost('username')),
			"email" => htmlspecialchars($this->request->getPost('email')),
		];

		if(!empty($this->request->getPost('password'))){
			$payload["password"] = $hash->hash(htmlspecialchars($this->request->getPost('password')));
		}

		if($userModel->update($this->request->getPost('id'),$payload)){
			return redirect()->back()->with("fallback",[
				"message" => "success",
				"success" => "Berhasil update data"
			]);
		}	

		return redirect()->back()->with("fallback",[
			"message" => "failed",
			"failed" => "Terjadi Kesalahan"
		]);	
	}
}