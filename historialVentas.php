



<?php
session_start();
require('fpdf/fpdf.php');
include 'global/conexion.php';

// header('Content-Disposition: attachment; filename="Historialf"');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('https://download.blender.org/branding/blender_logo.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Título
        $this->Cell(0, 10, 'Historial de compras', 0, 1, 'C'); // Ancho igual al ancho de página, salto de línea
        // Salto de línea
        $this->Ln(20);

        // Establece el color de fondo y el color de texto para la fila de los títulos
        $this->SetFillColor(192, 192, 192); // Color de fondo gris claro
        $this->SetTextColor(0, 0, 0); // Color de texto negro
        // Cabecera de la tabla
        $this->Cell(40, 10, 'usuario', 1, 0, 'C', 1);
        $this->Cell(40, 10, 'fecha', 1, 0, 'C', 1);
        $this->Cell(30, 10, 'venta', 1, 0, 'C', 1);
        $this->Cell(40, 10, 'total', 1, 0, 'C', 1);
        $this->Cell(40, 10, 'ver detalle', 1, 1, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);

$usuarioperfil = $_SESSION['id_usuario'];

$sentencia = $conexion->prepare("select usuario,fecha, idventa, total from usuarios u join tblventas tv on u.id_usuario = tv.id_usuario  where u.id_usuario =  '$usuarioperfil'");
$sentencia->execute();
$listaVentas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

// Calcula el ancho de la página
$anchoPagina = $pdf->GetPageWidth();
$anchoCelda = 40; // Ancho uniforme para todas las celdas

// Calcula la posición X para centrar la tabla
$xTabla = ($anchoPagina - ($anchoCelda * 5)) / 2;

$pdf->SetX($xTabla);

$pdf->SetFillColor(255, 255, 255); // Restaura el color de fondo a blanco
$pdf->SetTextColor(0, 0, 0); // Restaura el color de texto a negro

foreach ($listaVentas as $tabla) {
    $pdf->SetX($xTabla);
    $pdf->Cell($anchoCelda, 10, $tabla['usuario'], 1, 0, 'C');
    $pdf->Cell($anchoCelda, 10, $tabla['fecha'], 1, 0, 'C');
    $pdf->Cell($anchoCelda, 10, $tabla['idventa'], 1, 0, 'C');
    $pdf->Cell($anchoCelda, 10, $tabla['total'], 1, 0, 'C');
    $urlDetalleVenta = 'pdf_detalle.php?idventa=' . $tabla['idventa'];
    $pdf->Cell($anchoCelda, 10, 'Descargar PDF', 1, 0, 'C', false, $urlDetalleVenta); // Enlace
    $pdf->Ln(); // Salto de línea entre las filas de datos
}

$pdf->Output();
    