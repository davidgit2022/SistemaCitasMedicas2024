@extends('layouts.theme.app')

@section('title', 'Crear nuevo doctor')

@section('content')
    <div class="card shadow">
        @include('doctors.partials.header')
        <div class="card-body">
            @include('doctors.partials.error-form')
            
            <form action="{{ route('doctors.store') }}" method="POST">
                @include('doctors.include.form')
            </form>
        </div>
    </div>
@endsection
