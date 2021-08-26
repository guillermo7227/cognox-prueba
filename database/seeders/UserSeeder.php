<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Juan Pérez',
            'email' => 'juan@gmail.com',
            'identification' => 1234567,
            'password' => Hash::make('1234')
        ]);

        User::factory()->create([
            'name' => 'Pedro Carmona',
            'email' => 'pedro@gmail.com',
            'identification' => 7654321,
            'password' => Hash::make('1234')
        ]);

        User::factory()->create([
            'name' => 'Andrés Machado',
            'email' => 'andres@gmail.com',
            'identification' => 12121212,
            'password' => Hash::make('1234')
        ]);
    }
}
