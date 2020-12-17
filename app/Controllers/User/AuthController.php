<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\{
	UserModel
};
use Bcrypt\Bcrypt;

class AuthController extends BaseController
{
	// DAFTAR
	public function signup()
	{
		$this->validation->setRules([
			"username" => "required|is_unique[users.username]",
			"email" => "required|valid_email|is_unique[users.email]",
			"password" => "required|min_length[8]"
		],[
			"username" => [
				"required" => "Username harus diisi",
				"is_unique" => "Username telah terpakai"
			],
			"email" => [
				"required" => "Email Harus diisi",
				"valid_email" => "Email tidak valid",
				'is_unique' => "Email telah terpakai"
			],
			"password" => [
				"required" => "Password Harus diisi",
				"min_length" => "Minimal password harus 8 karakter"
			]
		]);

		$this->validation->withRequest($this->request)->run();

		if(count($this->validation->getErrors())){
			return redirect()->to("/signup")->with("fallback",[
				"message" => "failed",
				"failed" => $this->validation->getErrors()[array_keys($this->validation->getErrors())[0]]
			]);
		}

		$hash = new Bcrypt();
		$user = new UserModel();

		if($user->insert([
			"username" => str_replace(" ", "-", htmlspecialchars($this->request->getPost('username'))),
			"email" => htmlspecialchars($this->request->getPost('email')),
			"password" => $hash->hash(htmlspecialchars($this->request->getPost('password')))
		])){
			return redirect()->to("/signin")->with("fallback",[
				"message" => "success",
				"success" => "Berhasil membuat akun"
			]);
		}

		return redirect()->to("/signup")->with("fallback",[
			"message" => "failed",
			"failed" => "Terjadi Kesalahan"
		]);
	}

	// MASUK
	public function signin(){		
		$this->validation->setRules([
			"email" => "required|valid_email",
			"password" => "required|min_length[8]"
		],[
			"email" => [
				"required" => "Email Harus diisi",
				"valid_email" => "Email tidak valid"
			],
			"password" => [
				"required" => "Password Harus diisi",
				"min_length" => "Minimal password harus 8 karakter"
			]
		]);

		$this->validation->withRequest($this->request)->run();

		if(count($this->validation->getErrors())){
			return redirect()->to("/signn")->with("fallback",[
				"message" => "failed",
				"failed" => $this->validation->getErrors()[array_keys($this->validation->getErrors())[0]]
			]);
		}

		$hash = new Bcrypt();
		$userModel =  new UserModel();

		$user = $userModel->where('email',htmlspecialchars($this->request->getPost('email')))->first();

		if(!$user){
			return redirect()->to("/signin")->with("fallback",[
				"message" => "failed",
				"failed" => "Email tidak ditemukan"
			]);		
		}

		if(!$hash->verify(htmlspecialchars($this->request->getPost('password')),$user['password'])){
			return redirect()->to("/signin")->with("fallback",[
				"message" => "failed",
				"failed" => "Password tidak ditemukan"
			]);		
		}

		unset($user['password']);

		$this->session->set('user',$user);

		return redirect()->to($user['role'] == 'admin' ? "/admin" : '/user')->with("fallback",[
			"message" => "success",
			"success" => "Berhasil masuk"
		]);
	}

	public function logout(){
		$this->session->destroy();
		
		return redirect()->to("/");
	}
}
