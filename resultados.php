<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Contenido de la página aquí -->
</body>
</html>



<?php
include 'global/conexion.php';
include 'global/templates/cabecera.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesar el formulario cuando se envía
    $fecha_inicial = $_POST['fecha_inicial'];
    $fecha_final = $_POST['fecha_final'];

    try {
        // Utilizar la conexión a la base de datos desde el archivo conexion.php
        $sql = "SELECT fecha, articulo, COUNT(*) AS cantidad FROM tblventas tv 
        JOIN tbldetalleventa tdv ON tv.idventa = tdv.idventa 
        WHERE tv.fecha BETWEEN :fecha_inicial AND :fecha_final 
        GROUP BY fecha, articulo";

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':fecha_inicial', $fecha_inicial);
        $stmt->bindParam(':fecha_final', $fecha_final);
        $stmt->execute();

        // Obtener los resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}
?>

<h2>Selecciona un rango de fechas</h2>

<form method="POST">
    <label for="fecha_inicial">Fecha Inicial:</label>
    <input type="date" name="fecha_inicial" required>
    <br>
    <label for "fecha_final">Fecha Final:</label>
    <input type="date" name="fecha_final" required>
    <br>
    <button type="submit">Generar Gráfico</button>
</form>

<div>
    <h3>Gráfico de ventas</h3>
    <canvas id="grafico"></canvas>
</div>

<script>
// Procesar los datos obtenidos de la consulta PHP
var datos = <?php echo json_encode($resultados); ?>;

// Crear un objeto para agrupar los datos por fecha y artículo
var datosAgrupados = {};

datos.forEach(function(item) {
    if (!datosAgrupados[item.fecha]) {
        datosAgrupados[item.fecha] = {};
    }
    datosAgrupados[item.fecha][item.articulo] = item.cantidad;
});

// Extraer etiquetas (fechas) y datos (cantidad de ventas) para el gráfico
var etiquetas = Object.keys(datosAgrupados);
var datasets = [];

for (var articulo in datosAgrupados[etiquetas[0]]) {
    var dataset = {
        label: articulo,
        data: etiquetas.map(function(fecha) {
            return datosAgrupados[fecha][articulo] || 0;
        })
    };
    datasets.push(dataset);
}

// Crear el gráfico con Chart.js
var ctx = document.getElementById('grafico').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: etiquetas,
        datasets: datasets
    },
    options: {
        responsive: true,
        scales: {
            x: {
                stacked: true
            },
            y: {
                stacked: true
            }
        }
    }
});
</script>

</body>
</html>
