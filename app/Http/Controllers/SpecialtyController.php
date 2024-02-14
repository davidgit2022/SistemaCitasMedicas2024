<?php

namespace App\Http\Controllers;

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

        $specialties = $result['specialties'];
        $filterValue = $result['filterValue'];


        return view('specialties.index', [
            'specialties' => $specialties,
            'filterValue' => $filterValue
        ]);
    }


    public function create(Specialty $specialty):View
    {
        return view('specialties.create', compact('specialty'));
    }


    public function store(StoreSpecialtyRequest $request): RedirectResponse
    {
        $this->specialtyServices->createSpecialty($request);

        return redirect()->route('specialties.index');
    }


    public function show(Specialty $specialty)
    {
        //
    }

    public function edit(Specialty $specialty): View
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function update(UpdateSpecialtyRequest $request, Specialty $specialty): RedirectResponse
    {
        $this->specialtyServices->updateSpecialty($request, $specialty);

        return redirect()->route('specialties.index');
    }


    public function destroy(Specialty $specialty):RedirectResponse
    {
        $specialty->delete();
        return redirect()->route('specialties.index');
    }
}
