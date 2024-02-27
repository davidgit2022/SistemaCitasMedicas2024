@extends('layouts.theme.app')

@section('title', 'Editar nueva especialidad')

@section('content')
    <div class="card shadow">
        @include('admin.specialties.partials.header')
        <div class="card-body">
            @include('admin.specialties.partials.error-form')
            
            <form action="{{ route('specialties.update', $specialty)}}" method="post">
                @method('PUT')
                @include('admin.specialties.include.form')
            </form>
        </div>
    </div>
@endsection
