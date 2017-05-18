<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/controllers/BaseUrl.php';
  	include '/config.php';

  	if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2 || $_SESSION["login"]["Rol_Id"] == 3){
?>

 <?php 
 	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];
		$selectUpdateCliente = "SELECT C.Persona_id as Id, C.DPI as dpi, 
					  				P.Nombres, P.Apellidos, P.Genero, 
					  					P.Telefono, P.Correo, P.Direccion, P.Ciudad
					  					from cliente as C join persona as P
					  						on C.Persona_id = P.Id
					  							where C.Persona_id = $id";

		$resultSelect = mysqli_query($db,$selectUpdateCliente);
		$count = mysqli_num_rows($resultSelect);

		if($resultSelect && $count > 0){
			$arrays = mysqli_fetch_array($resultSelect);
		}else{
			$baseUrl = BaseUrl::getServer();
			header("Location: $baseUrl");	
		}
	}else{
		$baseUrl = BaseUrl::getServer();
		header("Location: $baseUrl");
	}
 ?>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div style="text-align: center;">ACTUALIZAR CLIENTE</div>
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
							<input type="hidden" name="codigo" value="<?= $arrays["Id"]?>">
								<div class="form-group">
									<label>Nombres del Cliente</label>
									<input type="text" class="form-control" placeholder="Nombres del Cliente" name ="nombre" autofocus="true" data-validacion-tipo="requerido|min:3" value="<?= $arrays["Nombres"]?>"/>
								</div>

								<div class="form-group">
									<label>Apellidos del Cliente</label>
									<input type="text" class="form-control" placeholder="Apellidos del Cliente" name ="apellido" autofocus="true" data-validacion-tipo="requerido|min:3" value="<?= $arrays["Apellidos"]?>"/>
								</div>
									
								<div class="form-group">
									<label>DPI</label>
									<input type="text" class="form-control" placeholder="DPI" name ="dpi"
									 data-validacion-tipo="requerido|min:3|numero" value="<?= $arrays["dpi"]?>"/>
								</div>
							
							</div>
							<div class="col-xs-6">

								<div class="form-group">	
									<label for="gender">Género:</label>	<div class="form_field">
										<input type="radio" <?php if($arrays["Genero"]== "M") { echo 'checked="checked"';} ?> name="gender" value="1" id="gender">&nbsp;M&nbsp;
										<input type="radio" <?php if($arrays["Genero"]== "F") { echo 'checked="checked"';} ?> name="gender" value="0" id="gender">&nbsp;F	</div>
								</div>


								<div class="form-group">
									<label>Teléfono</label>
									<input type="text" class="form-control" placeholder="Teléfono" name ="telefono" value="<?= $arrays["Telefono"]?>">
								</div>

								<div class="form-group">
									<label>Correo</label>
									<input type="numeric" class="form-control" placeholder="Correo" name ="correo"
									value="<?= $arrays["Correo"]?>">
								</div>
								
								<div class="form-group">
									<label>Dirección</label>
									<input type="text" class="form-control" placeholder="Dirección" name ="direccion"
									value="<?= $arrays["Direccion"]?>">
								</div>

								<div class="form-group">
									<label>Ciudad</label>
									<input type="text" class="form-control" placeholder="Ciudad" name ="ciudad"
									value="<?= $arrays["Ciudad"]?>">
								</div>
								
								<input type="hidden" value="2" name="send" />
								<div class="row">
									<div class="col-md-3">
										<button type="submit" name="addCliente" class="btn btn-warning">Actualizar</button>
									</div>
									<div class="col-md-3">
										<a href="./cliente.php" class="btn btn-default">Cancelar</a>
									</div>
								</div>
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
		