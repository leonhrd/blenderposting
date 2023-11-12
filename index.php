
<?php



include 'global\conexion.php';
include 'carrito.php';
include 'global\templates\cabecera.php';



$key = "dev";
$cod = "AES-128-ECB";

?>



    <br>

    <?php  if($mensaje!=""){?>

    <div class = "alert alert-success">
        Pantalla de mensaje

        <?php  echo $mensaje; ?> 

        <a href = "mostrarCarrito.php" class = "badge badge-sucess" > ver carrito</a>
        
        <a href = "añadir.php" class = "badge badge-sucess" > añadir</a>


       




    </div>
    <?php }?>


    <div class="row">


    <?php

        $sentencia = $conexion->prepare("SELECT * FROM `productos`");
        $sentencia->execute();
        $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
  

        ?>





        <?php
        
        foreach($listaProductos as $producto){
            ?>

            <div class = "col-3">


             <div class="card">

             <img
                title = "titulo"
                  class="card-img-top"
                  <img src = "productos/<?= $producto['imagen'] ?>" style = 'height: 150px; width: 150px; text-align: center;'   height="400px"   >
    
   

               

                 <div class="card-body">
                     <span> <?php echo $producto ['nombre'];?>     </span>
                     <h5 class="card-title"> $ <?php echo $producto ['precio'];?>     </h5>
                         <p class="card-text"> <?php echo $producto ['descripcion'];?>  </p>


                            <form action  ="" method = "post">

                            <input type="hidden" name="id" id="id" value = "<?php echo openssl_encrypt($producto ['id'], $cod,$key);?>">

                            <input type="hidden" name="nombre" id="nombre" value = "<?php echo openssl_encrypt($producto ['nombre'], $cod,$key);?>">
                            
                           
                            <input type="hidden" name="precio" id="precio" value = "<?php echo openssl_encrypt($producto ['precio'], $cod,$key);?>">


                                  
                            <input type="hidden" name="imagen" id="imagen" value = "<?php echo openssl_encrypt($producto ['imagen'], $cod,$key);?>">
                            

                      

                             <input type="hidden" name="cantidad" id="cantidad" value = "<?php echo openssl_encrypt(1, $cod,$key);?>"> 


                             


                           


                            <button class="btn btn-primary" 
                                     name = "btnAccion"
                                    value = "Agregar" 
                                    type="submit">
                                   Agregar al carrito </button>

                            </form>



                            
                     </div>

             </div>
            </div>



            
            <?php    }     ?>        

    
    </div>


<?php  

include 'global\templates\pie.php';

?>


        


            

        
   




