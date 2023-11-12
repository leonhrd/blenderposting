<?php
include 'global\conexion.php';

$mensajeError = "";

if (isset($_POST['submit'])) {
    $secret = "6Le2m-QoAAAAAOTtLiAX8nKL5I-98EphhwOlymD8";
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $data = file_get_contents($url);
    $row = json_decode($data, true);

    if ($row['success']) {
        $nombreUsuario = $_POST['usuarioNombre'];
        $apellidoUsuario = $_POST['usuarioApellido'];
        $calleUsuario = $_POST['usuarioCalle'];
        $usuario = $_POST['usuario'];
        $usuarioPassword = md5($_POST['contrasena']);
        $usuarioColonia = $_POST['usuarioColonia'];
        $usuarioCorreo = $_POST['usuarioCorreo'];
        $rol = 'usuario';

        $imagenUsuario = $_FILES['usuarioImagen']['name'];
        $archivo = $_FILES['usuarioImagen']['tmp_name'];

        $ruta = "usuarios";
        $ruta = $ruta . "/" . $imagenUsuario;

        move_uploaded_file($archivo, $ruta);

        // Verificar si el correo ya existe en la base de datos
        $sentencia = $conexion->prepare("SELECT usuario, correo FROM usuarios WHERE correo = :correo or usuario =:usuario");
        $sentencia->bindParam(':correo', $usuarioCorreo);
        $sentencia->bindParam(':usuario', $usuario);
        $sentencia->execute();
        $existeCorreo = $sentencia->fetch(PDO::FETCH_ASSOC);

        if ($existeCorreo) {
           
include 'global\templates\cabecera.php';
            $mensajeError = "El correo  o el usuario ya está registrado. Por favor, utiliza otro correo.";
            echo $mensajeError;
        } else {
            // El correo no existe, procede con la inserción
            $sentencia = $conexion->prepare("INSERT INTO usuarios(nombre, usuario, password, calle, colonia, rol, imagen, apellido, correo, fechaRegistro) 
                VALUES (:nombre, :usuario, :password, :calle, :colonia, :rol, :imagen, :apellido, :correo,now());");

            $sentencia->bindParam(':nombre', $nombreUsuario);
            $sentencia->bindParam(':usuario', $usuario);
            $sentencia->bindParam(':password', $usuarioPassword);
            $sentencia->bindParam(':calle', $calleUsuario);
            $sentencia->bindParam(':colonia', $usuarioColonia);
            $sentencia->bindParam(':rol', $rol);
            $sentencia->bindParam(':imagen', $imagenUsuario);
            $sentencia->bindParam(':apellido', $apellidoUsuario);
            $sentencia->bindParam(':correo', $usuarioCorreo);

            if ($sentencia->execute()) {
                header("Location: login.php");
            }
        }
    } else {
        $mensajeError = "No ingresaste el reCAPTCHA correctamente.";
    }
}
?>


