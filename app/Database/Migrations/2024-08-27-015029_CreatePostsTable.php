<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true, 'unsigned' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => '245'],
            'description' => ['type' => 'TEXT'],
            'img_url'     => ['type' => 'VARCHAR', 'constraint' => '245', 'null' => true],
            'created_at'  => ['type' => 'TIMESTAMP', 'null' => true],
            'author'      => ['type' => 'INT', 'unsigned' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('author', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
