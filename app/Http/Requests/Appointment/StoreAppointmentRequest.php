<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Interfaces\ScheduleServiceInterface;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'scheduled_date' => 'required',
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialties,id',
        ];
    }

    public function attributes()
    {
        return [
            'scheduled_date' => 'fecha',
            'scheduled_time' => 'hora de atención',
            'type' => 'tipo.',
            'description' => 'descripción',
            'doctor_id' => 'médico',
            'specialty_id' => 'especialidad',
        ];
    }

}
