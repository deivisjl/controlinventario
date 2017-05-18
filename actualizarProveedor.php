<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
  	include '/controllers/BaseUrl.php';

  	if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2){
?>

<?php 
	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];
		$selectUpdateProveedor = "SELECT P.Persona_id, P.Nombre_Empresa, P.Nit, P.Telefono_Empresa,
											U.Nombres, U.Apellidos, U.Genero, U.Telefono, U.Correo, U.Direccion, U.Ciudad
												from proveedor As P join persona as U
													on P.Persona_id = U.Id
														where P.Persona_id = $id";
		$resultSelect = mysqli_query($db,$selectUpdateProveedor);

		if($resultSelect){
			$arrays = mysqli_fetch_array($resultSelect);
		}
	}else{
		$baseUrl = BaseUrl::getServer();
		header("Location: $baseUrl");
	}
 ?>

<?php if(count($arrays) > 0){ ?>
<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div style="text-align: center;">ACTUALIZAR PROVEEDOR</div>
					</div>
					<div class="panel-body">
								
					<div class="col-md-2"></div>
						<div class="col-md-8">
								<ol class="breadcrumb">
								  <li><a href="/proveedor.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
								</ol>
								<hr/>


							<form role="form" id="frm_proveedor" method="POST" action="./controllers/getProveedor.php">
							<div class="col-xs-6">

							<input type="hidden" name="provID" value="<?= $arrays["Persona_id"]?>">

								<div class="form-group">
									<label class="text-danger">Nombre del Proveedor</label>
									<input type="text" class="form-control" placeholder="Nombre del Proveedor" name ="proveedor"
									value="<?= $arrays["Nombre_Empresa"] ?>" autofocus="true" data-validacion-tipo="requerido|min:3"/>
								</div>
									
								<div class="form-group">
									<label>NIT</label>
									<input type="text" class="form-control" placeholder="NIT" name ="nit" 
									value="<?= $arrays["Nit"] ?>"/>
								</div>

								<div class="form-group">
									<label>Teléfono</label>
									<input type="text" class="form-control" placeholder="Teléfono" 
									value="<?= $arrays["Telefono_Empresa"] ?>" name ="tel"/>
								</div>
							
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="text-danger">Nombres del Contacto</label>
									<input type="text" class="form-control" placeholder="Nombres del Contacto" name ="nombre" autofocus="true" data-validacion-tipo="requerido|min:3" value="<?= $arrays["Nombres"] ?>"/>
								</div>
																
								<div class="form-group">
									<label class="text-danger">Apellidos del Contacto</label>
									<input type="text" class="form-control" placeholder="Apellidos del contacto" name ="apellido" data-validacion-tipo="requerido|min:3" value="<?= $arrays["Apellidos"] ?>"/>
								</div>

								<div class="form-group">	
									<label for="gender">Género:</label>	<div class="form_field">
										<input type="radio" <?php if($arrays["Genero"]== "M") { echo 'checked="checked"';} ?>  name="gender" value="1" id="gender">&nbsp;M&nbsp;
										<input type="radio" <?php if($arrays["Genero"]== "F") { echo 'checked="checked"';} ?> name="gender" value="0" id="gender">&nbsp;F	</div>
								</div>


								<div class="form-group">
									<label>Teléfono</label>
									<input type="text" class="form-control" placeholder="Teléfono" name ="telefono" 
									value="<?= $arrays["Telefono"] ?>"/>
								</div>

								<div class="form-group">
									<label>Correo</label>
									<input type="numeric" class="form-control" placeholder="Correo" name ="correo"
									value="<?= $arrays["Correo"] ?>"/>
								</div>
								
								<div class="form-group">
									<label>Dirección</label>
									<input type="text" class="form-control" placeholder="Dirección" name ="direccion"
									value="<?= $arrays["Direccion"] ?>"/>
								</div>

								<div class="form-group">
									<label>Ciudad</label>
									<input type="text" class="form-control" placeholder="Ciudad" name ="ciudad"
									value="<?= $arrays["Ciudad"] ?>"/>
								</div>
								
								<input type="hidden" value="2" name="send" />
								
								<button type="submit" name="addproveedor" class="btn btn-warning">Actualizar</button>
								<a href="/proveedor.php" class="btn btn-default">Cancelar</a>
							</div>

							</div>
					
						</form>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->

<?php } ?>


<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function(){
        $("#frm_proveedor").submit(function(){
            return $(this).validate();
        });
    })
</script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>