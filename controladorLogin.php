



<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}



if(!empty($_POST["iniciosesion"]))
{
    if(!empty($_POST['usuario']) and !empty($_POST['contrasena'] )){

        $usuario = $_POST["usuario"];
        $password = md5($_POST["contrasena"]);
      
        
        $sentencia = $conexion->prepare("
        select * from usuarios where usuario = '$usuario' and password  = '$password'  ");
        
        $sentencia -> execute();


        if($datos = $sentencia -> fetch(PDO::FETCH_ASSOC) ){
            $_SESSION["usuario"] = $datos ["usuario"];  
            $_SESSION["calle"] = $datos ["calle"];
            $_SESSION["colonia"] = $datos ["colonia"];    
            $_SESSION["rol"] = $datos ["rol"];
            $_SESSION["imagen"] = $datos ["imagen"];            
            $_SESSION["correo"] = $datos ["correo"];
            $_SESSION["id_usuario"] = $datos ["id_usuario"];
            $_SESSION["fechaRegistro"] = $datos ["fechaRegistro"];
                        
                        
                        



            if ($_SESSION["rol"] == 'admin') {
                echo '
                <<style>  #anadirArt{display: block;   } </style> 
                <<style>  #removerArt{display: block;   } </style>   
                
                
                
                ';
            }
            


            echo "<script type='text/javascript'>window.location.href='index.php';</script>";
        }
        else{ echo "no existe";}

       


    }

    else 
    {  echo "campo vacío";}

}
    
    




?>


