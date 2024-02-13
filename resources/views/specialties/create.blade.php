@extends('layouts.theme.app')

@section('title', 'Crear nueva especialidad')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nueva Especialidad</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('specialties.index') }}" class="btn btn-sm btn-success">Regresar</a>
                    <i class="fas fa-chevron-left"></i>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('specialties.partials.include.error-form')
            
            <form action="{{ route('specialties.store') }}" method="POST">
                @include('specialties.partials.form')
            </form>
        </div>
    </div>
@endsection
