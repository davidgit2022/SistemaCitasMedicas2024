<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Services\ScheduleServices;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ScheduleController extends Controller
{

    public function __construct(private ScheduleServices $scheduleServices)
    {
        $this->scheduleServices = $scheduleServices;
    }
    public function edit() : View 
    {
        $result = $this->scheduleServices->editSchedule();

        return view('schedule.schedule', [
            'days' => $result['days'],
            'schedules' => $result['schedules']
        ]);
    }

    public function store(Request $request)
    {
        $this->scheduleServices->createSchedule($request);
        $notification = 'Los cambios se han guardado correctamente';
        return back()->with(compact('notification'));
    }
}
