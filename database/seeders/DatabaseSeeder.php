<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Packing',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Operator User',
            'email'    => 'user@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'user',
        ]);

        Product::create([
            'product_code' => 'PRD-001',
            'product_name' => 'Kardus Packing Ukuran M',
            'description'  => 'Ukuran 30x20x15 cm',
        ]);

        Product::create([
            'product_code' => 'PRD-002',
            'product_name' => 'Bubble Wrap Heavy Duty',
            'description'  => 'Panjang 50 meter',
        ]);
    }
}