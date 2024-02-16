<?php

namespace App\Http\Controllers;

use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Models\User;
use App\Services\DoctorServices;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DoctorController extends Controller
{

    public function __construct(private DoctorServices $doctorServices)
    {
        $this->doctorServices = $doctorServices;
    }

    public function index(Request $request):View
    {
        $result = $this->doctorServices->getAllDoctors($request);

        $doctors = $result['doctors'];
        $filterValue = $result['filterValue'];

        return view('doctors.index', [
            'filterValue' => $filterValue,
            'doctors' => $doctors
        ]);

    }

    public function create(User $doctor):View
    {
        $result = $this->doctorServices->viewCreateDoctor($doctor);
         
        return view('doctors.create', [
            'doctor' => $doctor,
            'specialties' => $result['specialties'],
            'idsSpecialties' => $result['idsSpecialties'],
        ]);
    }


    public function store(StoreDoctorRequest $request):RedirectResponse
    {
        $this->doctorServices->createDoctor($request);

        return redirect()->route('doctors.index');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $doctor): View
    {
        $result = $this->doctorServices->viewEditDoctor($doctor);
        return view('doctors.edit',[
            'doctor' => $doctor,
            'specialties' => $result['specialties'],
            'idsSpecialties' => $result['idsSpecialties']
        ]);
    }


    public function update(UpdateDoctorRequest $request, User $doctor):RedirectResponse
    {
        if(!$doctor ){
            abort(404, 'Doctor no encontrado');
        }

        $this->doctorServices->updateDoctor($request,$doctor);
        
        return redirect()->route('doctors.index');
    }


    public function destroy(User $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index');
    }
}
