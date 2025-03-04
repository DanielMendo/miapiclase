<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'imagen'                => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'titulo'                => ['type' => 'varchar', 'constraint' => 255],
            'contenido'             => ['type' => 'text'],
            'status'                => ['type' => 'varchar', 'constraint' => 20, 'default' => 'activo'],
            'created_at'            => ['type' => 'datetime'],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_user_post');
        $this->forge->createTable('posts', true);
    }

    public function down()
    {
        $this->forge->dropTable('posts', true);
    }
}
