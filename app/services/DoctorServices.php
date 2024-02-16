<?php
namespace App\Services;

use App\Models\User;
use App\Models\Specialty;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;

class DoctorServices {
    private $pagination = 10;

    public function getAllDoctors(Request $request) 
    {
        $filterValue = $request->input('filterValue');

        if (!empty($filterValue) ) {
            $doctors = User::role('doctor')->where('name', 'LIKE', '%' . $filterValue .'%')->latest()->paginate($this->pagination);
        }else{
            $doctors = User::doctors()->latest()->paginate($this->pagination);
        }

        return [
            'filterValue' => $filterValue,
            'doctors' => $doctors
        ];
    }

    public function viewCreateDoctor(User $doctor)
    {
        $specialties = Specialty::all();
        $idsSpecialties = $doctor->specialties()->pluck('specialties.id');

        return [
            'specialties' => $specialties,
            'idsSpecialties' => $idsSpecialties
        ];
    }

    public function createDoctor(StoreDoctorRequest $request)
    {
        $doctor = [
            'name' => $request->name,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => password_hash(Str::random(8), PASSWORD_DEFAULT),
            'dni' => $request->dni,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ];

        $user = User::create($doctor);

        $user->roles()->sync(2);

        $user->specialties()->attach($request->input('specialties'));
        return $doctor;
    }

    public function viewEditDoctor(User $doctor)
    {
        $specialties = Specialty::all();
        $idsSpecialties = $doctor->specialties()->pluck('specialties.id');

        return [
            'specialties' => $specialties,
            'idsSpecialties' => $idsSpecialties
        ];
    }

    public function updateDoctor(UpdateDoctorRequest $request, User $doctor)
    {
        $doctor->update([
            'name' => $request->name,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'dni' => $request->dni,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);

        return $doctor;
    }

}

?>