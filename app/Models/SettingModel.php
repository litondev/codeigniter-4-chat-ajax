<?php
namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model{
	protected $table = "settings";

	protected $primaryKey = "id";

	protected $allowedFields = [
		"name",
		"value",
		"created_at",
		"updated_at"
	];

	protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    protected $updatedField  = 'updated_at';
}