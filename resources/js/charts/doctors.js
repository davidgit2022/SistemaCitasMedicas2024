const chart = Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Desempeño médico '
    },
    xAxis: {
        categories: [],
        crosshair: true
    },
    yAxis: {
        min: 0,
        useHTML: true,
        title: {
            text: 'Citas atendidas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: []
});

let $start, $end;

function fetchData() {

    const startDate = $start.val();
    const endDate = $end.val();

    const url = `/reports/doctors/column/data?start=${startDate}&end=${endDate}`;

    //Fetch: API

    fetch(url)
        .then(function (response) {
            return response.json();
        })
        .then(function (myJson) {
            chart.xAxis[0].setCategories(myJson.categories);

            if (chart.series.length > 0) {
                chart.series[1].remove();
                chart.series[0].remove();
            }
            chart.addSeries(myJson.series[0]);
            chart.addSeries(myJson.series[1]);
        })
}

$(function () {

    $start = $('#startDate');
    $end = $('#endDate');

    fetchData();
    $start.change(fetchData);
    $end.change(fetchData);
})
