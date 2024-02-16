<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use Illuminate\Support\Str;


class PatientServices{
    private $pagination = 10;
    public function getAllPatients(Request $request)
    {
        $filterValue = $request->input('filterValue');

        if (! empty($filterValue)) {
            $patientsFilter = User::where('name', 'LIKE', '%' . $filterValue . '%' );
            $patients = $patientsFilter->role('patient')->latest()->paginate($this->pagination);
        }else{
            $patients = User::patient()->latest()->paginate($this->pagination);
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
            'password' => password_hash(Str::random(8), PASSWORD_DEFAULT),
            'dni' => $request->dni,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);

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

        return $patient;

    }
}
?>