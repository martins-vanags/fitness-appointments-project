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
        User::create([
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'teacher'
        ]);

        User::create([
            'name' => 'Janis',
            'surname' => 'Lapitis',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'role' => 'teacher'
        ]);
    }
}
