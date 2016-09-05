<?php

function conectar(){
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "jokedb";
	
	try {
		$opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$pdo = new PDO("mysql:host=localhost;dbname=jokedb;", "root", "", $opcoes);
	} catch (Exception $e) {
		echo $e->getMessage();
	}

	return $pdo;

}

?>