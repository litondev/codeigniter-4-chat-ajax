<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'username'       => [
                    'type'           => 'VARCHAR',
                    'constraint'     => 50,
                    'unique'		 => true
            ],
            'email' => [
                    'type'           => 'VARCHAR',                        
                    'constraint'     => 50,
                    'unique'		 => true
            ],
            'password' => [
            		'type'			 => 'TEXT',  
                    'constraint'     => 255,              		
            ],
            'photo'  => [
            		'type'			 => 'TEXT',
            		'default'		 => 'default.png'
            ],
            'role'        => [
                    'type'           => 'ENUM',
                    'constraint'     => ['admin','user'],
                    'default'        => 'user'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
