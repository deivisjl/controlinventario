<?php 

include '/BaseUrl.php';

function UsuarioResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertUser"]=1;
		}else if($result == 0){
			$_SESSION["insertUser"]=0;
		}else if($result == 2){
			$_SESSION["insertUser"]=2;
		}
		header("Location: $baseUrl/usuarios.php");

	}

 ?>

<?php 
if(isset($_POST['addusuario'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	$id = "";
	$username = "";
	$pass = "";
	$newpass = "";
	$rol_id = "";
	$nombre = "";
	$apellido = "";
	$gender = "";
	$telefono = "";
	$correo = "";
	$direccion = "";
	$ciudad = "";
	


		

		if(isset($_POST['username'])){$username = $_POST['username'];}

		if(isset($_POST['pass'])){ $pass = $_POST['pass'];}
		if(isset($_POST['pass2'])){ $pass2 = $_POST['pass2'];}

		
		if(isset($_POST['rol_id'])){ $rol_id = $_POST['rol_id']; }

		if(isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}

		if(isset($_POST['tel'])){ $tel = $_POST['tel'];}

		if(isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}

		if(isset($_POST['apellido'])){ $apellido = $_POST['apellido']; }

		if(isset($_POST['gender'])){ $gender = $_POST['gender'] == 1 ? "M" : "F"; }

		if(isset($_POST['direccion'])){ $direccion = $_POST['direccion']; }
		if(isset($_POST['ciudad'])){ $ciudad = $_POST['ciudad']; }

		if(isset($_POST['telefono'])){ if(empty($_POST['telefono'])){ $telefono = 00; }else{ $telefono = $_POST['telefono'];} }

		if(isset($_POST['correo'])){ $correo = $_POST['correo']; }


		if($_POST['send']==1){
			//$lastId = "SELECT max(Id) as id from persona";
			//$resultLastId = mysqli_query($db,$lastId);
			//if($resultLastId)
			//{
				//COMO EL USUARIO EXTIENDE DE PERSONA PRIMERO INSERTAMOS LA PERSONA PIDIENDO UN NUEVO ID
				//$arrayId = mysqli_fetch_array($resultLastId);
				//$id = $arrayId["id"] + 1;				

				$queryInsert = "INSERT into persona
									values(NULL,'{$nombre}',
											'{$apellido}', '{$gender}',
											'{$telefono}', '{$correo}','{$direccion}','{$ciudad}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);				


				//SI SE INSERTO LA PERSONA AHORA REGISTRAMOS EL USUARIO
				if($resultQueryInsert){
					$id = mysqli_insert_id($db);

						$queryUsuario = "INSERT into usuario values('{$id}','{$username}','".sha1($pass)."',1,'{$rol_id}')";
							
						$resultQueryUser = mysqli_query($db,$queryUsuario);

						if($resultQueryUser){
							UsuarioResponse(1);	
						}else{
							UsuarioResponse(0);
						}
				}else{
					
					UsuarioResponse(0);
				}


			//}//pidiendo el nuevo id
		}//if es un nuevo registro
		else if($_POST['send']==2) //sino es una actualizacion
		{
			try {
				$sqlUpdate = "UPDATE persona set Nombres = '{$nombre}', 
										Apellidos = '{$apellido}', Genero = '{$gender}', 
											Telefono = '{$telefono}', Correo = '{$correo}', Direccion = '{$direccion}', Ciudad = '{$ciudad}'
				                where Id = '{$_POST["Persona_Id"]}'";

				$resultQueryUpdate = mysqli_query($db,$sqlUpdate);

				if($resultQueryUpdate){
					$sqlProvUpdate = "UPDATE usuario set Username = '{$username}', 
										Rol_Id = '{$_POST["tipo"]}' where Persona_Id = '{$_POST["Persona_Id"]}'";
					$resultProvUpdate = mysqli_query($db, $sqlProvUpdate);

					if ($resultProvUpdate) {
						UsuarioResponse(2);
					}else{
						UsuarioResponse(0);
					}

				}else{
					UsuarioResponse(0);
				}

			} catch (Exception $e) {
				UsuarioResponse(0);
			}
		}

		else if($_POST['send']==3) //sino es una actualizacion de pass
		{

			try {
				$nuevaPass = sha1($_POST['pass2']);
				$userCurrent = $_SESSION["login"]["Persona_Id"];
				$updatePass = "UPDATE usuario set Pass='{$nuevaPass}' where Persona_Id = $userCurrent ";
				
				$resultPass = mysqli_query($db,$updatePass);


				if($resultPass){
					$_SESSION["insertUser"]=1;
							header("Location: $baseUrl/actualizarPass.php");
					
				}else{
					$_SESSION["insertUser"]=0;
							header("Location: $baseUrl/actualizarPass.php");
					
				}

			} catch (Exception $e) {
				
				header("Location: $baseUrl");
			}
		}

		
		
		
	}



 ?>
