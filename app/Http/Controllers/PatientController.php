<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    private $pagination = 10;
    public function index(Request $request):View
    {
        $filterValue = $request->input('filterValue');

        if (! empty($filterValue)) {
            $patientsFilter = User::where('name', 'LIKE', '%' . $filterValue . '%' );
            $patients = $patientsFilter->latest()->paginate($this->pagination);
        }else{
            $patients = User::latest()->paginate($this->pagination);
        }

        return view('patients.index',[
            'filterValue' => $filterValue,
            'patients' => $patients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $patient):View
    {
        return view('patients.create', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
