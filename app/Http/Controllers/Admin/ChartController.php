<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Services\ChartServices;

class ChartController extends Controller
{

    public function __construct(private ChartServices $chartServices)
    {
        $this->chartServices = $chartServices;
    }
    public function appointments() : View 
    {
        $counts = $this->chartServices->appointmentCount();
        return view('admin.charts.appointments', compact('counts'));
    }

    public function doctors()
    {
        $result = $this->chartServices->doctorsChart();
        return view('admin.charts.doctors', [
            'end' => $result['end'], 
            'start' => $result['start']
        ]);
    }

    public function doctorsJson(Request $request)
    {
        return $this->chartServices->doctorsCharJson($request);
    }
}
