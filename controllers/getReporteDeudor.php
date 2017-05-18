<?php
include '../includes/redirect.php';
include '../config.php';

$search = $_GET;

$limite = $search['start'].','.$search['length'];
$ordenadores = array("D.Id","F.Id","P.Nombres","D.Monto","D.Saldo","D.Fecha");
$columna = $search['order'][0]["column"];
$criterio = $search['search']['value'];

$query2 = "SELECT F.Id as Factura, D.Id as Deuda, D.Monto, D.Saldo, DATE_FORMAT(D.Fecha,'%d/%m/%Y') as Fecha, CONCAT(P.Nombres,' ',P.Apellidos) as Cliente
from deudor as D join factura as F
	on D.Factura_Id = F.Id 
		inner join venta as V
			on F.Venta_Id = V.Id
				inner join cliente as C
					on V.Cliente_Id = C.Persona_Id
						inner join Persona as P
							on C.Persona_Id = P.Id
							Where F.Estado_Id = 2 and {$ordenadores[$columna]} LIKE '%$criterio%'
							Order by {$ordenadores[$columna]} {$search['order'][0]["dir"]}
							LIMIT {$limite}";

							
$sqlCount = "SELECT count(F.Id) as Total
				from deudor as D join factura as F
					on D.Factura_Id = F.Id 
						inner join venta as V
							on F.Venta_Id = V.Id
								inner join cliente as C
									on V.Cliente_Id = C.Persona_Id
										inner join Persona as P
											on C.Persona_Id = P.Id
					Where F.Estado_Id = 2 and {$ordenadores[$columna]} LIKE '%$criterio%'
							Order by {$ordenadores[$columna]} {$search['order'][0]['dir']}";

$datosResult = mysqli_query($db,$query2);

$cantidadResult = mysqli_query($db,$sqlCount);
$cantidad = mysqli_fetch_array($cantidadResult);

$valores = array();

 while($datos = mysqli_fetch_array($datosResult)){ 
 	$valores[] = array(
 			'Deuda' => $datos["Deuda"],
			'Factura' => $datos["Factura"],
			'Cliente' => $datos["Cliente"],
			'Monto' => $datos["Monto"],
			'Saldo' => $datos["Saldo"],
			'Fecha' => $datos["Fecha"],
	);		
 }

$respuesta = array(
		'draw' => $search["draw"],
		'recordsTotal' => $cantidad["Total"],
		'recordsFiltered' => $cantidad["Total"],
		'data' => $valores,
		);



	print_r(json_encode($respuesta));

?>