<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Appointment;
use Composer\Semver\Interval;
use Illuminate\Console\Command;

class DeleteCancelledAppointments extends Command
{

    protected $signature = 'delete-cancelled-appointments {days=31}';


    protected $description = 'Command description';


    public function handle()
    {
        $days = intval($this->argument('days'));

        $appointmentMajor30 = Appointment::where('status', 'cancelled')->get();
        $now = Carbon::now();
        
        foreach ($appointmentMajor30 as $appointment) {
            $dateCancellation = Carbon::parse($appointment->created_at);

            $difference = $dateCancellation->diffInDays($now);
            
            if ($difference > $days) {
                $appointment->delete();
            }
        }
    }
}
