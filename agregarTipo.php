<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include '/config.php';
  	include 'controllers/BaseUrl.php';

if($_SESSION["login"]["Rol_Id"] == 1 || $_SESSION["login"]["Rol_Id"] == 2){

?>

<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 style="text-align: center;">NUEVO TIPO</h4>
						
					</div>
					<div class="panel-body">
							<div class="row">
								<div class="col-md-2"></div>
									<div class="col-md-8">
										<ol class="breadcrumb">
										  <li><a href="/producto.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
										</ol>
									</div>
								<div class="col-md-2"></div>
							</div>
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<form role="form" id="frm_tipo" method="POST" action="./controllers/getTipo.php">
							  	<div class="form-group">
									<label class="text-danger">Nombre del Tipo</label>
									<input type="text" class="form-control" placeholder="Tipo" name ="tipo" 
												autofocus="true" data-validacion-tipo="requerido|min:3"/>
								</div>
								<input type="hidden" value="1" name="send" />
								<button type="submit" name="addTipo" class="btn btn-primary">Guardar</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
</div>	

<script>
    $(document).ready(function(){
        $("#frm_tipo").submit(function(){
            return $(this).validate();
        });
    })
</script>

<?php include 'includes/footer.php'; ?>

<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>