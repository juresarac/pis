<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'is_active' => 1,
        ]);
        User::create([
            'first_name' => 'Teacher',
            'last_name' => 'Teacher',
            'email' => 'teacher@teacher.com',
            'password' => Hash::make('teacher'),
            'role' => 'teacher',
            'is_active' => 1,
        ]);
        User::create([
            'first_name' => 'User',
            'last_name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'role' => 'user',
            'is_active' => 1,
        ]);
    }
}
