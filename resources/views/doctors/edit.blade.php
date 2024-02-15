@extends('layouts.theme.app')

@section('title', 'Editar nueva especialidad')

@section('content')
    <div class="card shadow">
        @include('doctors.partials.header')
        <div class="card-body">
            @include('doctors.partials.error-form')
            
            <form action="{{ route('doctors.update', $doctor)}}" method="post">
                @method('PUT')
                @include('doctors.include.form')
            </form>
        </div>
    </div>
@endsection
