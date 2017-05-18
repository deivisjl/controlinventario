<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
  	include '/controllers/BaseUrl.php';

  	if($_SESSION["login"]["Rol_Id"] == 1){
?>

<?php 
	if(isset($_GET["id"]) && !empty($_GET['id']))
	{
		$id = $_GET["id"];

		//$selectUpdateProveedor = "SELECT * from usuario where persona_id = $id";

		$selectUpdateProveedor = "SELECT U.Persona_Id, U.Username, U.Rol_Id, R.Nombre_Rol,
											P.Nombres, P.Apellidos, P.Genero, P.Telefono, P.Correo, P.Direccion, P.Ciudad
												from usuario As U join persona as P
													on U.Persona_Id = P.Id
													inner join rol as R
													on U.Rol_Id=R.Id

														where U.Persona_Id = $id";
		$resultSelect = mysqli_query($db,$selectUpdateProveedor);
		$rol = "SELECT Id as clave, Nombre_Rol as nombre from rol order by Nombre_Rol asc";
		$resultTipo = mysqli_query($db,$rol);

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
						<h4 style="text-align: center;">ACTUALIZAR USUARIO</h4>
					</div>
					<div class="panel-body">
								<ol class="breadcrumb">
								  <li><a href="/usuarios.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
								</ol>
								<hr/>
					<div class="col-md-2"></div>
						<div class="col-md-8">


							<form role="form" id="frm_proveedor" method="POST" action="./controllers/getUser.php">
							<div class="col-xs-6">

							<input type="hidden" name="Persona_Id" value="<?= $arrays["Persona_Id"]?>">

								<div class="form-group">
									<label class="text-danger">Nombre de Usuario</label>
									<input type="text" class="form-control" placeholder="Nombre de usuario" name ="username"
									value="<?= $arrays["Username"] ?>" autofocus="true" data-validacion-tipo="requerido|min:3"/>
								</div>
									

								<div class="form-group">	
									<label>Rol</label>
										<select name="tipo" class="form-control">
											<?php 
									        while($results = mysqli_fetch_array($resultTipo)){ ?>
									        <option value="<?php echo $results["clave"] ?>" 
									        <?php 
													if($arrays["Rol_Id"] == $results["clave"])
														{ 
															echo "selected='selected'"; 
														} 
												?>
									        >
									        	<?php  echo $results["nombre"]?>
									        </option>
									    <?php } ?>
										</select>
								</div>
							
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label class="text-danger">Nombres del Usuario</label>
									<input type="text" class="form-control" placeholder="Nombres del Contacto" name ="nombre" autofocus="true" data-validacion-tipo="requerido|min:3" value="<?= $arrays["Nombres"] ?>"/>
								</div>
																
								<div class="form-group">
									<label class="text-danger">Apellidos del Usuario</label>
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
								
								<button type="submit" name="addusuario" class="btn btn-warning">Actualizar</button>
								<a href="/usuarios.php" class="btn btn-default">Cancelar</a>
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