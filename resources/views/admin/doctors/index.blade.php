@extends('layouts.theme.app')

@section('title', 'Doctors')

@section('content')
    @component('components.table-index')
        @slot('nameModule', 'Doctores')

        @slot('routeCreate')
            {{ route('doctors.create') }}
        @endslot

        @slot('nameBtnNew', 'Nuevo doctor')

        @slot('routeExportPdf',''){{-- 
            {{ route('doctors.export-pdf') }}
        @endslot --}}

        @slot('routeExportExcel')
            {{ route('doctors.export-excel') }}
        @endslot

        @slot('routeIndex')
            {{ route('doctors.index') }}
        @endslot

        @slot('placeholder', 'Buscar doctor')

        @slot('table')
            <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Cedula</th>
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
                            {{ $doctor->dni }}
                        </td>
                        <td>
                            @component('components.buttons-actions')
                                @slot('btnShow')
                                    <a href="{{ route('doctors.show', $doctor) }}" class="btn btn-success btn-sm" title="ver"><i
                                            class="fas fa-eye"></i></a>
                                @endslot

                                @slot('routeEdit')
                                    {{ route('doctors.edit', $doctor) }}
                                @endslot

                                @slot('routeDestroy')
                                    {{ route('doctors.destroy', $doctor) }}
                                @endslot

                                @slot('funConfirm')
                                    <button type="submit"class="btn btn-danger btn-sm btn-delete" title="Eliminar"><i
                                            class="fas fa-trash"></i></button>
                                @endslot
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @include('admin.doctors.include.not-result')
                @endforelse
            </tbody>
        @endslot
        @slot('pagination')
            {{ $doctors->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }}
        @endslot
    @endcomponent
    @push('scripts')
        @include('admin.partials.sweetAlert2')
    @endpush
@endsection
