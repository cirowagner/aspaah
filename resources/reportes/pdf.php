<?php
	include_once "../../fpdf/fpdf.php";
	include_once "../../includes/connect.php";
  	
  	$connect = new ConnectionDB();
  	$conn = $connect->iniciarDB();

  	$query = "SELECT * FROM lista_socios";
  	$res = $conn->query($query);


  	$pdf = new FPDF("P", "mm", "letter");
  	$pdf->AddPage();
  	$pdf->SetFont("Arial", "B", 12);
  	$pdf->Cell(0, 5, "REPORTE SOCIOS", 0, 1, "C");

	$pdf->Ln(5);

	$pdf->SetFont("Arial", "B", 9);
	$pdf->Cell(10, 5, "#ID", 1, 0, "C");
	$pdf->Cell(20, 5, "Nombres", 1, 0, "C");
	$pdf->Cell(30, 5, "Apellidos", 1, 0, "C");
	$pdf->Cell(15, 5, "DNI", 1, 0, "C");
	$pdf->Cell(20, 5, "Nacimiento", 1, 0, "C");
	$pdf->Cell(45, 5, "Correo", 1, 0, "C");
	$pdf->Cell(30, 5, utf8_decode("Dirección"), 1, 0, "C");
	$pdf->Cell(25, 5, "Celular", 1, 1, "C");

	$pdf->SetFont("Arial", "", 8);
	while($data = $res->fetch_array()){
		$pdf->Cell(10, 5, $data[0], 1, 0, "C");
		$pdf->Cell(20, 5, $data[1], 1, 0, "C");
		$pdf->Cell(30, 5, $data[2], 1, 0, "C");
		$pdf->Cell(15, 5, $data[3], 1, 0, "C");
		$pdf->Cell(20, 5, $data[4], 1, 0, "C");
		$pdf->Cell(45, 5, $data[5], 1, 0, "C");
		$pdf->Cell(30, 5, $data[6], 1, 0, "C");
		$pdf->Cell(25, 5, $data[7], 1, 1, "C");
	}

  	$pdf->Output();