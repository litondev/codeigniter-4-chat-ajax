<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Chats extends Migration
{
	public function up()
	{
		$this->forge->addField([
            'id'          => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
            ], 
            'channel_id'  => [
            		'type'			 => 'INT',
            		'constraint'	 => 11,
            		'unsigned'		 => true
            ],                      
            'sender' 		=> [
            		'type'			 =>  'ENUM',
            		'constraint' 	 => ['sender','accepter'] 		
            ],
            'message' 		=> [
            		'type'			 => 'TEXT'
            ],
            'type'			=> [
            		'type'			 => 'ENUM',
            		'constraint'	 => ['text','image','file'],
            		'default'		 => 'text'
            ],
            'status'        => [
                    'type'           => 'ENUM',
                    'constraint'     => ['active','nonactive'],
                    'default'        => 'active'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

		$this->forge->addForeignKey('channel_id','channels','id');
		
        $this->forge->addKey('id', true);

        $this->forge->createTable('chats');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('chats');
	}
}
