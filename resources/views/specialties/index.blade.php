@extends('layouts.theme.app')

@section('title', 'Especialidades')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Especialidades</h3>
                        </div>
                        <div class="col text-right">
                            <a href="" class="btn btn-sm btn btn-default">Nueva especialidad</a>
                        </div>
                    </div>
                    <div class="form-group mt-3 row">
                        <div class="col-md-6 ml-auto">
                            <form action="{{route('specialties.index')}}" method="get">
                                <div class="input-group">
                                    <input class="form-control" type="search" placeholder="Buscar por nombre de especialidad" name="filterValue">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                @if (!empty($specialties))
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
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
                                                <button type="button" class="btn btn-primary btn-sm" title="Editar"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" title="Eliminar"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Especialidad no encontrada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        {{ $specialties->appends(['filterValue' => $filterValue])->links('pagination::bootstrap-4') }}
                    </div>
                @else
                    <div class="py-5 text-center">
                        <img src="{{ asset('img/not-result.jpg') }}" alt="No hay registros"
                            style="width:250px;">
                        <p class="text-muted">No hay registros en la base de datos</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
