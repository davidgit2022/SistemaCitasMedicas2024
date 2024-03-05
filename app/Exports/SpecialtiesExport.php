<?php

namespace App\Exports;

use App\Models\Specialty;
use Maatwebsite\Excel\Concerns\FromCollection;

class SpecialtiesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Specialty::all();
    }
}
