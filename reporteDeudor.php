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
</style>
<div class="row text-center">
			<div class="col-lg-12">
			<div id="paneldiv"></div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>REPORTE DEUDOR</h4>						
					</div>
					<div class="panel-body">	

		<div class="col-md-1">
            <li id="atras"><a href="/reportes.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
        </div>
        
						<div class="container">
							<table id="deudor" class="table table-striped">
				              <thead>
				                <tr>
					                  <th style="text-align: center;">Código</th>
					                  <th style="text-align: center;">Número factura</th>
					                  <th style="text-align: center;">Cliente</th>
					                  <th style="text-align: center;">Monto</th>
					                  <th style="text-align: center;">Saldo</th>
					                  <th style="text-align: center;">Fecha</th>
					                  <th></th>
				                </tr>
				              </thead>
			                
			              </table>
					</div>
					</div>
				</div>
			</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalDeudor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times-circle"></span></button>
        <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Abonar deuda</h4>
      </div>
      <div class="modal-body">
      <form action="" method="POST" role="form" id="myModalForm">
        <div class="row">
        <input type="hidden" name="deuda" id="deuda" value="">
        <input type="hidden" name="factura" id="factura" value="">
        	<div class="col-md-3 col-md-offset-1">
        		<label>Cliente:</label>
        	</div>
        	<div class="col-md-7">
        		<label id="Cliente"></label>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-3 col-md-offset-1">
        		<label>Deuda:</label>
        	</div>
        	<div class="col-md-4">
        		<label id="Saldo"></label>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-3 col-md-offset-1">
        		<label>Monto a Abonar:</label>
        	</div>
        	<div class="col-md-6">
        		<input type="text" name="monto" id="monto" class="form-control" autofocus required>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-info">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
	$(document).on("ready",function(){
		listar();
		form_abonar();
	});

	var listar = function(){
		var table = $("#deudor").DataTable({
			"processing": true,
          	"serverSide": true,
          	"destroy":true,
          	"ajax":{
            'url': './controllers/getReporteDeudor.php',
            'type': 'GET'
          },
          "columns":[
          	  {'data': 'Deuda'},
              {'data': 'Factura'},
              {'data': 'Cliente'},
              {'data': 'Monto'},
              {'data': 'Saldo'},
              {'data': 'Fecha'},
              {'defaultContent':'<button class="editar  btn btn-info">Abonar</button>'}
          ],
          "language": idioma_spanish	
		});
		obtener_data_editar("#deudor tbody",table);
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

	var obtener_data_editar = function(tbody,table){
			$(tbody).on("click","button.editar",function(){
				var data = table.row($(this).parents("tr")).data();
				var idDeudor = data.Factura;
					varCliente = data.Cliente;
					varSaldo = data.Saldo;
					varDeuda = data.Deuda;
				$("#factura").val(idDeudor);
				$("#deuda").val(varDeuda);
				document.getElementById('Cliente').innerHTML = varCliente;
				document.getElementById('Saldo').innerHTML = 'Q. ' + varSaldo;
				$('#myModalDeudor').modal('show');

			});
		}

		var form_abonar = function(){
			$("#myModalForm").on("submit",function(e){
				e.preventDefault();
				var frm = $(this).serialize();
				$("#myModalDeudor").modal('toggle');
				$.ajax({
					method:"POST",
					url: "./controllers/getAbono.php",
					data: frm
				}).done(function(info){
					var json_info = JSON.parse(info);
					msj_show(json_info);
					limpiar_modal();
					listar();
				});
			});
		}

		var msj_show = function(info){
			var texto = "";
			if(info.resp == "EXITO"){
				$().toastmessage('showSuccessToast', 'Se ha realizado el Abono con éxito');
			}else{
				$().toastmessage('showErrorToast',  info.msj);
			}

			/*$().toastmessage('showNoticeToast', 'some message here');
			$().toastmessage('showSuccessToast', "some message here");
			$().toastmessage('showWarningToast', "some message here");
			$().toastmessage('showErrorToast', "some message here");*/

		}

		var limpiar_modal = function(){
			$("#deuda").val(0);
			$("#factura").val(0);
			$("#monto").val("");
			document.getElementById('Cliente').innerHTML = "";
			document.getElementById('Saldo').innerHTML = "";
		}

</script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>
