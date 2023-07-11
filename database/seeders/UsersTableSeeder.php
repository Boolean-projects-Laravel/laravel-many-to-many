<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Paolo',
                'email' => 'paolo.falco@mail.com',
                'password' => Hash::make('paolo1996'),
            ],
            [
                'name' => 'Alessio',
                'email' => 'alessio.abbati@mail.com',
                'password' => Hash::make('alessio12345'),
            ],
            [
                'name' => 'Davide',
                'email' => 'davide.farci@mail.com',
                'password' => Hash::make('davide12345'),
            ],
            [
                'name' => 'Antonio',
                'email' => 'antonio.angelo@mail.com',
                'password' => Hash::make('antonio12345'),
            ],
        ];

        foreach ($users as $user_data) {
            User::create($user_data);
        }

    }
}