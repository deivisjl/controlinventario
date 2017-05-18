<?php
	// Inicio sesiones
session_start();
//Logout
if(isset($_SESSION["login"])){
	include '/controllers/BaseUrl.php';
	unset($_SESSION["login"]);
	
	$baseUrl = BaseUrl::getServer();
	header("Location: $baseUrl");
}
?>