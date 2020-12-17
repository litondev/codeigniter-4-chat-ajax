<?php namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\{
	UserModel
};
use Bcrypt\Bcrypt;

class ProfilController extends BaseController
{
	public function index()
	{
		return view("user/profil");
	}

	public function editProfilData(){    	
    	$rules = [
			"username" => "required|is_unique[users.username,id,".session('user')['id']."]",
			"email" => "required|valid_email|is_unique[users.email,id,".session('user')['id']."]",
			"password_confirm" => "required|min_length[8]"
		];

		$messages = [
			"username" => [
				"required" => "Username harus diisi",
				"is_unique" => "Username telah dipakai"
			],
			"email" => [
				"required" => "Email Harus diisi",
				"valid_email" => "Email tidak valid",
				"is_unique" => "Email telah dipakai"
			],			
			"password_confirm" => [
				"min_length" => "Minimal password confirm harus 8 karakter",
				"required" => "Password confirm harus diisi"
			]
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
			return redirect()->to("/profil")->with("fallback",[
				"message" => "failed",
				"failed" => $this->validation->getErrors()[array_keys($this->validation->getErrors())[0]]
			]);
		}

		$hash = new Bcrypt();
		$userModel =  new UserModel();

		$user = $userModel->where('id',session('user')['id'])->first();

		if(!$hash->verify(htmlspecialchars($this->request->getPost('password_confirm')),$user['password'])){
			return redirect()->to("/profil")->with("fallback",[
				"message" => "failed",
				"failed" => "Password konfirmasi tidak valid"
			]);
		}

		$userModel =  new UserModel();

		$payload = [
			"username" => htmlspecialchars($this->request->getPost('username')),
			"email" => htmlspecialchars($this->request->getPost('email')),
		];

		if(!empty($this->request->getPost('password'))){
			$payload["password"] = $hash->hash(htmlspecialchars($this->request->getPost('password')));
		}

		if($userModel->update(session('user')['id'],$payload)){
			$this->setSessionUser();

			return redirect()->to("/profil")->with("fallback",[
				"message" => "success",
				"success" => "Berhasil update data"
			]);
		}	

		return redirect()->to("/profil")->with("fallback",[
			"message" => "failed",
			"failed" => "Terjadi Kesalahan"
		]);
	}

	public function editProfilPhoto(){
		$image = \Config\Services::image();

		$this->validation->setRules([
			"photo" => "uploaded[photo]|max_size[photo,10024]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_dims[photo,5000,5000]"
		],[
			"photo" => [
				"uploaded" => "Gambar harus diisi",
				"max_size" => "Max gambar 10 mb",
				"mime_in" => "Gambar tidak valid",
				"max_dims" => "Dimensi gambar tidak valid"
			]
		]);

		$this->validation->withRequest($this->request)->run();

		if(count($this->validation->getErrors())){
			return redirect()->to("/profil")->with("fallback",[
				"message" => "failed",
				"failed" => $validation->getErrors()[array_keys($this->validation->getErrors())[0]]
			]);
		}

		$photo = $this->request->getFile('photo');
	    $name = $photo->getRandomName();	  

  		if($image->withFile($photo->getTempName())  		   
        	->fit(700, 700, 'center')
        	->save('./assets/images/users/'.$name)){

  			$userModel =  new UserModel();

  			if($userModel->update(session('user')['id'],[
  					"photo" => $name
  				])){  				
  				if(session('user')['photo'] != 'default.png'){						 
  					$filePath = "./assets/images/users/".session('user')['photo'];

					if(file_exists($filePath)){
						unlink($filePath);
					}						
  				}				

  				$this->setSessionUser();

  				return redirect()->to("/profil")->with("fallback",[
  					"message" => "success",
  					"success" => "Berhasil merubah gambar"
  				]);
  			}

  			// unlink photo
  		}

  		return redirect()->to("/profil")->with("fallback",[
  			"message" => "failed",
  			"error" => "Terjadi Kesalahan"
  		]);
	}

	public function setSessionUser(){
		$userModel =  new UserModel();

		$user = $userModel->where('id',session('user')['id'])->first();

		unset($user['password']);			

		$this->session->set('user',$user);
	}
}