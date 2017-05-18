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
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
          
						<h4 style="text-align: center;">REPORTE DE COMPRAS</h4>
						
					</div>
					<div class="panel-body">
          
          <div class="col-md-1">
                <li id="atras"><a href="/reportes.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
          </div>

					<div class="container">
						<table id="compra" class="table table-striped">
		              <thead>
		                <tr>
		                  <th>Código Compra</th>
		                  <th>Total Compra</th>
		                  <th>Fecha</th>
		                  <th>Usuario</th>
		                  <th>Accion</th>
		                </tr>
		              </thead>
		                
		              </table>
					</div>
					 </div>
          		</div>
        	</div>
</div>

          <!-- Modal -->
          <div class="modal fade" id="myModalDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times-circle"></span></button>
                  <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Detalle Compra</h4>
                </div>
                <div class="modal-body">
                <form action="" method="POST" role="form" id="myModalCompra">
                  <div class="row">

            
                    <div class="col-xs-12 col-md-12">
                        <div class="registros" id="agrega-registros"></div>
                    </div>
            
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
                  <!--button type="submit" class="btn btn-info">Guardar</button-->
                </div>
                </form>
              </div>
            </div>
          </div>


 <?php include 'includes/footer.php'; ?>

<script type="text/javascript">
  $(document).on("ready",function(){
    listar();
  });

  var listar = function(){
    var table = $("#compra").DataTable({
      "processing": true,
            "serverSide": true,
            "destroy":true,
            "order": [[ 0, "desc" ]],
            "ajax":{
            'url': './controllers/getReporteCompra.php',
            'type': 'GET'
          },
          "columns":[
            {'data': 'Id'},
              {'data': 'Total'},
              {'data': 'Fecha'},
              {'data': 'Usuario'},
              {'defaultContent':'<button class="editar btn btn-success">Detalle</button>'}
          ],
          "language": idioma_spanish
    });
    obtener_data_editar("#compra tbody",table);
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
        
        var idcompra = data.Id;
        $.ajax({
          method:"POST",
          url: "./controllers/getReporteDetalleCompra.php",
          data: 'Id='+idcompra
        }).done(function(info){
          $('#agrega-registros').html(info);
          $('#myModalDetalle').modal('show');

        });
      });
    }
</script>
 <?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>
