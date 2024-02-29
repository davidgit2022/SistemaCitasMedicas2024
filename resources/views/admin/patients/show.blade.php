@extends('layouts.theme.app')

@section('title', 'Detalles del paciente')

@section('content')
    @component('components.table-detail-user')
        @slot('nameModule', 'Detalles paciente')

        @slot('routeIndex')
            {{ route('patients.index') }}
        @endslot

        @slot('btnBack', 'Regresar')

        @slot('table')
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Foto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $patient->id }}
                    </td>
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
                        {{ $patient->dni }}
                    </td>
                    <td>
                        {{ $patient->address }}
                    </td>
                    <td>
                        {{ $patient->mobile }}
                    </td>
                    <td>
                        <button type="button" class="no-border" data-bs-toggle="modal" data-toggle="modal" data-target="#exampleModal">
                            <div class="img-button">
                                @if ($patient->photo == null)
                                    <img src="{{ asset('img/perfil_default.png') }}" alt="" class="img-fluid">
                                @else
                                    <img src="{{ asset($patient->photo) }}" alt="" class="img-fluid">
                                @endif
                            </div>
                        </button>
                    </td>
                    <!-- Modal -->
                    @include('admin.patients.modal')
                </tr>
            </tbody>
        @endslot
    @endcomponent
@endsection
