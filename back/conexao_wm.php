<?php
	//Conexão com o Banco de Dados
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "bd_wm";
	
	$conn = new mysqli($servername, $username, $password, $database);
	mysqli_set_charset( $conn, 'utf8');
	if ($conn->connect_error){
 		die("Connection failed: " . $conn->connect_error);
	}	
//	echo "Conectado";
?>