@extends('layouts.theme.app')

@section('title', 'Reporte: Desempeño médico')

@section('content')

    @component('components.appointment-component')
        @slot('nameTitle', 'Reporte: Desempeño médico')


        @slot('cardBody')
            <div class="input-daterange datepicker row align-items-center" data-date-format="yyyy-mm-dd">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control" placeholder="Fecha de inicio" id="startDate" type="text"
                                value="{{ $start }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                            </div>
                            <input class="form-control" placeholder="Fecha fin" id="endDate" type="text"
                                value="{{ $end }}">
                        </div>
                    </div>
                </div>
            </div>
            <div id="container">

            </div>
        @endslot
    @endcomponent

    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="{{ asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

        <script src="{{ asset('js/charts/doctors.js') }}"></script>
    @endpush
@endsection
