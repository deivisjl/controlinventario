<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
  	include 'controllers/BaseUrl.php';

	if($_SESSION["login"]["Rol_Id"] == 1){
?>

<?php 
	$getRol = "SELECT id as clave, Nombre_Rol as rol from rol";
	$resultRol = mysqli_query($db,$getRol);




 ?>

<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 style="text-align: center;">REGISTRAR USUARIO</h4>
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
								<div class="form-group">
									<label>Nombre del Usuario</label>
									<input type="text" class="form-control" placeholder="Nombre del Usuario" name ="username" autofocus="true" data-validacion-tipo="requerido|min:3"/>
								</div>
									
								<div class="form-group">
									<label>Contraseña</label>
									<input type="password" class="form-control" placeholder="Contraseña" id="pass" name ="pass"  data-validacion-tipo="requerido|min:5"/>
								</div>
								<div class="form-group">
									<label>Repita Contraseña</label>
									<input type="password" class="form-control" placeholder="Repita Contraseña" id="pass2" name ="pass2" data-validacion-tipo="requerido|min:5"/>
								</div>
								
									
								<div class="form-group">
									<label>Rol</label>
									<select id="rol_id" name="rol_id" class="form-control" >
								<?php 
								while($arrayRol = mysqli_fetch_array($resultRol))
								{
										echo "<option value = '".$arrayRol["clave"]."'>
											".$arrayRol["rol"]."				
									 </option>";
								}
								 ?>

								</select>

								</div>

														
							</div>

							<div class="col-xs-6">
								<div class="form-group">
									<label>Nombres</label>
									<input type="text" class="form-control" placeholder="Nombres" name ="nombre" autofocus="true" data-validacion-tipo="requerido|min:3"/>
								</div>
																
								<div class="form-group">
									<label >Apellidos</label>
									<input type="text" class="form-control" placeholder="Apellidos" name ="apellido" data-validacion-tipo="requerido|min:3"/>
								</div>

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
								
								<button type="submit" name="addusuario" class="btn btn-primary" >Guardar</button>
								<a href="/usuarios.php" class="btn btn-default">Cancelar</a>
							</div>

							</div>
					
						</form>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		

<style type="text/css">
	.has-error .small{
		color: #555 !important;
	}
</style>


<?php include 'includes/footer.php'; ?>
<script>
    $(document).ready(function(){

    	 $("#pass2").on('keyup', function(){
    	 	var pass1 = $("#pass").val();
    		var pass2 = $("#pass2").val();

    	 	var obj = $(this);
            var small = $('<small />');

            /* El contenedor del control */
            var form_group = obj.closest('.form-group');
            	form_group.removeClass('has-error'); /* Limpiamos el estado de error */
            	form_group.removeClass('has-success'); /* Limpiamos el estado de error */
            	var label = form_group.find('label');/* Capturamos el label donde queremos mostrar el mensaje */
            	label.find('small').remove(); /* Eliminamos el mensaje anterior */
            

            if (pass1 === pass2) {

            	label.append(small);
            	form_group.addClass('has-success');
    			small.text(obj.data('validacion-mensaje'));
    			small.text(" ");
    			
    		}else{

    			
    			label.append(small);
    			form_group.addClass('has-error');
    			small.text(obj.data('validacion-mensaje'));
    			small.text(" No coinciden las contraseñas");	

    		}
    		
    	 }).keyup();


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


