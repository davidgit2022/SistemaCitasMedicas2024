<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr>
                <th scope="col">Especialidad</th>
                <th scope="col">Fecha</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($oldAppointments as $appointment)
                <tr>
                    <td>
                        {{ $appointment->specialty->name}}
                    </td>
                    <td>
                        {{ $appointment->scheduled_date}}
                    </td>
                    <td>
                        <a href="{{ route('appointments.show', ['appointment' => $appointment->id] ) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="card-body">
        {{ $oldAppointments->links('pagination::bootstrap-4') }}
    </div>
</div>
