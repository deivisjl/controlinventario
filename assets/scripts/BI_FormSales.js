$(document).on("ready",function(){
    $.ajax({
        type: "json",
        method: "POST",
        url: "./controllers/BI_getFormSales.php"
        }).done(function(info){

            var json_info = JSON.parse(info);

            var name1 = json_info.data[0].Forma;
            var y1 = parseInt(json_info.data[0].Pago);

            var name2 = json_info.data[1].Forma;
            var y2 = parseInt(json_info.data[1].Pago);

            Highcharts.chart('container4', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Modo de pago por parte de clientes'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: ' ',
                    colorByPoint: true,
                    data: [{
                            name: name1,
                            y: y1
                            /*name: 'Contado',
                            y: 56.33*/
                        }, {
                            name: name2,
                            y: y2,
                            /*name: 'Credito',
                            y: 24.03,*/
                            sliced: true,
                            selected: true
                        }
                    ]
                }]
            });
        });
});

