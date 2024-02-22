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
            'scheduled_time.required' => 'Debe seleccionar una hora para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta.',
            'description.required' => 'Debe poner sus síntomas.',
            'doctor_id.exists' => 'exists:users,id',
            'specialty_id.exists' => 'exists:specialties,id',
        ];
    }

}
