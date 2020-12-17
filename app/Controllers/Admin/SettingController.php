<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\{
	SettingModel
};

class SettingController extends BaseController
{
	public function index()
	{
		return view("admin/setting");
	}	

	public function edit(){
		$keys = array_keys($this->request->getPost());

		foreach($keys as $item){
			$settingModel = new SettingModel();
			$settingModel->where('name',$item)
			->set([
				'value' => $this->request->getPost($item)
			])
			->update();
		}

		return redirect()->to("/admin/setting")->with("fallback",[
			"message" => "success",
			"success" => "Berhasil mengedit setting"
		]);
	}
}
