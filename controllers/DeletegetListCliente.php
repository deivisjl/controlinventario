<?php
include '../includes/redirect.php';
include '../config.php';

$search = $_GET;

$limite = $search['start'].','.$search['length'];
$ordenadores = array("C.Persona_Id","P.Nombres","C.DPI","F.Id");
$columna = $search['order'][0]["column"];
$criterio = $search['search']['value'];

$query2 = "SELECT C.Persona_Id as Id, C.DPI as dpi, CONCAT(P.Nombres,' ',P.Apellidos) as Cliente, count(F.Id) as factura
	from cliente as C join persona as P
		on C.Persona_Id = P.Id
			Left join venta as V
				on C.Persona_Id = V.Cliente_Id
					Left join factura as F
						on V.Id = F.Venta_Id
							Where {$ordenadores[$columna]} LIKE '%$criterio%'
							group by C.Persona_Id, C.DPI, P.Nombres, P.Apellidos
							Order by {$ordenadores[$columna]} {$search['order'][0]["dir"]}
							LIMIT {$limite}";



$datosResult = mysqli_query($db,$query2);

$cantidad = 0;

$valores = array();

 while($datos = mysqli_fetch_array($datosResult)){ 
 	$valores[] = array(
			'Id' => $datos["Id"],
			'dpi' => $datos["dpi"],
			'Cliente' => $datos["Cliente"],
			'factura' => $datos["factura"],
	);	
	$cantidad = $cantidad + 1;	
 }

$respuesta = array(
		'draw' => $search["draw"],
		'recordsTotal' => $cantidad,
		'recordsFiltered' => $cantidad,
		'data' => $valores,
		);



	print_r(json_encode($respuesta));


?>