<?php

namespace Database\Seeders;

use App\Models\Admins;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admins::create([
            'email' => 'admin@test.com',
            'name' => 'admin',
            'avatar' => '124',
            'user_type' => 'super-admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
