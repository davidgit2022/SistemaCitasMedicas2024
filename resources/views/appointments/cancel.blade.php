@extends('layouts.theme.app')
@section('title', 'Formulario cancelación')
@section('content')
    @component('components.appointment-component')
        @slot('nameTitle', 'Cancelar')

        @slot('cardBody')
            @include('components.notification')
            @if ($role == 'patient')
                <p>Se cancelará tú cita reservada con él médico <b>{{ $appointment->doctor->FormatName }}</b> (especialidad
                    <b>{{ $appointment->specialty->FormatName }}</b>) para el día <b>{{ $appointment->scheduled_date }}</b>
                </p>
            @elseif ($role == 'doctor')
                <p>Se cancelará la cita médica del paciente <b>{{ $appointment->patient->FormatName }}</b> (especialidad
                    <b>{{ $appointment->specialty->FormatName }}</b>) para el día <b>{{ $appointment->scheduled_date }}</b>, la
                    hora <b>{{ $appointment->scheduled_time }}</b>
                </p>
            @else
                <p>Se cancelará la cita médica del paciente <b>{{ $appointment->patient->FormatName }}:</b> <br><br>
                    Que sera atentida por el Doctor <b>{{ $appointment->doctor->FormatName }}</b>,
                    (especialidad
                    <b>{{ $appointment->specialty->FormatName }}</b>)<br><br>
                    Para el día <b>{{ $appointment->scheduled_date }}</b>, la
                    hora <b>{{ $appointment->scheduled_time < 12 ? $appointment->scheduled_time . ' A.M' : $appointment->scheduled_time . ' P.M' }}
                    </b>
                </p>
            @endif

            <form action="{{ route('appointments.form-cancel', ['appointment' => $appointment->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="justification">Ponga los motivos de la cancelación:</label>
                    <textarea name="justification" id="justification" rows="3" class="form-control" required></textarea>
                </div>
                <button class="btn btn-danger" type="submit">Cancelar cita</button>
            </form>
        @endslot
    @endcomponent
@endsection
