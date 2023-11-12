<?php
require('fpdf/fpdf.php'); // Reemplaza 'fpdf/' con la ruta correcta a la biblioteca FPDF

include 'global/conexion.php';
include 'carrito.php';
include 'global/templates/cabecera.php';

// ... Código previo ...

if ($_POST) {
    $total = 0;
    $SID = session_id();
    $Correo = $_POST['email'];

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']);
    }

    // Insertar la venta en la base de datos
    $sentencia = $conexion->prepare("insert into 
    tblVentas(ClaveTransaccion,Fecha,Correo,Total,status,id_usuario) 
    values (:ClaveTransaccion ,NOW(),:Correo,:total,'pendiente',:usuario);");

    // ... Código de inserción ...

    // Generar el PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Detalle de la Compra');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(40, 10, 'Fecha: ' . date('Y-m-d H:i:s'));
    $pdf->Ln(10);

    // Agregar detalles de la compra
    $pdf->Cell(40, 10, 'Detalles de la compra:');
    $pdf->Ln(10);

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
        $pdf->Cell(0, 10, $producto['NOMBRE'] . ' x' . $producto['CANTIDAD'] . ' = $' . ($producto['PRECIO'] * $producto['CANTIDAD']));
        $pdf->Ln(10);
    }

    $pdf->Cell(40, 10, 'Total: $' . $total);

    // Guardar el PDF en un archivo
    $pdfFilePath = 'pdfs/comprobante.pdf';
    $pdf->Output($pdfFilePath, 'F');

    // Enviar el PDF por correo electrónico
    $subject = 'Comprobante de compra';
    $message = 'Gracias por su compra. Adjunto encontrará el comprobante de su compra.';
    $headers = 'From: tu_correo@dominio.com' . "\r\n";

    // Adjuntar el PDF al correo
    $pdfData = file_get_contents($pdfFilePath);

    $separator = md5(time());
    $eol = PHP_EOL;

    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;

    $message = "--" . $separator . $eol;
    $message .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
    $message .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
    $message .= $message . $eol;

    $message .= "--" . $separator . $eol;
    $message .= "Content-Type: application/octet-stream; name=\"comprobante.pdf\"" . $eol;
    $message .= "Content-Transfer-Encoding: base64" . $eol;
    $message .= "Content-Disposition: attachment" . $eol . $eol;
    $message .= base64_encode($pdfData) . $eol . $eol;

    $message .= "--" . $separator . "--";

    mail($Correo, $subject, $message, $headers);

    // Eliminar el archivo PDF generado
    unlink($pdfFilePath);
}

include 'global/templates/pie.php';


?>


<html>

<h1 style="color: #333;">¡Gracias por comprar en BlenderPosting!</h1>
</html>
