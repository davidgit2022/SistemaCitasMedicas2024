@extends('layouts.theme.app')

@section('title', 'Crear nuevo doctor')

@section('content')
    <div class="card shadow">
        @include('admin.doctors.partials.header')
        <div class="card-body">
            @include('admin.doctors.partials.error-form')
            
            <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.doctors.include.form')
            </form>
        </div>
    </div>
@endsection
