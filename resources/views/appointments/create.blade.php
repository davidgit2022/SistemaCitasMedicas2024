@extends('layouts.theme.app')

@section('title', 'Registrar nueva cita')

@section('content')
    @component('components.appointment-component')
        @slot('nameTitle', 'Registar nueva cita')

        @slot('cardBody')
            @include('admin.doctors.partials.error-form')
            @include('appointments.partials.form')
        @endslot
    @endcomponent
    @push('scripts')
        <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    @endpush

@endsection
