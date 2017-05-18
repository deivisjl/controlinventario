<?php 

include '/BaseUrl.php';

function CategoriaResponse($result){

		$baseUrl = BaseUrl::getServer();

		if($result == 1){
			$_SESSION["insertCategoria"]=1;
		}else if($result == 0){
			$_SESSION["insertCategoria"]=0;
		}
		header("Location: $baseUrl/producto.php");

	}
 ?>

<?php 
if(isset($_POST['addCategoria'])){
		include '../includes/redirect.php';
		include '../config.php';

	$baseUrl = BaseUrl::getServer();
	$categoria = "";

		if(isset($_POST['categoria'])){ $categoria = $_POST['categoria']; }

		if($_POST['send']==1){
			$lastId = "SELECT max(Id) as id from categoria";
			$resultLastId = mysqli_query($db,$lastId);
			if($resultLastId)
			{
				$arrayId = mysqli_fetch_array($resultLastId);
				$id = $arrayId["id"] + 1;

				$queryInsert = "INSERT into categoria
									values('{$id}','{$categoria}')";
			
				$resultQueryInsert = mysqli_query($db,$queryInsert);
				if($resultQueryInsert){
							CategoriaResponse(1);
								
						}else{
							CategoriaResponse(0);
						}
		
			}

		}


	}
 ?>
