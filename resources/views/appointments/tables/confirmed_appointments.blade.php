<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Especialidad</th>
                @if ($role == 'paciente')
                    <th scope="col">Médico</th>
                @elseif ($role == 'doctor')
                    <th scope="col">Paciente</th>
                @endif
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($confirmedAppointments as $appointment)
                <tr>
                    <td>
                        {{ $appointment->specialty->FormatName }}
                    </td>
                    @if ($role == 'paciente')
                        <td>
                            {{ $appointment->doctor->name }}
                        </td>
                    @elseif ($role == 'doctor')
                        <td>
                            {{ $appointment->patient->name }}
                        </td>
                    @endif

                    <td>
                        {{ $appointment->scheduled_date }}
                    </td>
                    <td>
                        {{ $appointment->ScheduledTime12 }}
                    </td>
                    <td>
                        {{ $appointment->FormatType }}
                    </td>
                    <td>
                        {!! $appointment->FormatStatus !!}
                    </td>
                    <td>
                        @if ($role == 'admin')
                            <a href="{{ route('appointments.show', ['appointment' => $appointment->id]) }}"
                                class="btn btn-sm btn-info" title="Ver cita">Ver</a>
                        @endif
                        <a href="{{ route('appointments.form-cancel', ['appointment' => $appointment->id]) }}"
                            class="btn btn-sm btn-danger" title="Cancelar cita">Cancelar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-body">
        {{ $confirmedAppointments->links('pagination::bootstrap-4') }}
    </div>
</div>
