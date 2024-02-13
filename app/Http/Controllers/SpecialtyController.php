<?php

namespace App\Http\Controllers;

use App\Http\Requests\Specialty\StoreSpecialtyRequest;
use App\Http\Requests\Specialty\UpdateSpecialtyRequest;
use App\Models\Specialty;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    private $pagination = 5;
    public function index(Request $request):View
    {
        $filterValue = $request->input('filterValue');

        if (!empty($filterValue)) {
            $specialtiesFilter = Specialty::where('name', 'LIKE', '%' . $filterValue . '%');

            $specialties = $specialtiesFilter->latest()->paginate($this->pagination);
        }else{
            $specialties = Specialty::latest()->paginate($this->pagination);
        }

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
        $specialty = new Specialty();
        $specialty->name = $request->name;
        $specialty->description = $request->description;
        $specialty->save();

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
        $specialty->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('specialties.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        //
    }
}
