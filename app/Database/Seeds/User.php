<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class User extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->db->table('users')->insert($this->generate());
        }
    }

    private function generate(): array
    {
        $faker = Factory::create();
        return [
            'imagen'                => $faker->imageUrl(),
            'nombre'                => $faker->name,
            'apellidos'             => $faker->name,
            'email'                 => $faker->email,
            'password'              => $faker->password,
            'telefono'              => $faker->phoneNumber,
            'reset_token'           => null,
            'reset_token_expiration'=> null,
            'status'                => 'activo',
            'created_at'            => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            'updated_at'            => null,
            'deleted_at'            => null
        ];
    }
}
