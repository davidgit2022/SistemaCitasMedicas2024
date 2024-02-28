@extends('layouts.theme.app')

@section('title', 'Editar doctor')

@section('content')
    <div class="card shadow">
        @include('admin.doctors.partials.header')
        <div class="card-body">
            @include('admin.doctors.partials.error-form')
            
            <form action="{{ route('doctors.update', $doctor)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.doctors.include.form')
            </form>
        </div>
    </div>
@endsection
