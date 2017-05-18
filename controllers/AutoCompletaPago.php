<?php
include '../includes/redirect.php';
include '../config.php';

$query = "SELECT Id, Forma from formapago order by Forma asc";



$query_pago = mysqli_query($db,$query);

		print_r(json_encode(
		            mysqli_fetch_all($query_pago,MYSQLI_ASSOC)
		        ));
?>