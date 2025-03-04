<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class Post extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 15; $i++) {
            $this->db->table('posts')->insert($this->generate());
        }
    }

    private function generate(): array
    {
        $users = $this->db->table('users')->select('id')->get()->getResultArray();
        $faker = Factory::create();
        return [
            'user_id'               => $users[array_rand($users)]['id'],
            'imagen'                => $faker->imageUrl(),
            'titulo'                => $faker->sentence,
            'contenido'             => $faker->paragraph,
            'status'                => 'activo',
            'created_at'            => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'updated_at'            => null,
            'deleted_at'            => null
        ];
    }
}
