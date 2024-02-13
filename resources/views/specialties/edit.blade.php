@extends('layouts.theme.app')

@section('title', 'Editar nueva especialidad')

@section('content')
    <div class="card shadow">
        @include('specialties.partials.include.header')
        <div class="card-body">
            @include('specialties.partials.include.error-form')
            
            <form action="{{ route('specialties.update', $specialty)}}" method="post">
                @method('PUT')
                @include('specialties.partials.form')
            </form>
        </div>
    </div>
@endsection
