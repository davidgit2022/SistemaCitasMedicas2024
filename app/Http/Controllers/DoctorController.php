<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    private $pagination = 10;
    public function index(Request $request):View
    {
        $filterValue = $request->input('filterValue');

        if (!empty($filterValue) ) {
            $doctors = User::role('doctor')->where('name', 'LIKE', '%' . $filterValue .'%')->latest()->paginate($this->pagination);
        }else{
            $doctors = User::doctors()->latest()->paginate($this->pagination);
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


    public function store(Request $request):RedirectResponse
    {
        User::create([
            'name' => $request->name,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => password_hash(Str::random(8), PASSWORD_DEFAULT),
            'dni' => $request->dni,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ])->roles()->sync(2);

        return redirect()->route('doctors.index');
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $doctor): View
    {
        return view('doctors.edit', compact('doctor'));
    }


    public function update(Request $request, User $doctor):RedirectResponse
    {
        if(!$doctor ){
            abort(404, 'Doctor no encontrado');
        }
        $doctor->update([
            'name' => $request->name,
            'last_name' => $request->lastName,
            'email' => $request->email,
            //'password' => password_hash(Str::random(8), PASSWORD_DEFAULT),
            'dni' => $request->dni,
            'address' => $request->address,
            'mobile' => $request->mobile,
        ]);
        return redirect()->route('doctors.index');
    }


    public function destroy(User $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index');
    }
}
