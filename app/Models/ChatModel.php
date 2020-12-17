<?php
namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model{
	protected $table = "chats";

	protected $primaryKey = "id";

	protected $allowedFields = [
		"channel_id",
		"sender",
		"message",
		"type",
		"status",
		"created_at",
		"updated_at"
	];

	protected $useTimestamps = true;

    protected $createdField  = 'created_at';

    protected $updatedField  = 'updated_at';
}