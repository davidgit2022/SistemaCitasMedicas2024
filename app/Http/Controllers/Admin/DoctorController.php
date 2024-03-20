<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DoctorsExport;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\DoctorServices;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportListDoctor() 
    {
        $fileName = 'List doctors:' . date('Y-m-d H:i:s') . '.xlsx';
        return Excel::download(new DoctorsExport, $fileName);
    }

}