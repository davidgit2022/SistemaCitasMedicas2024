@component('components.header-create')
    @slot('nameComponente')
        {{ $doctor->id > 0 ? 'Editar ' : 'Crear ' }} Doctor
    @endslot

    @slot('routeIndex')
        {{ route('doctors.index') }}
    @endslot
@endcomponent
