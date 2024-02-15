<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $doctor = Role::create(['name' => 'doctor']);
        $patient = Role::create(['name' => 'patient']);
    }
}
