<?php 
	include '../includes/redirect.php';
	include '../config.php';
	 
	try {
		$respuesta = [];
		$Json_data = [];
		
		$queryDate = "SELECT max(fecha) as Fecha from venta";
		$resultado = mysqli_query($db,$queryDate);
		if ($resultado) {
			$arrayDate = mysqli_fetch_array($resultado);
			$LastDate = $arrayDate["Fecha"];

				$queryItems ="SELECT D.Producto_Id, SUM(D.cantidad) as total,
				CONCAT(C.Nombre_Categoria,' ',M.Nombre_marca,' ',L.Nombre,' ',A.Nombre_Atributo,' ',P.Caracteristica) as Producto
			from venta_detalle As D JOIN venta as V
			ON D.Venta_Id = V.Id
			INNER JOIN Producto as P
			ON D.Producto_Id = P.Id
			INNER JOIN categoria as C 
			ON P.Categoria_Id = C.Id
			INNER JOIN marca as M 
			ON P.Marca_Id = M.Id
			INNER JOIN cantidad as L
			ON P.Cantidad_Id = L.Id
			INNER JOIN atributo as A
			ON P.Atributo_Id = A.Id
			Where V.Fecha BETWEEN  DATE_SUB('{$LastDate}', interval 12 month) AND '{$LastDate}' 
			group by D.producto_Id";

			$result = mysqli_query($db,$queryItems);
			if($result){
				
				while ($datos = mysqli_fetch_array($result)) {
					$Json_data[] = array(
						'Codigo' => $datos["Producto_Id"],
						'Item' => $datos["Producto"],
						'Total' => $datos["total"]
					);
				}

				$respuesta = array(
						'fecha' => $LastDate,
						'data' => $Json_data
					);

				print_r(json_encode($respuesta));
			}

		}
	
	

	} catch (Exception $e) {
		
	}

	
 ?>

 