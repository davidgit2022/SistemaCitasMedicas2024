@extends('layouts.theme.app')

@section('title', 'Pacientes')

@section('content')
    @component('components.table-index')
        @slot('nameModule', 'patients')

        @slot('routeCreate')
            {{ route('patients.create') }}
        @endslot

        @slot('nameBtnNew', 'Nuevo paciente')

        @slot('routeIndex')
            {{ route('patients.index') }}
        @endslot

        @slot('placeholder', 'Buscar por nombre de paciente')

        @slot('data')
            {{ $patients }}
        @endslot

        @slot('table')
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td>
                            {{ $patient->name }}
                        </td>
                        <td>
                            {{ $patient->last_name }}
                        </td>
                        <td>
                            {{ $patient->email }}
                        </td>
                        <td>
                            {{ $patient->dni }}
                        </td>
                        <td>
                            {{ $patient->address }}
                        </td>
                        <td>
                            {{ $patient->mobile }}
                        </td>
                        <td>
                            @component('components.buttons-actions')
                                @slot('routeEdit')
                                    {{ route('patients.edit', $patient) }}
                                @endslot

                                @slot('routeDestroy')
                                    {{ route('patients.destroy', $patient) }}
                                @endslot
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @include('patients.include.not-result')
                @endforelse
            </tbody>
        @endslot
        @slot('pagination')
            {{-- {{ $patients->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }} --}}
        @endslot
    @endcomponent
@endsection
