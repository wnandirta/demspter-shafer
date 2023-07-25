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
        $userArr = [
            [
                'name'  => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role'  => 'Admin',
            ],
            [
                'name'  => 'Guru',
                'email' => 'guru@gmail.com',
                'password' => Hash::make('12345678'),
                'role'  => 'Guru',
            ],
            [
                'name'  => 'Siswa',
                'email' => 'siswa@gmail.com',
                'password' => Hash::make('12345678'),
                'role'  => 'Siswa',
            ]
        ];
        User::insert($userArr);
    }
}
