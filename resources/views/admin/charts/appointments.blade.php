@extends('layouts.theme.app')

@section('title', 'Reporte: Frecuencia de citas')

@section('content')

    @component('components.appointment-component')
        @slot('nameTitle', 'Reporte: Frecuencia de citas')


        @slot('cardBody')
            <div id="container2">

            </div>
        @endslot
    @endcomponent

    @push('scripts')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
            Highcharts.chart('container2', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Citas registradas mensualmente'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Cantidad de citas'
                    }
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'Citas registradas',
                    data: @json($counts)
                }]
            });
        </script>
    @endpush
@endsection
