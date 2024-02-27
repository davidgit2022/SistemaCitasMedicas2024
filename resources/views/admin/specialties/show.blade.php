@extends('layouts.theme.app')

@section('title', 'Detalles especialidad')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Detalles Especialidad</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('specialties.index') }}" class="btn btn-sm btn-success">Regresar</a>
                    <i class="fas fa-chevron-left"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form>
                @csrf
                <div class="form-group">
                    <label for="name">Nombre de la especialidad:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $specialty->FormatName }}" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripción:</label>
                    <textarea class="form-control" disabled  id="exampleFormControlTextarea1" rows="3">{{ $specialty->description }}</textarea>
                  </div>
            </form>
        </div>
    </div>
@endsection
