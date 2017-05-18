$(document).on("ready",function(){
    $.ajax({
        type: "json",
        method: "POST",
        url: "./controllers/BI_getListItem.php"
        }).done(function(info){
            var json_info = JSON.parse(info);


            var categoria = new Array(); 
            var cantidad = new Array();
            var cont = 0;
            var fecha = json_info.fecha;

            for(i = 0; i < json_info.data.length; i++){
                categoria[i] = json_info.data[i].Item;
                cantidad[i] = parseInt(json_info.data[i].Total,10);
            }


             Highcharts.chart('container2', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Comportamiento del movimiento de productos'
                    },
                    subtitle: {
                        text: '(Última fecha de venta registrada: '+ fecha +')'
                    },
                    xAxis: {
                        categories : categoria,
                       
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '*En unidades (según unidad de medida)',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' *unidades'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Últimos 12 meses',
                        //data: [44, 25, 25]
                        data : cantidad 
                    }/*, {
                        name: 'Year 1900',
                        data: [133, 156, 947, 408, 6]
                    }, {
                        name: 'Year 2012',
                        data: [1052, 954, 4250, 740, 38]
                    }*/]
                });

               
                
        });

            
  });









