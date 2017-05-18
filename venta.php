<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
  	include 'controllers/BaseUrl.php';
  	
if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2 || $_SESSION["login"]["Rol_Id"] == 3){

?>

<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 style="text-align: center;">REGISTRO DE VENTAS</h4>
						
					</div>
					<div class="panel-body">
						
<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb">
			  <li><a href="/index.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
			</ol>
		</div>
</div>

	<?php if(isset($_SESSION["insertVenta"]) && $_SESSION["insertVenta"] == 1){?>
		<div class="alert alert-success" role="alert">
		 Registro guardado correctamente.</a>
		</div>  
	<?php } unset($_SESSION["insertVenta"]); ?>

	<div id="load"></div>
							

						<div class="row"><!--Start row table-->
							<div class="col-xs-12 col-md-9">
								<div class="thumbnail">
									<form id="frm-venta" method="post" action="./controllers/getVenta.php">
									    <div class="row">
									        <div class="col-xs-12">
									            <div class="well well-sm">
									                <div class="row">
									                    <div class="col-xs-12 col-md-5">
									                        <input id="producto_id" type="hidden" value="0" />
									                        <input autocomplete="off" id="producto" class="form-control" type="text" placeholder="Nombre del producto" />
									                    </div>
									                    <div class="col-xs-12 col-md-2">
									                        <input autocomplete="off" id="cantidad" class="form-control" type="text" placeholder="Cantidad" />
									                    </div>
									                    <div class="col-xs-12 col-md-3">
									                        <div class="input-group">
									                          <span class="input-group-addon" id="basic-addon1">Q.</span>
									                          <input autocomplete="off" id="precio" class="form-control" type="text" placeholder="Precio Sugerido"  readonly />
									                        </div>
									                    </div>
									                    <div class="col-xs-12 col-md-2">
									                        <button class="btn btn-success form-control" id="btn-item" type="button" data-toggle="tooltip" data-placement="top" title="Agregar al detalle">
									                             <i class="fa fa-plus-circle fa-1x text-center" aria-hidden="true"></i>
									                        </button>
									                    </div>
									                </div>            
									            </div>

									            <hr />
								
									            <ul id="facturador-detalle" class="list-group"></ul>
									            
									            

									        </div>
									</div>    
								</div>	<!--del thumbnail-->	
							</div>
							<div class="col-xs-12 col-md-3">
							

									<div class="thumbnail">
										<div class="jumbotron" style="padding-top: 10px !important; margin-bottom: 0px;">
										    <div class="row text-center">
										    	<div class="col-md-12">
										    		<span><em>Seleccionar un cliente</em></span>
										    	</div>
										    	<div class="col-md-12">
										    		<input id="cliente_id" type="hidden" value="0" />
										    		<input autocomplete="off" id="clientes" class="form-control" type="text" placeholder="Seleccione un Cliente..." />	
										    	</div>
										    	<div class="col-md-12">
										    		<span><strong>Ó</strong></span>
										    	</div>
										    	<div class="col-md-12">
										    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Nuevo Cliente</button>
										    	</div>
										    </div>
										    <div class="row text-center">
										    	<hr style="width: 90%; color: #337ab7; height: 1px; background-color:#337ab7;">
										    	<div class="col-md-12">
										    		<span><em>Forma de Pago</em></span>
										    	</div>
										    	<div class="col-md-12">
										    		<select id="lst-pago" class="form-control">
										    			<option value="" selected>Seleccione una opcion</option>
											                
										    		</select>
										    	</div>
										    </div>
										</div>
									</div>
							</div>
						</div><!--End row table-->
						<div class="row">
							<div class="col-xs-12 col-md-12">
								<button class="btn btn-primary btn-block btn-lg" type="submit">Generar Venta</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
</div>

<script id="facturador-detalle-template" type="text/x-jsrender" src="">
    {{for items}}
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-danger form-control" onclick="facturador.retirar({{:id}});"
                        data-toggle="tooltip" data-placement="top" title="Eliminar fila">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </span>
                    <input name="producto_id" type="hidden" value="{{:producto_id}}" />
                    <input disabled name="producto" class="form-control" type="text" placeholder="Nombre del producto" value="{{:producto}}" />
                </div>
            </div>
            <div class="col-xs-1">
                <input name="cantidad" class="form-control" type="text" placeholder="Cantidad" value="{{:cantidad}}" 
                data-toggle="tooltip" data-placement="top" title="Puede modificar la cantidad"/>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Q.</span>
                  <input name="precio" class="form-control" type="text" placeholder="Precio" value="{{:precio}}" 
                  data-toggle="tooltip" data-placement="top" title="Puede modificar el precio"/>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="input-group">
                    <span class="input-group-addon">Q.</span>
                    <input name="precio"  class="form-control" type="text" readonly value="{{:total}}" />
                    <span class="input-group-btn">
<button type="button" class="btn btn-success form-control" onclick="facturador.actualizar({{:id}}, this);" class="btn-retirar"
		data-toggle="tooltip" data-placement="top" title="Actualizar fila">
    <i class="fa fa-refresh" aria-hidden="true"></i>
</button>
                    </span>
                </div>
            </div>
        </div>
    </li>
    {{else}}
    <li class="text-center list-group-item">No se han agregado productos al detalle</li>
    {{/for}}
    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                <h2>TOTAL Q.</h2>
            </div>
            <div class="col-xs-2">	
                <b><h2>{{:total}}</h2></b>
            </div>
        </div>
    </li>
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" id="thismodal">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro Rápido de Cliente</h4>
      </div>
      <div class="modal-body">
        <div class="row">
		 <form class="form-horizontal" id="frm_fast_client" action="" method="POST">
				 <!--div class="row"-->
				 	<div class="col-xs-8 col-xs-offset-1">
				 		<div class="form-group">
					         <label for="inputNombre" class="control-label col-xs-2">Nombres</label>
					         <div class="col-xs-9">
					             <input type="text" class="form-control" placeholder="Nombres" 
					             	name="nombre" id="nombre" required>
					         </div>
					     </div>
					     <div class="form-group">
					         <label for="inputApellido" class="control-label col-xs-2">Apellidos</label>
					         <div class="col-xs-9">
					             <input type="text" class="form-control" placeholder="Apellidos" 
					             	name="apellido" id="apellido" required>
					         </div>
					     </div>
					     <div class="form-group">
					         <label for="inputDpi" class="control-label col-xs-2">DPI</label>
					         <div class="col-xs-9">
					             <input type="text" class="form-control" placeholder="DPI"
					             	name="dpi" id="dpi" required>
					         </div>
					     </div>		
				 	</div>
				 <!--/div-->
	        </div>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary">Guardar</button>
	      </div>
 	</form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="/assets/scripts/venta.js"></script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>