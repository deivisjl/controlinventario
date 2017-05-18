<?php 

include '/BaseUrl.php';

function ProveedorResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertProv"]=1;
		}else if($result == 0){
			$_SESSION["insertProv"]=0;
		}else if($result == 2){
			$_SESSION["insertProv"]=2;
		}
		header("Location: $baseUrl/proveedor.php");

	}
 ?>

<?php 
if(isset($_POST['addproveedor'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	$id = "";
	$proveedor = "";
	$tel = "";
	$nit;
	$nombre = "";
	$apellido = "";
	$gender = "";
	$telefono = "";
	$correo = "";
	$direccion = "";
	$ciudad = "";


		if(isset($_POST['proveedor'])){$proveedor = $_POST['proveedor'];}

		if(isset($_POST['nit'])){if(empty($_POST['nit'])){ $nit = 00; }else{$nit = $_POST['nit'];}

		if(isset($_POST['tel'])){ $tel = $_POST['tel'];}

		if(isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}

		if(isset($_POST['apellido'])){ $apellido = $_POST['apellido']; }

		if(isset($_POST['gender'])){ $gender = $_POST['gender'] == 1 ? "M" : "F"; }

		if(isset($_POST['direccion'])){ $direccion = $_POST['direccion']; }

		if(isset($_POST['telefono'])){ if(empty($_POST['telefono'])){ $telefono = 00; }else{ $telefono = $_POST['telefono'];} }

		if(isset($_POST['correo'])){ $correo = $_POST['correo']; }

		if($_POST['send']==1){
			//$lastId = "SELECT max(Id) as id from persona";
			//$resultLastId = mysqli_query($db,$lastId);
			//if($resultLastId)
			//{
				//COMO EL PROVEEDOR EXTIENDE DE PERSONA PRIMERO INSERTAMOS LA PERSONA PIDIENDO UN NUEVO ID
				$arrayId = mysqli_fetch_array($resultLastId);
				//$id = $arrayId["id"] + 1;

				$queryInsert = "INSERT into persona
									values(NULL,'{$nombre}',
											'{$apellido}', '{$gender}',
											'{$telefono}', '{$correo}','{$direccion}','{$ciudad}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);

				//SI SE INSERTO LA PERSONA AHORA REGISTRAMOS EL PROVEEDOR
				if($resultQueryInsert){
					$id = mysqli_insert_id($db);
					
						$queryProveedor = "INSERT into proveedor values('{$id}','{$proveedor}','{$nit}','{$tel}',1)";
							
						$resultQueryProv = mysqli_query($db,$queryProveedor);

						if($resultQueryProv){
							ProveedorResponse(1);
								//$_SESSION["insertProv"]=1;
								//header("Location:$baseUrl/proveedor.php");
								//die();
						}else{
							ProveedorResponse(0);
							//$_SESSION["insertProv"]=0;
								//header("Location:$baseUrl/proveedor.php");
								//die();
						}
				}else{
					ProveedorResponse(0);
					//$_SESSION["insertProv"]=0;
								//header("Location:$baseUrl/proveedor.php");
								//die();
				}

			//}//pidiendo el nuevo id
		}//if es un nuevo registro
		else if($_POST['send']==2) //sino es una actualizacion
		{
			try {
				$sqlUpdate = "UPDATE persona set Nombres = '{$nombre}', 
										Apellidos = '{$apellido}', Genero = '{$gender}', 
											Telefono = '{$telefono}', Correo = '{$correo}', Direccion = '{$direccion}', 
													Ciudad = '{$ciudad}'
				                where Id = '{$_POST["provID"]}'";

				$resultQueryUpdate = mysqli_query($db,$sqlUpdate);

				if($resultQueryUpdate){
					$sqlProvUpdate = "UPDATE proveedor set Nombre_Empresa = '{$proveedor}', Nit = '{$nit}', 
										Telefono_Empresa = '{$tel}' where Persona_id = '{$_POST["provID"]}'";
					$resultProvUpdate = mysqli_query($db, $sqlProvUpdate);

					if ($resultProvUpdate) {
						ProveedorResponse(2);
					}else{
						ProveedorResponse(0);
					}

				}else{
					ProveedorResponse(0);
				}

			} catch (Exception $e) {
				ProveedorResponse(0);
			}
		}
		
		
		
	}


}
 ?>
