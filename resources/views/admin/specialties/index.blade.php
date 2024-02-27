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
                            {{ $specialty->FormatName }}
                        </td>
                        <td>
                            @component('components.buttons-actions')
                                @slot('btnShow')
                                    <a href="{{ route('specialties.show', $specialty) }}" class="btn btn-success btn-sm" title="ver"><i class="fas fa-eye"></i></a>
                                @endslot

                                @slot('routeEdit')
                                    {{ route('specialties.edit', $specialty) }}
                                @endslot

                                @slot('routeDestroy')
                                    {{ route('specialties.destroy', $specialty) }}
                                @endslot

                                @slot('funConfirm')
                                    <button type="submit"class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                @endslot
                            @endcomponent
                        </td>
                    </tr>
                @empty
                    @include('admin.specialties.include.not-result')
                @endforelse
            </tbody>
        @endslot
        @slot('pagination')
            {{ $specialties->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }}
        @endslot
    @endcomponent
    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        @include('admin.partials.sweetAlert2')

    @endpush
@endsection
