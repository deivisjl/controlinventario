<?php 

include '/BaseUrl.php';

function TipoResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertTipo"]=1;
		}else if($result == 0){
			$_SESSION["insertTipo"]=0;
		}
		header("Location: $baseUrl/producto.php");

	}
 ?>

<?php 
if(isset($_POST['addTipo'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	$tipo = "";

		if(isset($_POST['tipo'])){ $tipo = $_POST['tipo']; }

		if($_POST['send']==1){
			$lastId = "SELECT max(Id) as id from tipo";
			$resultLastId = mysqli_query($db,$lastId);
			if($resultLastId)
			{
				$arrayId = mysqli_fetch_array($resultLastId);
				$id = $arrayId["id"] + 1;

				$queryInsert = "INSERT into tipo
									values('{$id}','{$tipo}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);
				if($resultQueryInsert){
							TipoResponse(1);
								
						}else{
							TipoResponse(0);
						}
		
			}

		}


	}
 ?>
