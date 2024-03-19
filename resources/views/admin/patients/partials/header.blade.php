@component('components.header-create')
    @slot('nameComponente')
        {{ $patient->id > 0 ? 'Editar ' : 'Crear ' }} Paciente
    @endslot

    @slot('routeIndex')
        {{ route('patients.index') }}
    @endslot
@endcomponent