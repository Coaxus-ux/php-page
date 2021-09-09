<?php
    $host = 'localhost';
	$user = 'user';
	$password = '1234';
	$database = 'inventarios';
	$connection = @mysqli_connect($host, $user, $password, $database);

	if(!$connection){
		echo "Error en la conección";
	}
?>