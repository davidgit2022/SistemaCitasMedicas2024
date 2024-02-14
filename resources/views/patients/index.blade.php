@extends('layouts.theme.app')

@section('title', 'Doctors')

@section('content')
    @component('components.table-index')
        @slot('nameModule', 'Doctors')

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
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($doctors as $doctor)
                    <tr>
                        <td>
                            {{ $doctor->name }}
                        </td>
                        <td>
                            @component('components.buttons-actions')
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
            {{-- {{ $doctors->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }} --}}
        @endslot
    @endcomponent
@endsection
