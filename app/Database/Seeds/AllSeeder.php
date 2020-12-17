<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\{
	SettingModel,
	UserModel,
};
use Bcrypt\Bcrypt;

class AllSeeder extends Seeder
{
	public function run()
	{
		$settingModel = new SettingModel();
		$userModel =  new UserModel();
		$bcrypt = new Bcrypt();

		$settingModel->insert([
			'name' => 'site_name',
			'value' => 'Testing'
		]);

		$settingModel->insert([
			"name" => "interval_channel",
			"value" => 1
		]);

		$settingModel->insert([
			"name" => "interval_chat",
			"value" => 1
		]);

		$userModel->insert([
			'username' => 'admin',
			'email'	=> 'admin@admin.com',
			'password' => $bcrypt->hash("12345678"),				
			"role" => "admin"
		]);

		$userModel->insert([
			'username' => 'user',
			'email' => 'user@user.com',
			'password' => $bcrypt->hash('12345678')
		]);

		for($i=0;$i<100;$i++){
			$userModel->insert([
				"username" => "user".$i,
				"email" => "user".$i."@user.com",
				"password" => $bcrypt->hash("12345678")
			]);
		}
	}
}
