<?php

namespace App\Services;

use App\Http\Requests\Specialty\StoreImportSpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Http\Requests\Specialty\UpdateSpecialtyRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SpecialtyImport;

class SpecialtyServices{
    private $pagination = 5;

    public function getAllSpecialties(Request $request)
    {

        $filterValue = $request->input('filterValue');

        if (!empty($filterValue)) {
            $specialtiesFilter = Specialty::where('name', 'LIKE', '%' . $filterValue . '%');

            $specialties = $specialtiesFilter->latest()->paginate($this->pagination);
        }else{
            $specialties = Specialty::latest()->paginate($this->pagination);
        }

        return [
            'filterValue' => $filterValue,
            'specialties' => $specialties
        ];
    }

    public function createSpecialty(StoreSpecialtyRequest $request)
    {
        $specialty = new Specialty();
        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save();

        return $specialty;
    }

    public function updateSpecialty(UpdateSpecialtyRequest $request, Specialty $specialty) {
        $specialty->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return $specialty;
    }

    public function importFile(StoreImportSpecialtyRequest $request){
        $file = $request->excel_file;

        return Excel::import(new SpecialtyImport, $file);
        
    }
}