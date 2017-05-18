<?php 

include '/BaseUrl.php';

function AtributoResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertAtributo"]=1;
		}else if($result == 0){
			$_SESSION["insertAtributo"]=0;
		}
		header("Location: $baseUrl/producto.php");

	}
 ?>

<?php 
if(isset($_POST['addAtributo'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	$atributo = "";

		if(isset($_POST['atributo'])){ $atributo = $_POST['atributo']; }

		if($_POST['send']==1){
			$lastId = "SELECT max(Id) as id from atributo";
			$resultLastId = mysqli_query($db,$lastId);
			if($resultLastId)
			{
				$arrayId = mysqli_fetch_array($resultLastId);
				$id = $arrayId["id"] + 1;

				$queryInsert = "INSERT into atributo
									values('{$id}','{$atributo}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);
				if($resultQueryInsert){
							AtributoResponse(1);
								
						}else{
							AtributoResponse(0);
						}
		
			}

		}


	}
 ?>
