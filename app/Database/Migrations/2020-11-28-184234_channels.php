<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Channels extends Migration
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
            'sender_id'	  => [
            		'type'			 => 'INT',
            		'constraint'	 => 11,
            		'unsigned'		 => true
            ],
            'accepter_id' => [
            		'type'			 => 'INT',
            		'constraint'	 => 11,
            		'unsigned'		 => true
            ],   
            'time datetime default current_timestamp',
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

		$this->forge->addForeignKey('sender_id','users','id');
		$this->forge->addForeignKey('accepter_id','users','id');
		
        $this->forge->addKey('id', true);

        $this->forge->createTable('channels');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('channels');
	}
}
