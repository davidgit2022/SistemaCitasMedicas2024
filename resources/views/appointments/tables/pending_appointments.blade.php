<div class="table-responsive">
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Descripción</th>
                <th scope="col">Especialidad</th>
                @if ($role == 'patient')
                    <th scope="col">Médico</th>
                @elseif ($role == 'doctor')
                    <th scope="col">Paciente</th>
                @endif
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Tipo</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingAppointments as $appointment)
                <tr>
                    <th scope="row">
                        {{ $appointment->FormatDescription}}
                    </th>
                    <td>
                        {{ $appointment->specialty->FormatName}}
                    </td>
                    @if ($role == 'patient')
                        <td>
                            {{ $appointment->doctor->FormatName }}
                        </td>
                    @elseif ($role == 'doctor')
                        <td>
                            {{ $appointment->patient->FormatName }}
                        </td>
                    @endif
                    <td>
                        {{ $appointment->scheduled_date}}
                    </td>
                    <td>
                        {{ $appointment->ScheduledTime12}}
                    </td>
                    <td>
                        {{ $appointment->FormatType}}
                    </td>
                    <td>
                        @if ($role == 'admin')
                            <a href="{{ route('appointments.show',['appointment' => $appointment->id] ) }}" class="btn btn-sm btn-info"
                                title="Ver cita"><i class="ni fas fa-eye"></i></a>
                        @endif
                        @if ($role == 'doctor' || $role == 'admin')
                            <form action="{{ route('appointments.confirm', ['appointment' => $appointment->id] ) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Confirmar cita"><i class="ni ni-check-bold"></i></button>
                            </form>
                        @endif

                        <form action="{{ route('appointments.cancel',['appointment' => $appointment->id] ) }}" method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" title="Cancelar cita"><i class="ni ni-fat-delete"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

