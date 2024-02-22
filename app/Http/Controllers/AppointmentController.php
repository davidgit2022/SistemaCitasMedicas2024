<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\View\View;

use App\Models\Appointment;

use App\Services\AppointmentServices;
use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\Appointment\StoreAppointmentRequest;
use Illuminate\Http\Request;

;

class AppointmentController extends Controller
{

    public function __construct(private AppointmentServices $appointmentServices)
    {
        $this->appointmentServices = $appointmentServices;
    }
    public function index()
    {
        $result =  $this->appointmentServices->getListAppointments();

        return view('appointments.index',[

            'confirmedAppointments' => $result['confirmedAppointments'],
            'pendingAppointments' => $result['pendingAppointments'],
            'oldAppointments' => $result['oldAppointments'],
            'role' => $result['role']
        ]);
    }
    public function create(ScheduleServiceInterface $scheduleServiceInterface): View
    {
        $result = $this->appointmentServices->createSchedule($scheduleServiceInterface);
        return view('appointments.create', [
            'specialties' => $result['specialties'],
            'doctors' => $result['doctors'], 
            'intervals' => $result['intervals']
        ]);
    }

    public function store(StoreAppointmentRequest $request, ScheduleServiceInterface $scheduleServiceInterface)
    {
        $validator = $request->validated();

        $date = $request->input('scheduled_date');
        $doctorId = $request->input('doctor_id');
        $scheduled_time = $request->input('scheduled_time');

        if ($date && $doctorId && $scheduled_time) {
            $start = new Carbon($scheduled_time);

            if (!$scheduleServiceInterface->isAvailableInterval($date, $doctorId, $start)) {
                $validator->errors()->add(
                    'availableTime',
                    'La hora seleccionada ya se encuentra reservada por otro paciente.'
                );

                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $this->appointmentServices->saveAppointment($request);

        $notification = 'La cita se ha realizado correctamente.';

        return redirect()->route('appointments.index')->with(compact('notification'));
    }

    public function cancel(Appointment $appointment, Request $request)
    {
        $this->appointmentServices->cancelledAppointment($appointment, $request);

        $notification = 'La cita se ha cancelado correctamente.';

        return redirect()->route('appointments.index')->with(compact('notification'));
    }

    public function confirm(Appointment $appointment)
    {
        $this->appointmentServices->confirmAppointment($appointment);

        $notification = 'La cita se ha confirmado correctamente.';

        return redirect()->route('appointments.index')->with(compact('notification'));
    }

    public function show(Appointment $appointment)
    {
        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment', 'role'));
    }
}
