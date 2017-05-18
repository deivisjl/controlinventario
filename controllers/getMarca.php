<?php 

include '/BaseUrl.php';

function MarcaResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertMarca"]=1;
		}else if($result == 0){
			$_SESSION["insertMarca"]=0;
		}
		header("Location: $baseUrl/producto.php");

	}
 ?>

<?php 
if(isset($_POST['addMarca'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	$marca = "";

		if(isset($_POST['marca'])){ $marca = $_POST['marca']; }

		if($_POST['send']==1){
			$lastId = "SELECT max(Id) as id from marca";
			$resultLastId = mysqli_query($db,$lastId);
			if($resultLastId)
			{
				$arrayId = mysqli_fetch_array($resultLastId);
				$id = $arrayId["id"] + 1;

				$queryInsert = "INSERT into marca
									values('{$id}','{$marca}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);
				if($resultQueryInsert){
							MarcaResponse(1);
								
						}else{
							MarcaResponse(0);
						}
		
			}

		}


	}
 ?>
