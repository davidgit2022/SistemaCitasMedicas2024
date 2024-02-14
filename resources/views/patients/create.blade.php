@extends('layouts.theme.app')

@section('title', 'Crear nueva especialidad')

@section('content')
    <div class="card shadow">
        @include('specialties.partials.header')
        <div class="card-body">
            @include('specialties.partials.error-form')
            
            <form action="{{ route('specialties.store') }}" method="POST">
                @include('specialties.include.form')
            </form>
        </div>
    </div>
@endsection
