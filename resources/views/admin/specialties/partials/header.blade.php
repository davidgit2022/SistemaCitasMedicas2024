@component('components.header-create')
    @slot('nameComponente')
        {{ $specialty->id > 0 ? 'Editar ' : 'Crear ' }} Especialidad
    @endslot

    @slot('routeIndex')
        {{ route('specialties.index') }}
    @endslot
@endcomponent
