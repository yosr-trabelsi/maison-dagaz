<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
       
        $admin = User::updateOrCreate(
            ['email' => 'admin@maisondagaz.com'],
            [
                'name'              => 'Administrateur',
                'password'          => Hash::make('Admin@Dagaz2026'),
                'is_admin'          => true,
                'email_verified_at' => now(),
            ]
        );

       
        $testUser = User::updateOrCreate(
            ['email' => 'user@maisondagaz.com'],
            [
                'name'              => 'Utilisateur Test',
                'password'          => Hash::make('password'),
                'is_admin'          => false,
                'email_verified_at' => now(),
            ]
        );

       
        $this->call(ProductSeeder::class, false, ['userId' => $testUser->id]);
    }
}
