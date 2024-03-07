@extends('layouts.theme.app')

@if ($appointment->status  ==  'confirmed')
    @section('title','Detalles de la cita confirmada')
@endif

@if($appointment->status  ==  'reserved')
    @section('title','Detalles de la cita reservada')
@endif

@if ($appointment->status  ==  'completed' || $appointment->status  ==  'cancelled')
    @section('title','Detalles de la cita finalizada')

@endif

@section('content')
    @component('components.appointment-component')
        @slot('nameTitle')
        Citas #{{ $appointment->id }}
        @endslot

        @slot('cardBody')
        <ul>
            <dd>
                <strong>Fecha:</strong>&nbsp; {{ $appointment->scheduled_date }}
            </dd>
            <dd>
                <strong>Hora de atención:</strong>&nbsp; {{ $appointment->FormatScheduledTime }}
            </dd>
            @if ($role == 'patient' || $role == 'admin')
                <dd>
                    <strong>Doctor:</strong>&nbsp; {{ $appointment->doctor->FormatName }}
                </dd>
            @endif
            @if ($role == 'doctor' || $role == 'admin')
                <dd>
                    <strong>Paciente:</strong>&nbsp; {{ $appointment->patient->FormatName }}
                </dd>
            @endif

            <dd>
                <strong>Especialidad:</strong>&nbsp; {{ $appointment->specialty->FormatName }}
            </dd>
            <dd>
                <strong>Tipo de consulta:</strong>&nbsp; {{ $appointment->FormatType }}
            </dd>
            <dd>
                <strong>Estado:</strong>&nbsp; {{ $appointment->FormatStatus }}
            </dd>
            <dd>
                <strong>Síntomas:</strong>&nbsp; {{ $appointment->FormatDescription }}
            </dd>
        </ul>

        @if ($appointment->status == 'cancelled')
            <div class="alert bg-light text-primary">
                <h3>Detalles de la cancelación</h3>
                @if ($appointment->cancellation)
                    <ul>
                        <li>
                            <strong>Fecha de cancelación:</strong>&nbsp;{{ $appointment->cancellation->created_at }}
                        </li>
                        <li>
                            <strong>La cita fue
                                cancelada:</strong>&nbsp;{{ $appointment->cancellation->cancelled_by->name }}
                        </li>
                        <li>
                            <strong>Motivo de la
                                cancelación:</strong>&nbsp;{{ $appointment->cancellation->justification }}
                        </li>
                    </ul>
                @else
                    <ul>
                        <li>La cita fue cancelada antes de su confirmación.</li>
                    </ul>
                @endif
            </div>
        @endif
        @endslot
    @endcomponent
@endsection
