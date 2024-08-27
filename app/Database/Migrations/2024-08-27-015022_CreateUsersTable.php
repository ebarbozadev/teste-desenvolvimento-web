<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => '245'],
            'email'       => ['type' => 'VARCHAR', 'constraint' => '245', 'unique' => true],
            'password'    => ['type' => 'VARCHAR', 'constraint' => '245'],
            'created_at'  => ['type' => 'TIMESTAMP', 'null' => true],
            'updated_at'  => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
