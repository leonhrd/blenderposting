
<?php

session_start();

    
$mensaje="";
$key = "dev";
$cod = "AES-128-ECB";
  
    $mensaje = "";


    if(isset($_POST['btnAccion'])){
        switch($_POST['btnAccion']){
            case 'Agregar':
                
                    if(is_numeric(openssl_decrypt( $_POST['id'], $cod, $key))){
                        $ID = openssl_decrypt( $_POST['id'], $cod, $key);
                      
                    }else{
                        $mensaje.="Upss... ID Incorecto".$ID."<br/>";
                    }


                    if(is_string(openssl_decrypt( $_POST['nombre'], $cod, $key))){
                        $NOMBRE = openssl_decrypt( $_POST['nombre'], $cod, $key);
                    
                    }else{
                        $mensaje.="Upss... Algo paso con tu nombre".$NOMBRE."<br/>";
                    }


                    if(is_numeric(openssl_decrypt( $_POST['cantidad'], $cod, $key))){
                        $CANTIDAD = openssl_decrypt( $_POST['cantidad'], $cod, $key);
                   
                    }else{
                        $mensaje.="Upss... ID Incorecto".$CANTIDAD."<br/>";
                    }


                    if(is_numeric(openssl_decrypt( $_POST['precio'], $cod, $key))){
                        $PRECIO = openssl_decrypt( $_POST['precio'], $cod, $key);
                    
                    }else{
                        $mensaje.="Upss... ID Incorecto".$PRECIO."<br/>";
                    }


                    if(is_string(openssl_decrypt( $_POST['imagen'], $cod, $key))){
                        $IMAGEN = openssl_decrypt( $_POST['imagen'], $cod, $key);
                  
                       
                        
                    }else{
                        $mensaje.="Upss... imagen Incorecto".$IMAGEN."<br/>";
                    }








                



                if(!isset($_SESSION['CARRITO'])){

                    $producto = array(

                        'ID' => $ID,
                        'NOMBRE' => $NOMBRE,
                        'CANTIDAD' =>   $CANTIDAD,
                        'PRECIO' =>  $PRECIO,
                        'IMAGEN' => $IMAGEN
                        
                        
 
                    );
                    $_SESSION['CARRITO'][0] = $producto;

                }else{


                    $idProductos = array_column($_SESSION['CARRITO'],"ID");

                    if(in_array($ID,$idProductos)){
                        
                    }
                    else{


                                                  
                    $mensaje = "";
                    $NumeroProductos = count($_SESSION['CARRITO']);
                    $producto = array(

                        'ID' => $ID,
                        'NOMBRE' => $NOMBRE,
                        'CANTIDAD' =>   $CANTIDAD,
                        'PRECIO' =>  $PRECIO,
                        'IMAGEN' => $IMAGEN
                        
                        
 
                    );
                    $_SESSION['CARRITO'][$NumeroProductos] = $producto;
                }

                                         




                }

               // $mensaje = print_r( $_SESSION,true);






                break;



                case "Eliminar":


                    if(is_numeric(openssl_decrypt( $_POST['id'], $cod, $key))){
                        $ID = openssl_decrypt( $_POST['id'], $cod, $key);
                     

                        foreach($_SESSION['CARRITO'] as $indice => $producto){
                            if($producto['ID'] == $ID){
                                unset($_SESSION['CARRITO'][$indice]);
                                $_SESSION['CARRITO']=array_values($_SESSION["CARRITO"]); 
                           
                            }

                        }

                    }else{
                        $mensaje.="Upss... ID Incorecto".$ID."<br/>";
                    }

                  


                    break;



                    case "Eliminar":

                        if(is_numeric(openssl_decrypt( $_POST['id'], $cod, $key))){
                            $ID = openssl_decrypt( $_POST['id'], $cod, $key);                         
    
                            foreach($_SESSION['CARRITO'] as $indice => $producto){
                                if($producto['ID'] == $ID){
                                    unset($_SESSION['CARRITO'][$indice]);
                                    $_SESSION['CARRITO']=array_values($_SESSION["CARRITO"]);                                
                                }    
                            }
    
                        }else{
                            $mensaje.="Upss... ID Incorecto".$ID."<br/>";
                        }  
                      
                        break;










        }
    }
?>