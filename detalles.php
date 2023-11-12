<?php
require('fpdf/fpdf.php');
include 'global/conexion.php';

if (isset($_GET['venta'])) {
    $ventaId = $_GET['venta'];
    
    // Realiza una consulta SQL para obtener los detalles de la venta
    $sql = "SELECT articulo, cantidad, preciounitario FROM tbldetalleventa WHERE idventa = :ventaId";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(':ventaId', $ventaId, PDO::PARAM_INT);
    $sentencia->execute();
    $detallesVenta = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    // Crea un nuevo objeto PDF para el detalle
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

    // Agrega los detalles de la venta al PDF
    foreach ($detallesVenta as $detalle) {
        $pdf->Cell(100, 10, $detalle['articulo'], 1);
        $pdf->Cell(40, 10, $detalle['cantidad'], 1);
        $pdf->Cell(50, 10, '$' . $detalle['preciounitario'], 1);
        $pdf->Ln();
    }

    // Envía el PDF al navegador
    $pdf->Output();
} else {
    echo "Parámetro 'venta' no proporcionado.";
}
