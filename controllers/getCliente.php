<?php 

include '/BaseUrl.php';
//ALTER TABLE `cliente` CHANGE `DPI` `DPI` VARCHAR(16) NULL DEFAULT NULL;
function ClienteResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertCliente"]=1;
		}else if($result == 0){
			$_SESSION["insertCliente"]=0;
		}else if($result == 2){
			$_SESSION["insertCliente"]=2;
		}
		header("Location: $baseUrl/cliente.php");
	}
 ?>

<?php 
if(isset($_POST['addCliente'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();

	$id = "";
	$dpi = "";
	$nombre = "";
	$apellido = "";
	$gender = "";
	$telefono = "";
	$correo = "";
	$direccion = "";
	$ciudad = "";
	$fecha = date("Y-m-d");

		if (isset($_POST['codigo']) && !empty($_POST['codigo'])) { $id = $_POST['codigo'];}

		if (isset($_POST['dpi']) && !empty($_POST['dpi'])) { $dpi = $_POST['dpi'];}		

		if(isset($_POST['nombre']) && !empty($_POST['nombre'])){$nombre = $_POST['nombre'];}

		if(isset($_POST['apellido']) && !empty($_POST['apellido'])){$apellido = $_POST['apellido'];}

		if(isset($_POST['gender'])){ $gender = $_POST['gender'] == 1 ? "M" : "F"; }

		if(isset($_POST['telefono'])){ if(empty($_POST['telefono'])){ $telefono = 00; }else{ $telefono = $_POST['telefono'];} }

		if(isset($_POST['correo']) && !empty($_POST['correo'])){ $correo = $_POST['correo']; }

		if(isset($_POST['direccion']) && !empty($_POST['direccion'])){ $direccion = $_POST['direccion']; }

		if(isset($_POST['ciudad']) && !empty($_POST['ciudad'])){ $ciudad = $_POST['ciudad']; }

		

		

		if($_POST['send']==1){
			//$lastId = "SELECT max(Id) as id from persona";
			//$resultLastId = mysqli_query($db,$lastId);
			//if($resultLastId)
			//{
				//$arrayId = mysqli_fetch_array($resultLastId);
				//$id = $arrayId["id"] + 1;

				$queryInsert = "INSERT into persona
									values(NULL,'{$nombre}',
											'{$apellido}', '{$gender}',
											'{$telefono}', '{$correo}','{$direccion}','{$ciudad}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);

				//SI SE INSERTO LA PERSONA AHORA REGISTRAMOS EL CLIENTE
				if($resultQueryInsert){
					$id = mysqli_insert_id($db);

						$queryCliente = "INSERT into cliente values('{$id}','{$dpi}','{$fecha}')";
							
						$resultQueryCliente = mysqli_query($db,$queryCliente);


						if($resultQueryCliente){
							ClienteResponse(1);
						}else{
							ClienteResponse(0);
						}
				}else{
					ClienteResponse(0);
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
				                where Id = '{$id}'";

				$resultQueryUpdate = mysqli_query($db,$sqlUpdate);

				if($resultQueryUpdate){
					$sqlClienteUpdate = "UPDATE cliente set DPI = '{$dpi}'
										 where Persona_Id = '{$id}'";
					$resultClienteUpdate = mysqli_query($db, $sqlClienteUpdate);

					if ($resultClienteUpdate) {
						ClienteResponse(2);
					}else{
						ClienteResponse(0);
					}

				}else{
					ClienteResponse(0);
				}

			} catch (Exception $e) {
				ClienteResponse(0);
			}
		}
		
		
		
	}

 ?>
