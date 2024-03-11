<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\Patients\PatientUtils;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;

class PatientServices
{
    private $pagination = 10;
    public function getAllPatients(Request $request)
    {
        $filterValue = $request->input('filterValue');

        if (!empty($filterValue)) {
            $patientsFilter = User::where('name', 'LIKE', '%' . $filterValue . '%')
                ->orWhere('last_name', 'LIKE', '%' . $filterValue . '%')
                ->orWhere('email', 'LIKE', '%' . $filterValue . '%')
                ->orWhere('dni', 'LIKE', '%' . $filterValue . '%');
            $patients = $patientsFilter->role('patient')->latest()->paginate($this->pagination);
        } else {
            $patients = User::patients()->latest()->paginate($this->pagination);
        }

        return [
            'filterValue' => $filterValue,
            'patients' => $patients,
        ];
    }

    public function createPatient(StorePatientRequest $request)
    {
        $patient = User::create([
            'name' => $request->name,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'dni' => $request->dni,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);

        //$fileName = PatientUtils::savePhoto($request->photo);
        //$patient->photo = 'img/profiles/patients/' .  $fileName;
        $patient->save();

        $patient->roles()->sync(3);

        return $patient;
    }


    public function updatePatient(UpdatePatientRequest $request, User $patient)
    {
        $patient->update([
            'name' => $request->name,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'dni' => $request->dni,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);

        /* $fileName = PatientUtils::updatePhoto($request->photo);
        $patient->photo = 'img/profiles/patients/' . $fileName; */

        
        $patient->save();

        

        return $patient;
    }
}
