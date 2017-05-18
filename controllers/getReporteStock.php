<?php
include '../includes/redirect.php';
include '../config.php';

$search = $_GET;

$limite = $search['start'].','.$search['length'];
$ordenadores = array("P.Id","C.Nombre_Categoria","P.StockMin","P.StockMax","I.Stock");
$columna = $search['order'][0]["column"];
$criterio = $search['search']['value'];


$query2 = "SELECT P.Id, CONCAT(C.Nombre_Categoria,' ',M.Nombre_Marca,' ',T.Nombre,' ',A.Nombre_Atributo) 
			as Articulo, 
			R.Nombre_Empresa, P.StockMin, P.StockMax, I.Stock
			from producto as P join categoria as C
			On P.Categoria_Id = C.Id
			inner join marca as M
			On P.Marca_Id = M.Id
			inner join cantidad as T
			On P.Cantidad_Id = T.Id
			inner join atributo as A
			On P.Atributo_Id = a.Id
			inner join proveedor as R
			On P.Proveedor_Id = R.Persona_Id
			inner join inventario as I
			On P.Id = I.Producto_Id
				WHERE P.StockMin > I.Stock and {$ordenadores[$columna]} LIKE '%$criterio%'
				Order by {$ordenadores[$columna]} {$search['order'][0]["dir"]}
				LIMIT {$limite}";

$datosResult = mysqli_query($db,$query2);

$cantidad = 0;

$valores = array();

 while($datos = mysqli_fetch_array($datosResult)){ 
 	$valores[] = array(
 			'Id' => $datos["Id"],
			'Articulo' => $datos["Articulo"],
			'Nombre_Empresa' => $datos["Nombre_Empresa"],
			'StockMin' => $datos["StockMin"],
			'StockMax' => $datos["StockMax"],
			'Stock' => $datos["Stock"]
	);
	$cantidad++;		
 }

$respuesta = array(
		'draw' => $search["draw"],
		'recordsTotal' => $cantidad,
		'recordsFiltered' => $cantidad,
		'data' => $valores,
		);



	print_r(json_encode($respuesta));

?>