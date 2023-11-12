<?php
require('fpdf/fpdf.php');
include 'global/conexion.php';

$idventa = $_GET['idventa'];

// Realiza una consulta para obtener el ID de venta y los detalles de la venta
$sentenciaDetalle = $conexion->prepare("select idventa, articulo, cantidad, preciounitario from tbldetalleventa where idventa = :idventa");
$sentenciaDetalle->bindParam(':idventa', $idventa);
$sentenciaDetalle->execute();
$detallesVenta = $sentenciaDetalle->fetchAll(PDO::FETCH_ASSOC);

// Calcula la suma de los precios unitarios
$sumaPreciosUnitarios = 0;
foreach ($detallesVenta as $detalle) {
    $sumaPreciosUnitarios += $detalle['preciounitario'];
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// URL de la imagen
$imagenURL = 'https://www.blender.org/wp-content/uploads/2020/07/blender_logo_no_socket_black.png';

// Calcula la posición para centrar la imagen
$anchoPagina = $pdf->GetPageWidth();
$anchoImagen = 100; // Ancho deseado de la imagen
$xImagen = ($anchoPagina - $anchoImagen) / 2;

// Muestra la imagen centrada
$pdf->Image($imagenURL, $xImagen, 10, $anchoImagen, 0); // Cambia los valores según tus preferencias
$pdf->Ln(40); // Agrega un espacio después de la imagen

// Obtén el ID de compra
$idCompra = $detallesVenta[0]['idventa'];

// Muestra el ID de compra centrado
$pdf->Cell(0, 10, 'Numero de Compra: ' . $idCompra, 0, 1, 'C'); // Alinea al centro
$pdf->Ln(10); // Agrega un espacio entre el ID de compra y la tabla

// Calcula el ancho de la página
$anchoPagina = $pdf->GetPageWidth();

// Calcula el ancho de la tabla
$anchoTabla = array_sum([30, 30, 40]); // Suma de los anchos de las celdas

// Centra la tabla en la página
$x = ($anchoPagina - $anchoTabla) / 2;

// Cabecera de la tabla centrada
$pdf->SetX($x);
$pdf->SetFillColor(192, 192, 192); // Color de fondo gris claro
$pdf->SetTextColor(0, 0, 0); // Color de texto negro

// Agrega los detalles de la venta en una tabla centrada con colores en las filas de título
$pdf->Cell(30, 10, 'Articulo', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Precio Unitario', 1, 1, 'C', 1);

$pdf->SetFillColor(255, 255, 255); // Restaura el color de fondo a blanco
$pdf->SetTextColor(0, 0, 0); // Restaura el color de texto a negro

// Agrega los detalles de la venta en una tabla centrada sin colores en las filas de datos
foreach ($detallesVenta as $detalle) {
    $pdf->SetX($x);
    $pdf->Cell(30, 10, $detalle['articulo'], 1, 0, 'C');
    $pdf->Cell(30, 10, $detalle['cantidad'], 1, 0, 'C');
    $pdf->Cell(40, 10, $detalle['preciounitario'], 1, 1, 'C');
}

// Muestra la suma de los precios unitarios al final
$pdf->SetX($x);
$pdf->Cell(60, 10, 'Total :', 1, 0, 'C');
$pdf->Cell(40, 10, $sumaPreciosUnitarios, 1, 1, 'C');

$pdf->Output();

?>
