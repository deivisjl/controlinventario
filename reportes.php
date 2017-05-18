<?php
	include 'includes/redirect.php';
  	include 'includes/header.php';
  	include 'controllers/BaseUrl.php';

	if($_SESSION["login"]["Rol_Id"] == 1){

?>
<style type="text/css">
	ul li{
		list-style: none;
	}
</style>
<div class="row text-center">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>REPORTES</h4>						
					</div>
					<div class="panel-body">
						<div class="row">
						  	<div class="col-xs-6 col-md-3">
							    <div class="thumbnail">
							      		<img src="./images/ventas.png" alt="ventas">
									      <div class="caption">
									        <h3>Reporte de Ventas</h3>
									        <p>Filtrado de ventas a partir de un intervalo de fechas.</p>
									        <p><a href="./reporteVenta.php" class="btn btn-primary" role="button"><span class="fa fa-shopping-cart fa-2x"></span></a> 
									      </div>
							    </div>
						  	</div>

						  	<div class="col-xs-6 col-md-3">
							    <div class="thumbnail">
									    <img src="./images/stock.png" alt="grafico">
										      <div class="caption">
										        <h3>Artículo Bajo Stock</h3>
										        <p>Reporte de Artículos con bajo stock, con opción a exportar.</p>
										        <p><a href="./reporteStock.php" class="btn btn-primary" role="button"><span class="fa fa-archive fa-2x"></span></a> 
										      </div>
							    </div>
						  	</div>

						  <div class="col-xs-6 col-md-3">
						    <div class="thumbnail">
						      <img src="./images/Cliente.png" alt="deudor">
						      <div class="caption">
						        <h3>Reporte de Deudores</h3>
						        <p>Listado de deudores con opción para abonar deuda.</p>
						        <p><a href="./reporteDeudor.php" class="btn btn-primary" role="button"><span class="fa fa-vcard-o fa-2x"></span></a> 
						      </div>
						    </div>
						  </div>
							
						<div class="col-xs-6 col-md-3">
						    <div class="thumbnail">
						      <img src="./images/compra.png" alt="compra">
						      <div class="caption">
						        <h3>Reporte de Compras</h3>
						        <p>Listado de compras realizadas con filtro por columna.</p>
						        <p><a href="./reporteCompra.php" class="btn btn-primary" role="button"><span class="fa fa-shopping-bag fa-2x"></span></a> 
						      </div>
						    </div>
						  </div>
						 	 	
						</div>
						
						<div class="row text-center">
								<div class="col-xs-6 col-md-3">
								    <div class="thumbnail">
									      <img src="./images/graphics.png" alt="grafico">
										      <div class="caption">
										        <h3>Gráficos del negocio</h3>
										        <p>Gráficos de comportamiento de los productos y venta.</p>
										        <p><a href="./reporteGrafico.php" class="btn btn-primary" role="button"><span class="fa fa-bar-chart fa-2x"></span></a> 
										      </div>
								    </div>
								</div>
						</div>

						
					</div>
				</div>
			</div>
</div>



<?php include 'includes/footer.php'; ?>
  <?php }
      else{
        $baseUrl = BaseUrl::getServer();
        header("Location: $baseUrl");  
        } ?>