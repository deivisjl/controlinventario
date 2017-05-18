$(document).on("ready",function(){
    $.ajax({
        type: "json",
        method: "POST",
        url: "./controllers/BI_getFormBuy.php"
        }).done(function(info){
            var datos = new Array();
            var mes = [' ','Enero','Febrero','Marzo','Abril','Mayo','Junio',
                        'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            var cont = 0;
            var json_info = JSON.parse(info);            

            for(var x = 0; x < json_info.data.length; x++){
                datos[x] = [];
            }

            for(var i = 0; i < json_info.data.length; i++){
                cont = 0;
                for (var j = 0; j < 2; j++) {
                   if (cont == 0) {
                    datos[i][j] = mes[parseInt(json_info.data[i].Fecha)];
                    cont++;
                   }else{
                    datos[i][j] = parseFloat(json_info.data[i].Total);
                   }

                }
            } 
           

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Historial de compras según mes'
                },
                subtitle: {
                    text: ''
                },
                fuente:{                    
                    text: '#666666'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: 0,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '(En Quetzales)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Q. <b>{point.y:.2f} </b>'
                    },
                    series: [{
                        name: 'Population',
                        data:datos,
                        
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: 'Q. {point.y:.2f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
        });
});


