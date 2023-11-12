<?php


include 'global\conexion.php';


$nombre = $_POST['nombre'];





$sentencia = $conexion->prepare("

delete from productos where nombre  = '".$nombre."' ");
 $sentencia->execute();

 if($sentencia){
    header("Location: index.php");
}




?>