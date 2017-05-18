<?php
include '../includes/redirect.php';
include '../config.php';

$search = $_POST['criterio'];


$query = "SELECT C.Persona_Id as id, Concat(P.Nombres,' ',P.Apellidos) as Nombre
					from cliente as C join persona as P 
						on C.Persona_Id = P.Id
							WHERE P.Nombres 
								LIKE '%$search%' 
									ORDER BY P.Nombres Asc";



$query_services = mysqli_query($db,$query);

		print_r(json_encode(
		            mysqli_fetch_all($query_services,MYSQLI_ASSOC)
		        ));
?>