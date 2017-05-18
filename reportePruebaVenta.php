<?php
	include 'includes/redirect.php';
  include 'includes/header.php';  	
?>
<div class="row">
	<div class="col-md-4">
		    <div class="thumbnail">
	                <div class="caption">
	                	<div class="panel panel-primary">
	                		<div class="panel-heading text-center">Detalle de Montos</div>
								  <div class="panel-body">
								    	<span><h3 class="text-danger">Monto al Crédito: Q. 75.00</h3></span>
											<span><h3 class="text-success">Monto al Contado: Q. 50.00</h3></span>
											<span><h3 class="text-info">Abonos: Q. 10.00</h3></span>
											<span><h3>========================</h3></span>
											<span><h3>Total Efectivo: Q. 60.00</h3></span>
								  </div>
						</div>
					</div>
			</div>
	</div>
	<div class="col-md-8">
		<div class="thumbnail">
                <div class="caption">
					<div class="panel panel-primary">
						  <div class="panel-heading text-center">Detalle de ventas</div>
						  <div class="panel-body">
						    	<table class="table table-striped dataTable no-footer">
						        	<tbody><tr>
						            	<th style="text-align: center !important;">Codigo Venta</th>
						                <th style="text-align: center !important;">Nombre del Cliente</th>
						                <th style="text-align: center !important;">Fecha</th>
						                <th style="text-align: center !important;">Monto</th>
						                <th style="text-align: center !important;">Saldo Adeudado</th>
						                <th style="text-align: center !important;">Forma de Venta</th>
						                <th style="text-align: center !important;">Estado</th>
						            </tr><tr>
										<td style="text-align: center !important;">3</td>
										<td>Marlon Segura</td>
										<td style="text-align: center !important;">21/02/2017</td>
										<td>Q. 30.00</td>
										<td>Q. 30.00</td>
										<td style="text-align: center !important;">Credito</td>
										<td style="text-align: center !important;">Pendiente</td>				
										</tr><tr>
										<td style="text-align: center !important;">4</td>
										<td>Marlon Segura</td>
										<td style="text-align: center !important;">21/02/2017</td>
										<td>Q. 12.00</td>
										<td>Q. 12.00</td>
										<td style="text-align: center !important;">Credito</td>
										<td style="text-align: center !important;">Pendiente</td>				
										</tr><tr>
										<td style="text-align: center !important;">5</td>
										<td>Marlon Segura</td>
										<td style="text-align: center !important;">21/02/2017</td>
										<td>Q. 6.00</td>
										<td>Q. 6.00</td>
										<td style="text-align: center !important;">Credito</td>
										<td style="text-align: center !important;">Pendiente</td>				
										</tr><tr>
										<td style="text-align: center !important;">6</td>
										<td>Marlon Segura</td>
										<td style="text-align: center !important;">21/02/2017</td>
										<td>Q. 6.00</td>
										<td>Q. 6.00</td>
										<td style="text-align: center !important;">Credito</td>
										<td style="text-align: center !important;">Pendiente</td>				
										</tr></tbody></table>
						  </div>
					</div>
			</div>
		</div>
	</div>

</div>
<?php include 'includes/footer.php'; ?>