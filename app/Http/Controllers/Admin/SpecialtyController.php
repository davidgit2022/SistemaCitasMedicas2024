<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Http\Requests\Specialty\UpdateSpecialtyRequest;
use App\Models\Specialty;
use App\Services\SpecialtyServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{

    public function __construct(private SpecialtyServices $specialtyServices)
    {
        $this->specialtyServices = $specialtyServices;
    }
    
    public function index(Request $request):View
    {
        $result = $this->specialtyServices->getAllSpecialties($request);

        return view('admin.specialties.index', [
            'specialties' => $result['specialties'],
            'filterValue' => $result['filterValue']
        ]);
    }


    public function create(Specialty $specialty):View
    {
        return view('admin.specialties.create', compact('specialty'));
    }


    public function store(StoreSpecialtyRequest $request): RedirectResponse
    {
        $this->specialtyServices->createSpecialty($request);

        $notification = 'La especialidad se ha creado correctamente.';
        return redirect()->route('specialties.index')->with(compact('notification'));
    }


    public function show(Specialty $specialty)
    {
        //
    }

    public function edit(Specialty $specialty): View
    {
        return view('admin.specialties.edit', compact('specialty'));
    }

    public function update(UpdateSpecialtyRequest $request, Specialty $specialty): RedirectResponse
    {
        $this->specialtyServices->updateSpecialty($request, $specialty);

        $notification = 'La especialidad se ha creado actualizado.';
        return redirect()->route('specialties.index')->with(compact('notification'));
    }


    public function destroy(Specialty $specialty):RedirectResponse
    {
        $specialty->delete();
        $notification = 'La especialidad se ha eliminado correctamente.';
        return redirect()->route('specialties.index')->with(compact('notification'));
    }
}
