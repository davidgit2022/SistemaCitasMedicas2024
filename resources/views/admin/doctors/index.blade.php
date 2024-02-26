@extends('layouts.theme.app')

@section('title', 'Doctors')

@section('content')
    @component('components.table-index')
        @slot('nameModule', 'Doctores')

        @slot('routeCreate')
            {{ route('doctors.create') }}
        @endslot

        @slot('nameBtnNew', 'Nuevo doctor')

        @slot('routeIndex')
            {{ route('doctors.index') }}
        @endslot

        @slot('placeholder', 'Buscar por nombre de doctor')

        @slot('data')
            {{ $doctors }}
        @endslot

        @slot('table')
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($doctors as $doctor)
                    <tr>
                        <td>
                            {{ $doctor->FormatName }}
                        </td>
                        <td>
                            {{ $doctor->FormatLastName }}
                        </td>
                        <td>
                            {{ $doctor->email }}
                        </td>
                        <td>
                            {{ $doctor->mobile }}
                        </td>
                        <td>
                            @component('components.buttons-actions')
                            
                                @slot('routeShow')
                                    {{route('doctors.show', $doctor->id)}}
                                @endslot
                                
                                @slot('routeEdit')
                                    {{ route('doctors.edit', $doctor) }}
                                @endslot

                                @slot('routeDestroy')
                                    {{ route('doctors.destroy', $doctor) }}
                                @endslot
                                
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @include('doctors.include.not-result')
                @endforelse
            </tbody>
        @endslot
        @slot('pagination')
            {{ $doctors->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }}
        @endslot
    @endcomponent
@endsection
