<?php namespace App\Services;

use App\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;
use App\Models\Schedule;
use App\Models\Appointment;

class ScheduleInterfaceService implements ScheduleServiceInterface {

    private function getDayFromDate($date)
    {
        $dateCarbon = new Carbon($date);
        $i = $dateCarbon->dayOfWeek;
        $day = ($i == 0 ? 6 : $i - 1);
        return $day;
    }

    public function isAvailableInterval($date, $doctorId, Carbon $start)
    {
        $exists = Appointment::where('doctor_id', $doctorId)
            ->where('scheduled_date', $date)
            ->where('scheduled_time', $start->format('H:i:s'))
            ->exists();
        return !$exists;
    }

    public function getAvailableIntervals($date, $doctorId)
    {
        $schedule = Schedule::where('active', true)
            ->where('day', $this->getDayFromDate($date))
            ->where('user_id', $doctorId)
            ->first([
                'morning_start', 'morning_end',
                'afternoon_start', 'afternoon_end'
            ]);
        if (!$schedule) {
            return [];
        }

        $morningIntervals = $this->getIntervals(
            $schedule->morning_start, $schedule->morning_end, $doctorId, $date
        );

        $afternoonIntervals = $this->getIntervals(
            $schedule->afternoon_start, $schedule->afternoon_end, $doctorId, $date
        );

        $data = [];
        $data['morning'] = $morningIntervals;
        $data['afternoon'] = $afternoonIntervals;
        return $data;
    }

    private function getIntervals($start, $end, $doctorId, $date)
    {
        $start = new Carbon($start);
        $end = new Carbon($end);

        $intervals = [];
        while ($start < $end) {
            $interval = [];
            $interval['start'] = $start->format('g:i A');

            $available = $this->isAvailableInterval($date, $doctorId, $start);

            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');

            if ($available) {
                $intervals [] = $interval;
            }
            
        }
        return $intervals;
    }
}
