<?php 
	include '../includes/redirect.php';
	include '../config.php';
	
	 
	try {
		$respuesta = [];
		$Json_data = [];
		
		$queryItems ="SELECT DATE_FORMAT(Fecha,'%m') AS Fecha,
                                sum(Total) as Compra 
                                from compra 
                                GROUP BY DATE_FORMAT(Fecha, '%m')";

			$result = mysqli_query($db,$queryItems);
			if($result){
				
				while ($datos = mysqli_fetch_array($result)) {
					$Json_data[] = array(
						'Fecha' => $datos["Fecha"],
						'Total' => $datos["Compra"]
					);
				}	

				$respuesta = array(						
						'data' => $Json_data
					);	

				print_r(json_encode($respuesta));
			}

	} catch (Exception $e) {
		
	}

	
 ?>

 