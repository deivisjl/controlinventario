<?php 
	include '../includes/redirect.php';
	include '../config.php';
	include '/BaseUrl.php';
		

	$baseUrl = BaseUrl::getServer();
	$detalle = $_POST;

	try {
		$db->autocommit(false); //seteamos el autocommit
		//$lastId = "SELECT max(Id) as id from compra";
		//$resultLastId = $db->query($lastId);

		//if($resultLastId){

			//$arrayId = mysqli_fetch_array($resultLastId);
					//$id = $arrayId["id"] + 1;
					$usuario = $_SESSION["login"]["Persona_Id"];
					$fecha = date("Y-m-d");

				$sqlInsert = "INSERT into compra 
												values( NULL,
			                            			 	'{$usuario}',
			                            				'{$detalle['total']}',
			                            				'{$fecha}')";
			    $resultInsert = $db->query($sqlInsert);

			    if($resultInsert){
			    	$id = $db->insert_id;

			    	foreach($detalle['items'] as $d)
					{
						$sqlDetalle = "INSERT INTO compra_detalle(Compra_Id,Producto_Id,PrecioCosto,PrecioSugerido,Cantidad)
											values( '{$id}',
													'{$d['producto_id']}',
													'{$d['costo']}',
													'{$d['precio']}',
													'{$d['cantidad']}')";

						$resultDetalle = $db->query($sqlDetalle);
						if($resultDetalle){}
						else{
							throw new Exception('Ocurrió un error al realizar la transacción.');
							exit();			
						}
						
					}//foreach
					$db->commit();
					verificarResultado($resultDetalle);
					$_SESSION["insertCompra"] = 1;		

			    }else{
			    	throw new Exception('Ocurrió un error al realizar la transacción.');
			    }

		/*}else
		{
			throw new Exception('Ocurrió un error al realizar la transacción.');
		}*/
		


		
	} catch (Exception $e) {
		$db->rollback();
		$_SESSION["insertCompra"] = 0;
		verificarResultado($resultDetalle,$e->getMessage());
	}

	function verificarResultado($info,$error = null){
		if (!$info) {
			$result["resp"] = "ERROR";
			$result["msj"] = $error;
		}else{
			$result["resp"] = "EXITO";
		}

		print_r(json_encode($result));
	}

 ?>
