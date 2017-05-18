<?php 

include '/BaseUrl.php';

function CantidadResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertCantidad"]=1;
		}else if($result == 0){
			$_SESSION["insertCantidad"]=0;
		}
		header("Location: $baseUrl/producto.php");

	}
 ?>

<?php 
if(isset($_POST['addCantidad'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	$cantidad = "";

		if(isset($_POST['cantidad'])){ $cantidad = $_POST['cantidad']; }

		if($_POST['send']==1){
			$lastId = "SELECT max(Id) as id from cantidad";
			$resultLastId = mysqli_query($db,$lastId);
			if($resultLastId)
			{
				$arrayId = mysqli_fetch_array($resultLastId);
				$id = $arrayId["id"] + 1;

				$queryInsert = "INSERT into cantidad
									values('{$id}','{$cantidad}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);
				if($resultQueryInsert){
							CantidadResponse(1);
								
						}else{
							CantidadResponse(0);
						}
		
			}

		}


	}
 ?>
