<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
	include 'controllers/BaseUrl.php';

	if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2 || $_SESSION["login"]["Rol_Id"] == 3){

?>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div style="text-align: center;">REGISTRAR CLIENTE</div>
					</div>
					<div class="panel-body">
					<div class="row">
						<div class="col-md-2"></div>
							<div class="col-md-8">
								<ol class="breadcrumb">
								  <li><a href="/cliente.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
								</ol>
							</div>
						<div class="col-md-2"></div>
					</div>
						
					<div class="col-md-2"></div>
						<div class="col-md-8">

							<form role="form" id="frm_cliente" method="POST" action="./controllers/getCliente.php">
							<div class="col-xs-6">
								<div class="form-group">
									<label>Nombres del Cliente</label>
									<input type="text" class="form-control" placeholder="Nombres del Cliente" name ="nombre" autofocus="true" data-validacion-tipo="requerido|min:3"/>
								</div>

								<div class="form-group">
									<label>Apellidos del Cliente</label>
									<input type="text" class="form-control" placeholder="Apellidos del Cliente" name ="apellido" autofocus="true" data-validacion-tipo="requerido|min:3"/>
								</div>
									
								<div class="form-group">
									<label>DPI</label>
									<input type="text" class="form-control" placeholder="DPI" name ="dpi"
									 data-validacion-tipo="requerido|min:3|numero"/>
								</div>
							
							</div>
							<div class="col-xs-6">

								<div class="form-group">	
									<label for="gender">Género:</label>	<div class="form_field">
										<input type="radio" checked="checked" name="gender" value="1" id="gender">&nbsp;M&nbsp;<input type="radio" name="gender" value="0" id="gender">&nbsp;F	</div>
								</div>


								<div class="form-group">
									<label>Teléfono</label>
									<input type="text" class="form-control" placeholder="Teléfono" name ="telefono">
								</div>

								<div class="form-group">
									<label>Correo</label>
									<input type="numeric" class="form-control" placeholder="Correo" name ="correo">
								</div>
								
								<div class="form-group">
									<label>Dirección</label>
									<input type="text" class="form-control" placeholder="Dirección" name ="direccion">
								</div>

								<div class="form-group">
									<label>Ciudad</label>
									<input type="text" class="form-control" placeholder="Ciudad" name ="ciudad">
								</div>
								
								<input type="hidden" value="1" name="send" />

								<button type="submit" name="addCliente" class="btn btn-primary">Guardar</button>
									
							</div>

							</div>
					
						</form>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->




<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function(){
        $("#frm_cliente").submit(function(){
            return $(this).validate();
        });
    })
</script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>
		