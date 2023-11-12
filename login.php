
<?php
session_start();

include 'global\templates\cabecera.php';

include 'global\conexion.php'; 


?>


<!------ Include the above in your HEAD tag ---------->


<html>
  <head>
    <title> Blenderposting </title>

    <link rel="stylesheet" href="loginstyle.css ">
    
    <link rel="icon" href="images\logoBlender.png" type="image/png">


  </head>
<body id="LoginForm">
<div class="container">
<h1 class="form-heading">Blenderposting</h1>
<div class="login-form">
<div class="main-div">
 


  <div class="panel">
   <h2>Blenderposting</h2>

   <p>Ingresa tu usuario y contrasena</p>

  </div>
    <form id="Login" method ="post" action="">

        <div class="form-group">
            <input type="text" class="form-control" id="usuario" placeholder="usuario"   name = "usuario" >
        </div>

        <div class="form-group">
            <input type="password" class="form-control" id="inputPassword" placeholder = "contraseña"  name  ="contrasena">
        </div>


        <div class="forgot">
        </div>

      
        <?php
        include 'controladorLogin.php';
        ?>

        <input type="submit"  class="btn btn-primary" name = "iniciosesion" value = "Iniciar sesion"></input>

     

    </form>
    </div>
</div></div></div>



 



</body>
</html>