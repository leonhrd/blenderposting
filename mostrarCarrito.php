




<?php

include 'carrito.php';
include 'global\templates\cabecera.php';


$key = "dev";
$cod = "AES-128-ECB";

?>

<br>
<h3> Lista del carrito </h3>


<?php
if(!empty($_SESSION['CARRITO'])){ ?>


<table class = "table table-light table-bordered">
<tbody>
<tr>
    <th width = "20%">  Articulo </th>
    
    <th width = "20%"> imagen</th>
    <th width = "15%" class = "text-center"> Cantidad</th>
    <th width = "20%" class = "text-center"> Precio</th>
    <th width = "20%" class = "text-center"> Subtotal </th>
    <th width = "5%" class = "text-center"> Remover </th>

</tr>


<?PHP $total = 0;?>

<?php 

foreach($_SESSION['CARRITO'] as $indice=>$producto){?>

    <tr>
        

 
    <td width = "15%" class = "text-center"> <?php echo $producto['NOMBRE']?> </td>

    <td width="15%" class="text-center">

    <img src = "productos/<?= $producto['IMAGEN'] ?>" style = 'height: 150px; width: 150px; text-align: center;'   height="400px"   >

  
<!-- 
    <td width = "15%" class = "text-center"> <?php echo $producto['CANTIDAD']?> </td>     -->
    <td width="15%" class="text-center">
    <input type="number" name="cantidad" value="<?php echo $producto['CANTIDAD']; ?>" />
</td>



   

    <td width = "20%" class = "text-center">  <?php echo NUMBER_FORMAT(  $producto['PRECIO']    ,2)?>    </td>

    <td width = "20%" class = "text-center">  <?php echo NUMBER_FORMAT(  $producto['PRECIO'] *   $producto['CANTIDAD']   ,2)?> </td>
    <td width = "5%">      


    <form action="" method = "post"> 

    <input type = "hidden"     name  ="id"     id = "id"    value = "<?php echo openssl_encrypt($producto ['ID'], $cod,$key);?>" >

    <button 
    class = "btn btn-danger"
    type ="submit"
    name = "btnAccion"
    value = "Eliminar"
    >Eliminar  </button>

    <button 
    class = "btn btn-primary"
    type ="submit"
    name = "btnAccion"
    value = "Actualizar"
    >Actualizar  </button>

    </form>

    </td>

</tr>

<?php  $total = $total+($producto['PRECIO'] *   $producto['CANTIDAD']);  ?>

<?php }?>






<tr>
<td colspan = "3" align="right"> <h3>Total</h3>            </td>
<td align = "right"> <h3>  $<?php echo number_format(   $total      ,2)?>         </h3></td>
<td></td>
</tr>



<tr> 

   <td  colspan = "5">


   <?php if(isset($_SESSION["usuario"])) { ?>
    <form action="pagar.php" method="post">
        <div class="">
            <div class="alert alert-warning alert-background">
                <label for="my-input">Correo de contacto</label>
            </div>

            <small>


            <input id = "email"   name="email" type="email" class="form-control" id="email" placeholder="correo electronico"    required >
  
            </small>
        
           
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion" value="proceder">
            Proceder al pago
        </button>
    </form>
<?php } else { ?>

    <div class="alert alert-warning alert-background">
    Debes iniciar sesión para proceder al pago.
</div>
<?php } ?>

 

   
    </td> 
</tr>


</tbody>
</table>
<?php } 

else{  ?>


<p class="success-message">No hay articulos en tu carrito </p>
<img src="https://cdn-icons-png.flaticon.com/512/102/102661.png" alt="">


    <?php }?>




<?php  

include 'global\templates\pie.php';

?> 


<style>
.alert-background {
    background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Blender_logo_no_text.svg/587px-Blender_logo_no_text.svg.png');
    background-size: 90px;
    color: black;
    background-color: white;
    font-family: monospace;
    font-size: xx-large;
    font-weight: bold;
    text-align:  center;
    text-shadow: 2px 4px 4px #fff; 
}
</style>