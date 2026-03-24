<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@epatunay.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Juan Dela Cruz',
            'email' => 'juan@epatunay.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        User::factory()->create([
            'name' => 'Maria Santos',
            'email' => 'maria@epatunay.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);
    }
}
