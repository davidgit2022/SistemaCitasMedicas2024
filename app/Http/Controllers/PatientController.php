<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Models\User;
use App\Services\PatientServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class PatientController extends Controller
{
    public function __construct(private PatientServices $patientServices)
    {
        $this->patientServices = $patientServices;
    }
    public function index(Request $request):View
    {
        $result = $this->patientServices->getAllPatients($request);

        return view('patients.index',[
            'filterValue' => $result['filterValue'],
            'patients' => $result['patients']
        ]);
    }


    public function create(User $patient):View
    {
        return view('patients.create', compact('patient'));
    }


    public function store(StorePatientRequest $request): RedirectResponse
    {
        $this->patientServices->createPatient($request);

        return redirect()->route('patients.index');
    }


    public function show(User $user)
    {
        
    }

    public function edit(User $patient):View
    {
        return view('patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, User $patient):RedirectResponse
    {
        $this->patientServices->updatePatient($request, $patient);

        return redirect()->route('patients.index')->with('success-create', 'Paciente actualizado correctamente');;
    }


    public function destroy(User $doctor): RedirectResponse
    {
        $doctor->delete();

        return redirect()->route('patients.index');

    }
}
