<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialty;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create() : View {
        $specialties = Specialty::all();
        $doctors = User::all();
        return view('appointments.create', compact('specialties', 'doctors'));
    }
}
