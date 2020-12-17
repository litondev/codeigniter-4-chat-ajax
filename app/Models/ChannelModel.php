<?php
namespace App\Models;

use CodeIgniter\Model;

class ChannelModel extends Model{
	protected $table = "channels";

	protected $primaryKey = "id";

	protected $allowedFields = [
		"sender_id",
		"accepter_id",
		"time",
		"created_at",
		"updated_at"
	];

	protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    protected $updatedField  = 'updated_at';
}