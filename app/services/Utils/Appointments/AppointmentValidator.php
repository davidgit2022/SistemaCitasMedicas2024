<?php

namespace App\Services\Utils\Appointments;

use Carbon\Carbon;
use Illuminate\Validation\Validator;
use App\Interfaces\ScheduleServiceInterface;

class AppointmentValidator{
    public function validateAvailability(Validator $validator, $date, $doctorId, $scheduledTime, ScheduleServiceInterface $scheduleService)
    {
        if ($date && $doctorId && $scheduledTime) {
            $start = new Carbon($scheduledTime);

            if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) {
                $validator->errors()->add(
                    'availableTime',
                    'La hora seleccionada ya se encuentra reservada por otro paciente.'
                );
            }
        }
    }
}