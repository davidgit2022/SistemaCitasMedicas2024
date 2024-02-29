@extends('layouts.theme.app')

@section('title', 'Detalles del doctor')

@section('content')
    @component('components.table-detail-user')
        @slot('nameModule', 'Detalles doctor')

        @slot('routeIndex')
            {{ route('doctors.index') }}
        @endslot

        @slot('btnBack', 'Regresar')

        @slot('table')
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Especialidades</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Cedula</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Foto</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{ $doctor->id }}
                    </td>
                    <td>
                        {{ $doctor->FormatName }}
                    </td>
                    <td>
                        {{ $doctor->FormatLastName }}
                    </td>
                    <td>
                        @foreach ($specialties as $specialty)
                            {{ $specialty->FormatName }}
                            @if (!$loop->last)
                                {{ ', ' }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        {{ $doctor->email }}
                    </td>
                    <td>
                        {{ $doctor->dni }}
                    </td>
                    <td>
                        {{ $doctor->address }}
                    </td>
                    <td>
                        {{ $doctor->mobile }}
                    </td>
                    <td>
                        <button type="button" class="no-border" data-bs-toggle="modal" data-toggle="modal"
                            data-target="#exampleModal">
                            <div class="img-button">
                                @if ($doctor->photo == null)
                                    <img src="{{ asset('img/perfil_default.png') }}" alt="not-available" class="img-fluid">
                                @else
                                    <img src="{{ asset($doctor->photo) }}" alt="" class="img-fluid">
                                @endif
                            </div>
                        </button>
                    </td>
                </tr>
            </tbody>
            <!-- Modal -->
            @include('admin.doctors.modal')
        @endslot

    @endcomponent

@endsection
