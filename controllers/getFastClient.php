<?php 
	include '../includes/redirect.php';
		include '../config.php';

	$nombre = $_POST["nombre"]; 
	$apellido = $_POST["apellido"];
	$dpi = $_POST["dpi"];
	$fecha = date("Y-m-d");
	$result = [];

	guardar($nombre,$apellido,$dpi,$fecha,$db);

	function guardar($nombre, $apellido, $dpi,$fecha,$db){
		
		try {
			//$lastId = "SELECT max(Id) as id from persona";
			//$resultLastId = mysqli_query($db,$lastId);
			//if($resultLastId){
				//$arrayId = mysqli_fetch_array($resultLastId);
				//$id = $arrayId["id"] + 1;

				$queryFastPeople = "INSERT into persona(Id,Nombres,Apellidos)
							values(NULL,'{$nombre}','{$apellido}')";

				$resultFast = mysqli_query($db,$queryFastPeople);


				if ($resultFast) {
					$id = mysqli_insert_id($db);

					$queryCliente = "INSERT into cliente values('{$id}','{$dpi}','{$fecha}')";

					$resultCliente = mysqli_query($db,$queryCliente);

					verificarResultado($resultCliente,$id,$nombre,$apellido);
				}
			//}
		} catch (Exception $e) {
			$msj = false;
			verificarResultado($msj);
		}
	}

	function verificarResultado($info,$id = null,$nombre = null, $apellido = null){
		if (!$info) {
			$result["resp"] = "ERROR";
		}else{
			$result["resp"] = $id;
			$result["client"] = $nombre." ".$apellido;
		}
		echo json_encode($result);
	}
 ?>