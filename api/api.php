<?php
	
	include_once "../includes/connect.php";

	$connect = new ConnectionDB();
	$conn = $connect->iniciarDB();

	$go = $_REQUEST["go"];


	// Dashboard - Inicio
	if ($go == "bar") {
		$query = "SELECT * FROM lista_socio_tipo";
		$res = $conn->query($query);
		$row = array();
		while($data = $res->fetch_array(PDO::FETCH_ASSOC)){
			$row [] = $data;
		}
		print_r(json_encode($row));
	}

	if ($go == "pie") {
		$query = "SELECT * FROM lista_tractor_modelo";
		$res = $conn->query($query);
		$row = array();
		while($data = $res->fetch_array(PDO::FETCH_ASSOC)){
			$row [] = $data;
		}
		print_r(json_encode($row));
	}

	if ($go == "semi-c") {
		$query = "SELECT * FROM lista_bovino_raza";
		$res = $conn->query($query);
		$row = array();
		while($data = $res->fetch_array(PDO::FETCH_ASSOC)){
			$row [] = $data;
		}
		print_r(json_encode($row));
	}
