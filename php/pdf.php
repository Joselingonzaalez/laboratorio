<?php
include 'conexion.php';
require('FPDF/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Movernos a la derecha
    $this->Cell(46);
    // Título
    $this->Cell(100,9,' Consulta Express: Reporte Medico',1,0,'C');
    // Salto de línea
    $this->Ln(50);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$sql_select_pdf = "SELECT * FROM respuesta_informe WHERE estado_envio = 'enviar';";
$sql_select_pdf_ejecutar = mysqli_query($conexion, $sql_select_pdf) or die('Error: ' . $mysqli_error($conexion));
$sql_select_pdf_array = mysqli_fetch_array($sql_select_pdf_ejecutar);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(70,10,utf8_decode('Información del Paciente'), 0, 1, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['nombre_paciente']), 1, 0, 'C', 0);
$pdf->Cell(30,10,utf8_decode('Cedula:'), 1, 0, 'C', 0);
$pdf->Cell(65,10,utf8_decode($sql_select_pdf_array['cedula_paciente']), 1, 1, 'C', 0);
$pdf->Cell(60,10,utf8_decode('Correo Electrónico:'), 1, 0, 'C', 0);
$pdf->Cell(130,10,utf8_decode($sql_select_pdf_array['correo_paciente']), 1, 1, 'C', 0);
$pdf->Cell(50,10,utf8_decode('Examen Medico:'), 1, 0, 'C', 0);
$pdf->Cell(140,10,utf8_decode($sql_select_pdf_array['tipo_examen']), 1, 1, 'C', 0);
$pdf->Cell(50,10,utf8_decode(''), 0, 1, 'C', 0);

$pdf->Cell(70,10,utf8_decode('Información del Enfermero'), 0, 1, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['nombre_enfermero']), 1, 0, 'C', 0);
$pdf->Cell(30,10,utf8_decode('Cedula:'), 1, 0, 'C', 0);
$pdf->Cell(65,10,utf8_decode($sql_select_pdf_array['cedula_enfermero']), 1, 1, 'C', 0);
$pdf->Cell(60,10,utf8_decode('Correo Electrónico:'), 1, 0, 'C', 0);
$pdf->Cell(130,10,utf8_decode($sql_select_pdf_array['correo_enfermero']), 1, 1, 'C', 0);
$pdf->Cell(50,10,utf8_decode(''), 0, 1, 'C', 0);

$pdf->Cell(70,10,utf8_decode('Información del Medico'), 0, 1, 'C', 0);
$pdf->Cell(40,10,utf8_decode('Nombre:'), 1, 0, 'C', 0);
$pdf->Cell(55,10,utf8_decode($sql_select_pdf_array['nombre_medico']), 1, 0, 'C', 0);
$pdf->Cell(30,10,utf8_decode('Cedula:'), 1, 0, 'C', 0);
$pdf->Cell(65,10,utf8_decode($sql_select_pdf_array['cedula_medico']), 1, 1, 'C', 0);
$pdf->Cell(60,10,utf8_decode('Correo Electrónico:'), 1, 0, 'C', 0);
$pdf->Cell(130,10,utf8_decode($sql_select_pdf_array['correo_medico']), 1, 1, 'C', 0);
$pdf->Cell(50,90,utf8_decode(''), 0, 2, 'C', 0);
$pdf->Cell(190,10,utf8_decode('Diagnostico:'), 1, 1, 'C', 0);
$pdf->Cell(190,185,utf8_decode($sql_select_pdf_array['diagnostico']), 1, 0, 'm', 0);

$pdfdoc = $pdf->Output('', 'S');
?>