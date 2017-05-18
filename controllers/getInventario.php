<?php
include '../includes/redirect.php';
include '../config.php';

$search = $_GET;

$limite = $search['start'].','.$search['length'];
$ordenadores = array("P.Id","C.Nombre_Categoria","I.CostoActual","I.PrecioSugerido","I.Stock");
$columna = $search['order'][0]["column"];
$criterio = $search['search']['value'];

$query2 = "SELECT P.Id, Concat(C.Nombre_Categoria,' ',K.Nombre,' ',A.Nombre_Atributo) as Nombre, 
						I.CostoActual, I.PrecioSugerido, I.Stock from producto as P join categoria as C
							on P.Categoria_Id = C.Id 
							inner join Cantidad as K 
								on P.Cantidad_Id = K.Id 
								inner join Atributo as A 
									on P.Atributo_Id = A.Id 
										inner join inventario as I 
										on P.Id = I.Id
							Where {$ordenadores[$columna]} LIKE '%$criterio%'
							Order by {$ordenadores[$columna]} {$search['order'][0]["dir"]}
							LIMIT {$limite}";
							
$sqlCount = "SELECT count(P.Id) as Total
				from Producto as P join Categoria as C
					on P.Categoria_Id = C.Id
						inner join inventario as I 
							on P.Id = I.Id
					Where {$ordenadores[$columna]} LIKE '%$criterio%'
							Order by {$ordenadores[$columna]} {$search['order'][0]['dir']}";

$datosResult = mysqli_query($db,$query2);
$cantidadResult = mysqli_query($db,$sqlCount);


$cantidad = mysqli_fetch_array($cantidadResult);

$valores = array();

 while($datos = mysqli_fetch_array($datosResult)){ 
 	$valores[] = array(
			'Id' => $datos["Id"],
			'Nombre' => $datos["Nombre"],
			'CostoActual' => $datos["CostoActual"],
			'PrecioSugerido' => $datos["PrecioSugerido"],
			'Stock' => $datos["Stock"]
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