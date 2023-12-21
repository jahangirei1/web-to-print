<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = collect(
            [
                [
                    'first_name' => 'Anas',
                    'last_name' => 'Jakwani',
                    'email' => 'anas.j@ei1tech.com',
                    'password' => Hash::make('Anas1234'),
                    'type' => '1'
                ],
                [
                    'first_name' => 'Hannan',
                    'last_name' => 'Ashraf',
                    'email' => 'hannan@ei1tech.com',
                    'password' => Hash::make('Hannan1234'),
                    'type' => '0'
                ],
                [
                    'first_name' => 'Jahangir',
                    'last_name' => 'Tayyab',
                    'email' => 'jahangir@ei1tech.com',
                    'password' => Hash::make('Jahangir1234'),
                    'type' => '1'
                ],
                [
                    'first_name' => 'Zohaib',
                    'last_name' => 'Ahmed',
                    'email' => 'zohaib@ei1tech.com',
                    'password' => Hash::make('Zohaib1234'),
                    'type' => '0'
                ],
                [
                    'first_name' => 'Urooj',
                    'last_name' => 'Arif',
                    'email' => 'urooj@ei1tech.com',
                    'password' => Hash::make('Urooj1234'),
                    'type' => '2'
                ],
                [
                    'first_name' => 'Zeeshan',
                    'last_name' => 'Arif',
                    'email' => 'zeeshan@ei1tech.com',
                    'password' => Hash::make('Zeeshan1234'),
                    'type' => '3'
                ],
                [
                    'first_name' => 'Shakir',
                    'last_name' => 'Bhai',
                    'email' => 'shakir@ei1tech.com',
                    'password' => Hash::make('Shakir1234'),
                    'type' => '2'
                ],
                [
                    'first_name' => 'Tariq',
                    'last_name' => 'Bhai',
                    'email' => 'tariq@ei1tech.com',
                    'password' => Hash::make('Tariq1234'),
                    'type' => '3'
                ]
            ]
        );

        $users->each(function($admin){
            User::insert($admin);
        });
    }
}
