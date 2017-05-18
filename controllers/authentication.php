<?php 
	if(isset($_POST["login"]))
	{
		sleep(1);
		session_start();
		include '/BaseUrl.php';
		include '../config.php';

		$user = $_POST["user"];
		$pass = sha1($_POST["pass"]);
		$response = false;
		$message = "";

		$auth = "SELECT * from usuario 
			where Username = '$user' and Pass = '$pass' and Enabled = 1";


		$login = mysqli_query($db, $auth);
		
		if($login && mysqli_num_rows($login) > 0){

		    $_SESSION["login"] = mysqli_fetch_assoc($login);
		    
		    if(isset($_SESSION["error_login"])){
		      unset($_SESSION["error_login"]);
		    }

		    $response = true;
		    $baseUrl = BaseUrl::getServer();

		  }
		  else{

		  	$response = false;
		  	$baseUrl = null;
		    $message = "Usuario o Contraseña inválidos";
		    		
		  }

		  

		  $response = array(
			'response' => $response,
			'message'  => $message,
			'href'     => $baseUrl,
			'function' => ''
		);

		print_r(json_encode($response));
	}
 ?>
