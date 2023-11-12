<?php


include 'global\conexion.php';


$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$desc = $_POST['descripcion'];

$imagen = $_FILES['imagen']['name'];
$archivo =$_FILES['imagen']['tmp_name'];



$ruta = "productos";


$ruta = $ruta."/".$imagen;

move_uploaded_file($archivo,$ruta);



$sentencia = $conexion->prepare(
"
insert into productos
(nombre,precio,descripcion,imagen) 
values ('                 ".$nombre."',  ".$precio."    ,'".$desc."','".$imagen."      '   );"

);
 $sentencia->execute();


if($sentencia){
    header("Location: index.php");
}



?>