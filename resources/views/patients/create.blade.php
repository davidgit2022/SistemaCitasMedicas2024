@extends('layouts.theme.app')

@section('title', 'Crear nuevo paciente')

@section('content')
    <div class="card shadow">
        @include('patients.partials.header')
        <div class="card-body">
            @include('patients.partials.error-form')
            
            <form action="{{ route('patients.store') }}" method="POST">
                @include('patients.include.form')
            </form>
        </div>
    </div>
@endsection
