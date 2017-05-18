<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include 'controllers/BaseUrl.php';

	if($_SESSION["login"]["Rol_Id"] == 1){
?>
<style type="text/css">
	#atras{
		list-style: none;
	}
	#export{
		float: center;
	}
</style>
<div class="row text-center">
			<div class="col-lg-12">
			<div id="paneldiv"></div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>REPORTE ARTICULOS CON BAJO STOCK</h4>						
					</div>
					<div class="panel-body">	

		<div class="col-md-1">
            <li id="atras"><a href="/reportes.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
        </div>
        <div id="export" class="hidden">
        	<a target="_blank" href="javascript:reporte();" id="#reporte" class="btn btn-primary">Exportar a PDF</a>
        </div>
        
						<div class="container">
							<table id="stock" class="table table-striped">
				              <thead>
				                <tr>
					                  <th style="text-align: center;">Código</th>
					                  <th style="text-align: center;">Producto</th>
					                  <th style="text-align: center;">Proveedor</th>
					                  <th style="text-align: center;">Stock Mínimo</th>
					                  <th style="text-align: center;">Stock Máximo</th>
					                  <th style="text-align: center;">Stock Actual</th>
				                </tr>
				              </thead>
			                
			              </table>
					</div>
					</div>
				</div>
			</div>
</div>


<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
	$(document).on("ready",function(){
		listar();
		exportar();
	});

	var exportar = function(){
		if ($(".sorting_1")) {
		$("#export").removeClass("hidden");
		$("#export").addClass("show");
			
		}
	}


	function reporte (){
			window.open('/reportePDF.php?report=1');
	}
	 

	var listar = function(){
		var table = $("#stock").DataTable({
			"processing": true,
          	"serverSide": true,
          	"destroy":true,
          	"ajax":{
            'url': './controllers/getReporteStock.php',
            'type': 'GET'
          },
          "columnDefs": [ {
					    "targets": 5,//index of column starting from 0
					    "data": "Stock", //this name should exist in your JSON response
					    "render": function ( data, type, full, meta ) {
					      return '<span class="label label-danger">'+data+'</span>';
					    }
					  } ],
          "columns":[
          	  {'data': 'Id'},
              {'data': 'Articulo'},
              {'data': 'Nombre_Empresa'},
              {'data': 'StockMin'},
              {'data': 'StockMax'},
              {'data': 'Stock'}
          ],
          "language": idioma_spanish	
		});

		
		
	}

	var idioma_spanish = {
	    "sProcessing":     "Procesando...",
	    "sLengthMenu":     "Mostrar _MENU_ registros",
	    "sZeroRecords":    "No se encontraron resultados",
	    "sEmptyTable":     "Ningún dato disponible en esta tabla",
	    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	    "sInfoPostFix":    "",
	    "sSearch":         "Buscar:",
	    "sUrl":            "",
	    "sInfoThousands":  ",",
	    "sLoadingRecords": "Cargando...",
	    "oPaginate": {
	        "sFirst":    "Primero",
	        "sLast":     "Último",
	        "sNext":     "Siguiente",
	        "sPrevious": "Anterior"
	    },
	    "oAria": {
	        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	    }
	}

	

	

</script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>
