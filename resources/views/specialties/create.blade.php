@extends('layouts.theme.app')

@section('title', 'Crear nueva especialidad')

@section('content')
    <div class="card shadow">
        @include('specialties.partials.include.header')
        <div class="card-body">
            @include('specialties.partials.include.error-form')
            
            <form action="{{ route('specialties.store') }}" method="POST">
                @include('specialties.partials.form')
            </form>
        </div>
    </div>
@endsection
