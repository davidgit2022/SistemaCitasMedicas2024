@extends('layouts.theme.app')

@section('title', 'Crear nueva especialidad')

@section('content')
    <div class="card shadow">
        @include('admin.specialties.partials.header')
        <div class="card-body">
            @include('admin.specialties.partials.error-form')
            
            <form action="{{ route('specialties.store') }}" method="POST">
                @include('admin.specialties.include.form')
            </form>
        </div>
    </div>
@endsection
