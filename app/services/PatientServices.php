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
            $patientsFilter = User::where('name', 'LIKE', '%' . $filterValue . '%' )
            ->orWhere('last_name', 'LIKE', '%' . $filterValue . '%')
            ->orWhere('email', 'LIKE', '%' . $filterValue . '%')
            ->orWhere('dni', 'LIKE', '%' . $filterValue . '%');
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

        

        if($request->photo){
            $fileName = uniqid() . '_.' . $request->photo->extension();
            $request->photo->move(public_path('img/profiles/patients'), $fileName);
            $patient->photo = 'img/profiles/patients/' . $fileName;
            $patient->save();
        }

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

        if($request->photo){
            $fileName = uniqid() . '_.' . $request->photo->extension();
            $request->photo->move(public_path('img/profiles/patients'), $fileName);
            $photoOld = $request->photo;

            $patient->photo = 'img/profiles/patients/' . $fileName;
            $patient->save();

            if ($photoOld != null) {
                $oldFilePath = public_path($photoOld);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        return $patient;

    }
}
?>