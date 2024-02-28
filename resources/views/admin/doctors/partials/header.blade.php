<div class="card-header border-0">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="mb-0"> {{ $doctor->id > 0 ? 'Editar doctor' : 'Crear doctor'}}</h3>
        </div>
        <div class="col text-right">
            <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-success">Regresar</a>
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
</div>