@extends('layouts.theme.app')

@section('title', 'Crear nuevo paciente')

@section('content')
    <div class="card shadow">
        @include('admin.patients.partials.header')
        <div class="card-body">
            @include('admin.patients.partials.error-form')
            
            <form action="{{ route('patients.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.patients.include.form')
            </form>
        </div>
    </div>
@endsection
