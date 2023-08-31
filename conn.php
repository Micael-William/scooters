<?php

function conecta(){



	$conn_host = "";

	//$conn_host = "191.252.123.75";

	$conn_banco = "";

	$conn_user = "t";

	$conn_senha = ""; 



	try {

	  $conn = new PDO("mysql:dbname=$conn_banco;host=$conn_host",$conn_user,$conn_senha);

	  $conn->exec("set names utf8");

	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} 

	catch(PDOException $e) {

		echo 'Erro: '.$e->getMessage();

	}



	return $conn;

}

function fecha_conn(){

	unset($conn);

}

?>
