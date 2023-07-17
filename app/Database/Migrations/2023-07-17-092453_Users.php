<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'u_id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'u_first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'u_last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'dob' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'u_gender' => [
                'type' => 'INT',
                'null' => true,
            ],
            'u_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'u_phone' => [
                'type' => 'INT',
            ],
            'u_password' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => '10'
            ]

        ]);
        $this->forge->addPrimaryKey('u_id');
        $this->forge->addKey('u_id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
