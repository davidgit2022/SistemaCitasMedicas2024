<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Specialty;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\CancelledAppointment;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\Appointment\StoreAppointmentRequest;

class AppointmentServices{
    private $pagination = 20;
    public function getListAppointments()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
    
        $pagination = 20;
        
        if ($role == 'admin') {
            //Admin
            $confirmedAppointments = Appointment::confirmedAdmin()->latest()->paginate($pagination, ['*'], 'confirmed_page');
    
            $pendingAppointments = Appointment::reservedAdmin()->latest()->paginate($pagination, ['*'], 'pending_page');
    
            $oldAppointments = Appointment::completedAdmin()->latest()->paginate($pagination, ['*'], 'old_page');
            
        } elseif ($role == 'doctor') {
            //Doctor
            $confirmedAppointments = Appointment::confirmedDoctor()->latest()->paginate($pagination, ['*'], 'confirmed_page');
                
            $pendingAppointments = Appointment::reservedDoctor()->latest()->paginate($pagination, ['*'], 'pending_page');
                
            $oldAppointments = Appointment::completedDoctor()->latest()->paginate($pagination, ['*'], 'old_page');
                
        } elseif ($role == 'patient') {
            //Patients
            $confirmedAppointments = Appointment::confirmedPatient()->latest()->paginate($pagination, ['*'], 'confirmed_page');
                
            $pendingAppointments = Appointment::reservedPatient()->latest()->paginate($pagination, ['*'], 'pending_page');
    
            $oldAppointments = Appointment::completedPatient()->latest()->paginate($pagination, ['*'], 'old_page');
        }
    
        return [
            'confirmedAppointments' => $confirmedAppointments, 
            'pendingAppointments' => $pendingAppointments, 
            'oldAppointments' => $oldAppointments, 
            'role' => $role
        ];
    }
    
    public function createSchedule(ScheduleServiceInterface $scheduleServiceInterface){
        $specialties = Specialty::all();
        $specialtyId = old('specialty_id');

        if ($specialtyId) {
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }

        $date = old('scheduled_date');
        $doctorId = old('doctor_id');

        if ($date && $doctorId) {
            $intervals = $scheduleServiceInterface->getAvailableIntervals($date, $doctorId);
        } else {
            $intervals = null;
        }

        return [
            'specialties' => $specialties,
            'doctors' => $doctors, 
            'intervals' => $intervals
        ];

    }

    public function saveAppointment(StoreAppointmentRequest $request){
        $data = $request->only([
            'scheduled_date',
            'scheduled_time',
            'type',
            'description',
            'doctor_id',
            'specialty_id'
        ]);

        $data['patient_id'] = auth()->id();

        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        $appointment = Appointment::create($data);

        return $appointment;
    }

    public function cancelledAppointment(Appointment $appointment, Request $request){
        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();

            $appointment->cancellation()->save($cancellation);
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return $appointment;
    }

    public function confirmAppointment(Appointment $appointment)
    {
        $appointment->status = 'confirmed';
        $appointment->save();

        return $appointment;
    }

    public function detailsAppointment()
    {
        $user = Auth::user();
        $role = $user['name'];

        return $role;
    }
}