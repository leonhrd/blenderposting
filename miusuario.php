
<?php

include 'global\templates\cabecera.php';




?>





<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="usuariostyle.css">

<!------ Include the above in your HEAD tag ---------->

<div class="container">
  <div class="row">
    <div class="col-md-6 img">
  

    <img src="usuarios/<?php echo $_SESSION["imagen"]; ?>" alt="" class="img-rounded" style="max-width: 300px; max-height: 200px;">


      
    </div>
    <div class="col-md-6 details">
      <blockquote>
        <h5>
            <?php 
             echo $_SESSION["usuario"] ;
             ?>


        </h5>
        <small><cite title="Source Title">
            
        <?php
            echo $_SESSION["calle"] ; echo ",  ";    echo $_SESSION["colonia"] ;?>
        
        
        <i class="icon-map-marker"></i></cite></small>
      </blockquote>

      <p>
       <?php
       echo  $_SESSION["correo"];
       ?> <br>
       <br>     
      </p>

      <p> Miembro desde         <?php        echo  $_SESSION["fechaRegistro"];       ?>        </p>

    </div>

  </div>


</div>

<style>
  .centered-button {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 70vh; /* Ajusta la altura según tus necesidades */
  }

  .custom-button {
    background-color: #ffA500; /* Cambia el color de fondo a naranja (#ffA500) */
    color: #fff; /* Color del texto del botón */
    padding: 10px 20px; /* Espaciado interno del botón */
    border: none; /* Sin borde */
    border-radius: 5px; /* Borde redondeado */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 0; /* Elimina el margen inferior */
    cursor: pointer;
  }
</style>

<div class="centered-button">
  <a class="btn custom-button" href="historialVentas.php">Ver historial de compras realizadas</a>
</div>
