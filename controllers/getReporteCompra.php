<?php
include '../includes/redirect.php';
include '../config.php';

$search = $_GET;

$limite = $search['start'].','.$search['length'];
$ordenadores = array("C.Id","C.Total","C.Fecha","U.Nombres");
$columna = $search['order'][0]["column"];
$criterio = $search['search']['value'];

$query2 = "SELECT C.Id, C.Total, DATE_FORMAT(C.Fecha,'%d/%m/%Y') as Fecha, CONCAT(U.Nombres,' ',U.Apellidos) as Usuario 
			FROM compra as C join Usuario as S
			ON C.Usuario_Id = S.Persona_Id
			INNER JOIN Persona as U
			ON S.Persona_Id = U.Id
							Where {$ordenadores[$columna]} LIKE '%$criterio%'
							Order by {$ordenadores[$columna]} {$search['order'][0]["dir"]}
							LIMIT {$limite}";
							
$sqlCount = "SELECT count(C.Id) as Total
				from compra as C join Usuario as S
					on C.Usuario_Id = S.Persona_Id
						inner join Persona as U  
							on S.Persona_Id = U.Id
					Where {$ordenadores[$columna]} LIKE '%$criterio%'
							Order by {$ordenadores[$columna]} {$search['order'][0]['dir']}";

$datosResult = mysqli_query($db,$query2);
$cantidadResult = mysqli_query($db,$sqlCount);


$cantidad = mysqli_fetch_array($cantidadResult);

$valores = array();

 while($datos = mysqli_fetch_array($datosResult)){ 
 	$valores[] = array(
			'Id' => $datos["Id"],
			'Total' => $datos["Total"],
			'Fecha' => $datos["Fecha"],
			'Usuario' => $datos["Usuario"],
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