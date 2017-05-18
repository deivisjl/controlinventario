<?php 
	include '../includes/redirect.php';
	include '../config.php';
	
	 
	try {
		$respuesta = [];
		$Json_data = [];
		
		$queryItems ="SELECT count(F.Pago_Id) as Pago, P.Forma
						from factura as F join formapago as P
						On F.Pago_Id = P.Id
						Group by F.Pago_Id, P.Forma";

			$result = mysqli_query($db,$queryItems);
			if($result){
				
				while ($datos = mysqli_fetch_array($result)) {
					$Json_data[] = array(
						'Pago' => $datos["Pago"],
						'Forma' => $datos["Forma"]
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

 