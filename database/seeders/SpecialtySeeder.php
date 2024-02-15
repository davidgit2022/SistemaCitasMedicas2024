<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            'Cardiología',
            'Dermatología',
            'Neurología',
            'Psiquiatría',
            'Ginecología',
            'Ortopedia',
            'Oftalmología',
            'Endocrinología',
            'Nefrología',
            'Pediatría',
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'name' => $specialty,
            ]);
        }
    }
}
