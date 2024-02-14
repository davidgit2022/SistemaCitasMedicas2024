<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorController extends Controller
{
    private $pagination = 10;
    public function index(Request $request):View
    {
        $filterValue = $request->input('filterValue');

        if (!empty($filterValue) ) {
            $doctors = User::where('name', 'LIKE', '%' . $filterValue .'%')->latest()->paginate($this->pagination);
        }else{
            $doctors = User::latest()->paginate($this->pagination);
        }
        return view('doctors.index', [
            'filterValue' => $filterValue,
            'doctors' => $doctors
        ]);
    }

    public function create(User $doctor):View
    {
        return view('doctors.create', compact('doctor'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }
}
