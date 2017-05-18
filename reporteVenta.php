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
						<h4 style="text-align: center;">FILTRO DE VENTAS CONTABILIZADAS</h4>
						
					</div>
					<div class="panel-body">

								


					<div class="well well-sm">
						<div class="row text-center">
							<div class="col-md-1">
							  <li id="atras"><a href="/reportes.php"><span class="fa fa-arrow-circle-left fa-3x"></span></a></li>
							</div>

							<div class="col-md-1 col-md-offset-2">
								<span><strong>Desde:</strong></span>
							</div>
							<div class="col-md-2">
								<input type="date" id="start" class="form-control">
							</div>

							<div class="col-md-1">
								<span><strong>Hasta:</strong></span>
							</div>
							<div class="col-md-2">
								<input type="date" id="limit" class="form-control">
							</div>
							

						</div>
					</div>
						

						<div class="row">
							<div class="col-xs-12 col-md-12">
								<div class="registros" id="agrega-registros"></div>
							</div>
						</div>


					 </div>
          		</div>
        	</div>
</div>
<?php include 'includes/footer.php'; ?>
<script type="text/javascript" src="/assets/scripts/reporte.js"></script>
<?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>
 