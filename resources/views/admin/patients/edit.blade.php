@extends('layouts.theme.app')

@section('title', 'Editar nuevo paciente')

@section('content')
    <div class="card shadow">
        @include('admin.patients.partials.header')
        <div class="card-body">
            @include('admin.patients.partials.error-form')
            
            <form action="{{ route('patients.update', $patient)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.patients.include.form')
            </form>
        </div>
    </div>
@endsection
