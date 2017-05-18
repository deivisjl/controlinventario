
<?php 

	include '../includes/redirect.php';
	include '/BaseUrl.php';
	include '../config.php';
		

	$baseUrl = BaseUrl::getServer();
	$detalle = $_POST;

	try {
		$db->autocommit(false); //seteamos el autocommit
		//$lastId = "SELECT max(Id) as id from venta";
		//$resultLastId = $db->query($lastId);
		//if($resultLastId){

			//$arrayId = mysqli_fetch_array($resultLastId);
				//$id = $arrayId["id"] + 1;
				$usuario = $_SESSION["login"]["Persona_Id"];
				$fecha = date("Y-m-d"); 

				$sqlInsert = "INSERT into venta 
									values( NULL,
                            			 	'{$usuario}',
                            			 	'{$detalle['cliente_id']}',
                            				'{$detalle['total']}',
                            				'{$fecha}')";

                $resultInsert = $db->query($sqlInsert);

                if($resultInsert){

                	$id = $db->insert_id;

                	foreach($detalle['items'] as $d)
					{
						$sqlDetalle = "INSERT INTO venta_detalle(Venta_Id,Producto_Id,Precio,Cantidad)
											values('{$id}',
													'{$d['producto_id']}',
													'{$d['precio']}',
													'{$d['cantidad']}')";

						$resultDetalle = $db->query($sqlDetalle);

						if($resultDetalle){}
						else{
								throw new Exception('Ocurrió un error al realizar la transacción.'); 
								exit();   	
							}
						
					}//foreach
					if($resultDetalle){
							//$lastIdFactura = "SELECT max(Id) as Id from factura";
							//$resultLastIdFactura = $db->query($lastIdFactura);
							//if($resultLastIdFactura){
								//$arrayIdFactura = mysqli_fetch_array($resultLastIdFactura);
								//$IdFactura = $arrayIdFactura["Id"] + 1;
								$ventaId = $id;
								$estadoId = $detalle['forma_pago'] == 1 ? 1 : 2;
								$insertFactura = "INSERT into factura 
									values(NULL,'{$ventaId}','{$detalle['forma_pago']}','{$estadoId}')";	

								$resultInsertFactura = $db->query($insertFactura);

									if ($resultInsertFactura && $detalle['forma_pago'] == 2) {
										$IdFactura = $db->insert_id;

										//$lastIdDeudor = "SELECT max(Id) as Id from Deudor";
										//$resultLastIdDeudor = $db->query($lastIdDeudor);
											//if ($resultLastIdDeudor) {
												//$arrayIdDeudor = mysqli_fetch_array($resultLastIdDeudor);
												//$IdDeudor = $arrayIdDeudor["Id"] + 1;
												
												$sqlInsertDeudor = "INSERT into deudor values(NULL,'{$IdFactura}','{$detalle['total']}','{$detalle['total']}','{$fecha}')";

												$resultTransaccion = $db->query($sqlInsertDeudor);
													if ($resultTransaccion) {

														$db->commit();
														$_SESSION["insertVenta"] = 1;
														verificarResultado($resultTransaccion);

													}else{
														throw new Exception('Ocurrió un error al realizar la transacción.');		
													}
											/*}else{
												throw new Exception('Ocurrió un error al realizar la transacción.');				
											}*/
									}else if($resultInsertFactura){

										$db->commit();
										$_SESSION["insertVenta"] = 1;
										verificarResultado($resultInsertFactura);

									}else{

										throw new Exception('Ocurrió un error al realizar la transacción.');		

									}

							/*}else{
								throw new Exception('Ocurrió un error al realizar la transacción.');		
							}*/
					}else{
						throw new Exception('Ocurrió un error al realizar la transacción.');	
					}

                }else{
            		throw new Exception('Ocurrió un error al realizar la transacción.');    	
                }

		/*}else{
			throw new Exception('Ocurrió un error al realizar la transacción.');
		}*/
		
	} catch (Exception $e) {
		$db->rollback();
		$_SESSION["insertVenta"] = 0;
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
