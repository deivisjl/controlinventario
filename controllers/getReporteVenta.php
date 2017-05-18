<?php 
include '../includes/redirect.php';
		include '../config.php';

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$total = 0.00;
$contado = 0.00;
$credito = 0.00;
$tipoLabel;
$registroTabla;
$compras = 0.00;
$ventas = 0.00;
$diferencia = 0.00;


//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$query = "SELECT V.Id, V.Monto, DATE_FORMAT(V.Fecha,'%d/%m/%Y') as Fecha, CONCAT(P.Nombres,' ',P.Apellidos) as Cliente,
	  F.Id as idforma,F.Forma, E.Estado, D.Saldo
FROM venta as V join factura as S ON V.Id = S.Venta_Id
		INNER JOIN formapago as F ON F.Id = S.Pago_Id 
		INNER JOIN estadofactura as E ON E.Id = S.Estado_Id
		INNER JOIN cliente as C ON C.Persona_Id = V.Cliente_Id
		INNER JOIN persona as P ON P.Id = C.Persona_Id
		LEFT JOIN deudor as D  ON D.Factura_Id = S.Id
		WHERE V.Fecha BETWEEN '$desde' AND '$hasta'
		ORDER BY V.Id asc";

$queryAbono = "SELECT sum(Monto) as abono from pagodeuda where Fecha BETWEEN '$desde' AND '$hasta'";

$queryProd  = "SELECT D.Venta_Id, D.Producto_Id, D.Precio, D.Cantidad, I.CostoActual
		FROM venta_detalle as D JOIN venta as V
		ON D.Venta_Id = V.Id
		INNER JOIN Inventario as I
		ON D.Producto_Id = I.Producto_Id
		WHERE V.Fecha BETWEEN '$desde' AND '$hasta'";

$resultQueryProd = mysqli_query($db,$queryProd);

$registro = mysqli_query($db,$query);
$registroAbono = mysqli_query($db,$queryAbono);
if($registroAbono){
	$abono = mysqli_fetch_array($registroAbono);
}

if(mysqli_num_rows($resultQueryProd)>0){
	while($ganancia = mysqli_fetch_array($resultQueryProd)){
		$compras+= $ganancia["Cantidad"] * $ganancia["CostoActual"];
		$ventas+= $ganancia["Cantidad"] * $ganancia["Precio"];
	}
	$diferencia = $ventas - $compras;
}

if(mysqli_num_rows($registro)>0){
	//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
$fechaDesde = date_create($desde);
$fechaHasta = date_create($hasta);
echo '
<div class="row">
	<div class="col-md-12">
		    <div class="thumbnail">
	                <div class="caption">
	                	<div class="panel panel-primary">
	                		<div class="panel-heading text-center">Ganancia Parcial del '.date_format($fechaDesde, 'd-m-Y').' hasta '.date_format($fechaHasta, 'd-m-Y').'</div>
								  <div class="panel-body">
								    	<span><h3 class="text-danger text-center"> Q.  '.number_format($diferencia,2).'</h3></span>
								  </div>
						</div>
					</div>
			</div>
	</div>
</div>';

echo '<div class="row">
	<div class="col-md-8">
		<div class="thumbnail">
                <div class="caption">
					<div class="panel panel-primary">
						  <div class="panel-heading text-center">Detalle de ventas</div>
						  <div class="panel-body">
						    	<table class="table table-striped dataTable no-footer">
						    	<tr>
						    		<th>Código</th>
						    		<th>Cliente</th>
						    		<th>Fecha</th>
						    		<th>Monto</th>
						    		<th>Saldo adeudado</th>
						    		<th>Forma de pago</th>
						    		<th>Estado de factura</th>
						    	</tr>';
						    	reset($registro);
						    			while($registro2 = mysqli_fetch_array($registro)){
						    				if ($registro2['idforma'] == 1) {
												$contado = $contado +  $registro2['Monto'];

											}else if($registro2['idforma'] == 2){
												$credito = $credito +  $registro2['Monto'];
											}
											
											echo '<tr>
													<td style="text-align: center !important;">'.$registro2['Id'].'</td>
													<td>'.$registro2['Cliente'].'</td>
													<td style="text-align: center !important;">'.$registro2['Fecha'].'</td>
													<td>Q. '.number_format($registro2['Monto'],2).'</td>
													<td>Q. '.number_format($registro2['Saldo'],2).'</td>
													<td style="text-align: center !important;">'.$registro2['Forma'].'</td>
													<td style="text-align: center !important;">'.$registro2['Estado'].'</td>		
													';
						    			}

						    		$total = $contado + $abono["abono"];	
						        echo '</table>	
						  </div>
					</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		    <div class="thumbnail">
	                <div class="caption">
	                	<div class="panel panel-primary">
	                		<div class="panel-heading text-center">Detalle de Montos</div>
								  <div class="panel-body">
								    	<span><h3 class="text-danger">Monto al Crédito: Q. '.number_format($credito,2).'</h3></span>
								    	<span><h3>========================</h3></span>
											<span><h3 class="text-success">Monto al Contado: Q. '.number_format($contado,2).'</h3></span>
											<span><h3 class="text-info">Abonos: Q. '.number_format($abono["abono"],2).'</h3></span>
											<span><h3>========================</h3></span>
											<span><h3>Total Efectivo: Q. '.number_format($total,2).'</h3></span>
								  </div>
						</div>
					</div>
			</div>
	</div>

</div>';

}
else{
	echo '<tr><td colspan="6">No se encontraron resultados</td></tr>';
}

 ?>