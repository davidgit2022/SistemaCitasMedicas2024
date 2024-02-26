@extends('layouts.theme.app')

@section('title', 'Detalles del doctor')

@section('content')
    @component('components.table-index')
        @slot('nameModule', 'Detalles doctor')

        @slot('routeCreate')
        {{ route('doctors.index')}}
        @endslot

        @slot('nameBtnNew', 'Regresar')

        @slot('routeIndex')
            

        @slot('placeholder')

        @slot('data')t

        @slot('table')
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Especialidades</th>
                    <th scope="col">Correo electrónico</th>
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
                            {{ $specialty->FormatName}}
                            @if (!$loop->last)
                                    {{ ', '}}
                                @endif
                        @endforeach
                    </td>
                    <td>
                        {{ $doctor->email }}
                    </td>
                    <td>
                        {{ $doctor->mobile }}
                    </td>
                    <td>
                        <button type="button" class="no-border" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <div class="img-button">
                                    @if ($doctor->photo == null)
                                        <img src="{{ asset('img/perfil_default.png') }}" alt="" class="img-fluid">
                                    @else
                                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt=""
                                            class="img-fluid">
                                    @endif
                                </div>
                            </button>
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
            </tbody>
        @endslot
        @slot('pagination')
    @endcomponent
@endsection
