<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Models\Specialty;
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

        return view('admin.doctors.index', [
            'filterValue' => $result['filterValue'],
            'doctors' => $result['doctors']
        ]);

        $notification = 'El doctor se ha creado correctamente.';
        return redirect()->route('doctors.index')->with(compact('notification'));

    }

    public function create(User $doctor):View
    {
        $result = $this->doctorServices->viewCreateDoctor($doctor);
         
        return view('admin.doctors.create', [
            'doctor' => $doctor,
            'specialties' => $result['specialties'],
            'idsSpecialties' => $result['idsSpecialties'],
        ]);
    }


    public function store(StoreDoctorRequest $request):RedirectResponse
    {
        $this->doctorServices->createDoctor($request);

        $notification = 'El doctor se ha creado correctamente.';
        return redirect()->route('doctors.index')->with(compact('notification'));
    }


    public function show(User $doctor) : View
    {
        $specialties = $doctor->specialties()->select('name')->get();
        return view('admin.doctors.show', compact('doctor', 'specialties'));
    }


    public function edit(User $doctor): View
    {
        $result = $this->doctorServices->viewEditDoctor($doctor);
        return view('admin.doctors.edit',[
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
        
        $notification = 'El doctor se ha actualizado correctamente.';
        return redirect()->route('doctors.index')->with(compact('notification'));
    }


    public function destroy(User $doctor)
    {
        $doctor->delete();

        $notification = 'El doctor se ha eliminado correctamente.';
        return redirect()->route('doctors.index')->with(compact('notification'));
    }
}