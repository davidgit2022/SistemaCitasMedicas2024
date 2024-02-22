<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">{{ $nameTitle }} </h3>
            </div>
            <div class="col text-right">
                <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-success">Regresar</a>
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $cardBody }}
    </div>
</div>