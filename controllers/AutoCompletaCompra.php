<?php
include '../includes/redirect.php';
include '../config.php';

$search = $_POST['criterio'];


$query = "SELECT P.Id, 
					concat(C.Nombre_Categoria,' ',M.Nombre_Marca,' ',A.Nombre,' ',T.Nombre_Atributo,' ',P.Caracteristica) as Nombre,
						R.Nombre_Empresa as Proveedor 
					FROM producto as P join Categoria as c
						on P.Categoria_Id = C.Id
						  	inner join marca as M
						  		on P.Marca_Id = M.Id
						  			inner join cantidad as A
						  				on P.Cantidad_Id = A.Id
						  					inner join atributo as T
						  						on P.Atributo_Id = T.Id
						  							inner join proveedor as R
						  								on P.Proveedor_Id = R.Persona_Id

					WHERE C.Nombre_Categoria 
					LIKE '%$search%' 
					ORDER BY C.Nombre_Categoria  Asc";



$query_services = mysqli_query($db,$query);

		print_r(json_encode(
		            mysqli_fetch_all($query_services,MYSQLI_ASSOC)
		        ));
?>