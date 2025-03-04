<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'imagen'                => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'nombre'                => ['type' => 'varchar', 'constraint' => 50],
            'apellidos'             => ['type' => 'varchar', 'constraint' => 50],
            'email'                 => ['type' => 'varchar', 'constraint' => 100, 'unique' => true],
            'password'              => ['type' => 'varchar', 'constraint' => 255],
            'telefono'              => ['type' => 'varchar', 'constraint' => 20, 'null' => true],
            'reset_token'           => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'reset_token_expiration'=> ['type' => 'datetime', 'null' => true],
            'status'                => ['type' => 'varchar', 'constraint' => 20, 'default' => 'activo'],
            'created_at'            => ['type' => 'datetime'],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
