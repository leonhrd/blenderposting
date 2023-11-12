



<?php

include 'global\templates\cabecera.php';


?>





<!------ Include the above in your HEAD tag ---------->


<html>
  <head>
    <title> Blenderposting </title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    

    <link rel="stylesheet" href="registerstyle.css ">
    
    <link rel="icon" href="images\logoBlender.png" type="image/png">


  </head>
<body id="LoginForm">
<div class="container">
<h1 class="form-heading">Blenderposting</h1>
<div class="login-form">
<div class="main-div">
 





  <div class="panel">
   <h2>Blenderposting</h2>

   <p>Registrate en Blenderposting</p>


  </div>
    <form  method ="post" action="controlador_registrar.php" enctype="multipart/form-data">

        <div class="form-group">
            <input type="text" class="form-control" id="usuarioNombre" placeholder="nombre"   name = "usuarioNombre"  required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="usuarioApellido" placeholder="apellido"   name = "usuarioApellido" required>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="usuarioCalle" placeholder="calle y número"   name = "usuarioCalle"  required >
        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="usuarioColonia" placeholder="colonia"   name = "usuarioColonia"  required>
        </div>
        
        <div class="form-group">
            <input type="email" class="form-control" id="usuarioCorreo" placeholder="correo electronico"   name = "usuarioCorreo" required >
        </div>

        
        <div class="form-group">
            <input type="text" class="form-control" id="usuario" placeholder="usuario"   name = "usuario"  required>
        </div>



        <div class="form-group">
            <input type="password" class="form-control" id="inputPassword" placeholder = "contraseña"  name  ="contrasena" required>
        </div>

        <div class = "form-group">
            <label>Añada una imagen de perfil</label>
            <input type="file" name="usuarioImagen" required>
      </div>


      <div class = "form-group">

      <div class = "row" >


      <div class = "g-recaptcha" data-sitekey = "6Le2m-QoAAAAAPy-iaSheO_yAGPe-5alSsV4Spaz"></div>
      

      </div>
      </div>

  

        <div class="forgot">
        </div>

   

        <input type="submit"
                class="btn btn-primary"
                name = "submit" 
                value = "Registrar" >
        </input>

       


     

    </form>
    </div>
</div></div></div>



 



</body>
</html>