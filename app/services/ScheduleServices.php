<?php

namespace App\Services;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleServices{

    private $days = [
        'Lunes', 'Martes', 'Mièrcoles', 'Jueves', 'Viernes', 'Sàbado', 'Domingo',
    ];
    public function editSchedule(){
        $schedules = Schedule::where('user_id', auth()->id())->get();

        if (count($schedules) > 0) {
            $schedules->map(function ($schedules)
        {
            $schedules->morning_start = (new Carbon($schedules->morning_start))->format('g:i A');
            $schedules->morning_end = (new Carbon($schedules->morning_end))->format('g:i A');
            $schedules->afternoon_start = (new Carbon($schedules->afternoon_start))->format('g:i A');
            $schedules->afternoon_end = (new Carbon($schedules->afternoon_end))->format('g:i A');
        });
        }else {
            $schedules = collect();
            for ($i=0; $i <7 ; ++$i) {
                $schedules->push(new Schedule());
            }
        }

        $days = $this->days;

        return [
            'days' => $days,
            'schedules' => $schedules
        ];
    }

    public function createSchedule(Request $request)
    {
        $active = $request->input('active') ?: [];
        $morning_start = $request->morning_start;
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        $errors = [];

        for ($i = 0; $i < 7; ++$i) {
            if ($morning_start[$i] > $morning_end[$i]) {
                $errors [] = 'Inconsistencia en el intervalo de las horas en el turno de la mañana del dia '.$this->days[$i] . '.';
            }
            if ($afternoon_start[$i] > $afternoon_end[$i]) {
                $errors [] = 'Inconsistencia en el intervalo de las horas en el turno de la tarde del dia '.$this->days[$i] . '.';
            }
            $schedule =  Schedule::updateOrCreate(
                [
                    'day' => $i,
                    'user_id' => auth()->id(),
                ],
                [
                    'active' => in_array($i, $active),
                    'morning_start' => $morning_start[$i],
                    'morning_end' => $morning_end[$i],
                    'afternoon_start' => $afternoon_start[$i],
                    'afternoon_end' => $afternoon_end[$i],
                ]
            );
        }
        if (count($errors) > 0) {
            return back()->with(compact('errors'));
        }

        return $schedule;
    }
}

?>