<?php 

include '/BaseUrl.php';

function ProductoResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertProd"]=1;
		}else if($result == 0){
			$_SESSION["insertProd"]=0;
		}
		header("Location: $baseUrl/producto.php");

	}
 ?>

<?php 
if(isset($_POST['addproducto'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	
	$features = "";

		if(isset($_POST['features']) && !empty($_POST['features'])){$features = $_POST['features'];}

		if($_POST['send']==1){
			//$lastId = "SELECT max(Id) as id from producto";
			//$resultLastId = mysqli_query($db,$lastId);
			//if($resultLastId)
			//{
				//$arrayId = mysqli_fetch_array($resultLastId);
				//$id = $arrayId["id"] + 1;
					
				$queryInsert = "INSERT into producto
									values(NULL,'{$_POST["proveedor"]}',
											'{$_POST["marca"]}','{$_POST["categoria"]}',
											'{$_POST["cantidad"]}','{$_POST["atributo"]}',
											'{$_POST["tipo"]}','{$features}',
											'{$_POST["stockmin"]}','{$_POST["stockmax"]}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);

				//SI SE INSERTO EL PRODUCTO AHORA LO REGISTRAMOS EN EL INVENTARIO
			if($resultQueryInsert){

				$id = mysqli_insert_id($db);

					//$lastProd = "SELECT max(Id) as id from inventario";
					//$resultProd = mysqli_query($db,$lastProd);

						//if($resultProd){
							//$arrayInventario = mysqli_fetch_array($resultProd);
								//$Id_inventario = $arrayInventario["id"] + 1;

							$queryInventario = "INSERT into inventario 
									values(NULL,'{$id}',0.0,0.0,0.0,0)";

						 	$resultQueryInventario = mysqli_query($db,$queryInventario);

						 	if($resultQueryInventario){
						 			ProductoResponse(1);
						 	}
						 	else //del registro dentro del inventario
						 	{
						 			ProductoResponse(0);
						 	}
						/*}
						else //del registro del nuevo producto
						{
							ProductoResponse(0);
						}*/

				}//si se inserto correctamente el producto	
				else
				{
					ProductoResponse(0);
				}	

			//}//pidiendo el nuevo id
		}//if es un nuevo registro
		
		else if($_POST['send'] == 2){

				$sqlUpdate = "UPDATE producto 
								set Proveedor_Id = '{$_POST["proveedor"]}',
									Marca_Id = '{$_POST["marca"]}',
									Categoria_Id = '{$_POST["categoria"]}',
									Cantidad_Id = '{$_POST["cantidad"]}',
									Atributo_Id = '{$_POST["atributo"]}',
									Tipo_Id = '{$_POST["tipo"]}',
									Caracteristica = '{$features}',
									StockMin = '{$_POST["stockmin"]}',
									StockMax = '{$_POST["stockmax"]}'
								where Id = '{$_POST["prodID"]}'";

				try {
					$resultUpdate = mysqli_query($db,$sqlUpdate);

					if($resultUpdate){
						ProductoResponse(1);
					}else{
						ProductoResponse(0);
					}
				} catch (Exception $e) {
					ProductoResponse(0);					
				}
		}
		
		
		
	}


 ?>
