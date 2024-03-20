@extends('layouts.theme.app')

@section('title', 'Pacientes')

@section('content')
    @component('components.table-index')
        @slot('nameModule', 'Pacientes')

        @slot('routeCreate')
            {{ route('patients.create') }}
        @endslot

        @slot('routeExportExcel')
            {{ route('patients.export-excel') }}
        @endslot

        @slot('nameBtnNew', 'Nuevo paciente')

        @slot('routeIndex')
            {{ route('patients.index') }}
        @endslot

        @slot('placeholder', 'Buscar paciente')


        @slot('table')
            @if (!empty($patients))
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

                    @forelse ($patients as $patient)
                        <tr>
                            <td>
                                {{ $patient->FormatName }}
                            </td>
                            <td>
                                {{ $patient->FormatLastName }}
                            </td>
                            <td>
                                {{ $patient->email }}
                            </td>
                            <td>
                                {{ $patient->mobile }}
                            </td>
                            <td>
                                @component('components.buttons-actions')
                                    @slot('btnShow')
                                        <a href="{{ route('patients.show', $patient) }}" class="btn btn-success btn-sm" title="ver"><i
                                                class="fas fa-eye"></i></a>
                                    @endslot

                                    @slot('routeEdit')
                                        {{ route('patients.edit', $patient) }}
                                    @endslot

                                    @slot('routeDestroy')
                                        {{ route('patients.destroy', $patient) }}
                                    @endslot

                                    @slot('funConfirm')
                                        <button type="submit"class="btn btn-danger btn-sm btn-delete" title="Eliminar"><i
                                                class="fas fa-trash"></i></button>
                                    @endslot
                                @endcomponent
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No se encontraron registros</td>
                        </tr>
                    @endforelse
                </tbody>
            @else
                @include('admin.patients.include.not-result')
            @endif

        @endslot
        @slot('pagination')
            {{ $patients->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }}
        @endslot
    @endcomponent
    @push('scripts')
        @include('admin.partials.sweetAlert2')
    @endpush
@endsection
