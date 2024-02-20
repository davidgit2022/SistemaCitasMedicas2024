<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreScheduleRequest;
use App\Interfaces\ScheduleServiceInterface;

class ScheduleController extends Controller
{
    public function hours(StoreScheduleRequest $request, ScheduleServiceInterface $scheduleServiceInterface)
    {
        $date = $request->input('date');

        $doctorId = $request->input('doctor_id');

        return $scheduleServiceInterface->getAvailableIntervals($date, $doctorId);
    }
}
