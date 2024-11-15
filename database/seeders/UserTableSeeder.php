<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
        ]);
        User::create([
            'name' => 'Fahidur',
            'email' => 'fahidur@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->assignRole(1);
    }
}
