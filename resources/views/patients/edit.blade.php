@extends('layouts.theme.app')

@section('title', 'Editar nuevo paciente')

@section('content')
    <div class="card shadow">
        @include('patients.partials.header')
        <div class="card-body">
            @include('patients.partials.error-form')
            
            <form action="{{ route('patients.update', $patient)}}" method="post">
                @method('PUT')
                @include('patients.include.form')
            </form>
        </div>
    </div>
@endsection
