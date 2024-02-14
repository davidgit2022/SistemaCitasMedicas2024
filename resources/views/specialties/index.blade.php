@extends('layouts.theme.app')

@section('title', 'Especialidades')

@section('content')
    @component('components.table-index')
        @slot('nameModule', 'Especialidades')

        @slot('routeCreate')
            {{ route('specialties.create') }}
        @endslot

        @slot('nameBtnNew', 'Nueva especialidad')

        @slot('routeIndex')
            {{ route('specialties.index') }}
        @endslot

        @slot('placeholder', 'Buscar por nombre de especialidad')

        @slot('data')
            {{ $specialties }}
        @endslot

        @slot('table')
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($specialties as $specialty)
                    <tr>
                        <td>
                            {{ $specialty->name }}
                        </td>
                        <td>
                            @component('components.buttons-actions')
                                @slot('routeEdit')
                                    {{ route('specialties.edit', $specialty) }}
                                @endslot

                                @slot('routeDestroy')
                                    {{ route('specialties.destroy', $specialty) }}
                                @endslot
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @include('specialties.include.not-result')
                @endforelse
            </tbody>
        @endslot
        @slot('pagination')
            {{ $specialties->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }}
        @endslot
    @endcomponent
@endsection
