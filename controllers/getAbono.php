<?php 
	include '../includes/redirect.php';
	include '../config.php';

	$deuda = $_POST["deuda"];
	$factura = $_POST["factura"]; 
	$monto = $_POST["monto"];
	$fecha = date("Y-m-d");
	$usuario = $_SESSION["login"]["Persona_Id"];
	$result = [];
	$info = false;
	 
	try {

		$sqlPago = "INSERT into pagodeuda values(NULL,'{$deuda}','{$usuario}','{$fecha}','{$monto}')";
		mysqli_autocommit($db, FALSE);
		if ($info = mysqli_query($db, $sqlPago)) {
			mysqli_commit($db);
		}else{
			throw new Exception('Ocurrió un error al realizar la transacción.');
		}
		
		mysqli_close($db);
		verificarResultado($info);

	} catch (Exception $e) {
		$info = false;
	    mysqli_rollback($db);
	    verificarResultado($info,$e->getMessage());
	}

	function verificarResultado($info,$error = null){
		if (!$info) {
			$result["resp"] = "ERROR";
			$result["msj"] = $error;
		}else{
			$result["resp"] = "EXITO";
		}
		echo json_encode($result);
	}
 ?>

 