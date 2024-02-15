<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'last_name' => 'principal',
            'email' => 'admin@gmail.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'dni' => '1085300505',
            'address' => 'street false',
            'mobile' => '3122359623'
        ])->assignRole('admin');

        User::create([
            'name' => 'doctor',
            'last_name' => 'principal',
            'email' => 'doctor@gmail.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'dni' => '1085300505',
            'address' => 'street false',
            'mobile' => '3122359623'
        ])->assignRole('doctor');


        User::create([
            'name' => 'patient',
            'last_name' => 'principal',
            'email' => 'patient@gmail.com',
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'dni' => '1085300505',
            'address' => 'street false',
            'mobile' => '3122359623'
        ])->assignRole('patient');


        User::factory()
            ->count(50)
            ->create()
            ->each(function ($user){
                $user->assignRole('patient');
            });

        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user){
                $user->assignRole('doctor');
            });
    }
}
