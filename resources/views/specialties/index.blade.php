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
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('specialties.edit', $specialty->id)}}" class="btn btn-primary btn-sm" title="Editar" ><i
                                        class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" title="Eliminar"><i
                                        class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Especialidad no encontrada</td>
                    </tr>
                @endforelse
            </tbody>
        @endslot
        @slot('pagination')
            {{ $specialties->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }}
        @endslot
    @endcomponent
@endsection
