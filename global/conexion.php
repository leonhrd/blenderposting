
<?php
  $servidor = "localhost";
  $usuario = "retailer";
  $password = "1234";


  $key = "dev";
  $cod = "AES-128-ECB";





try {
    $conexion = new PDO("mysql:host=$servidor;dbname=ventas", $usuario, $password);      
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Conexión realizada Satisfactoriamente";
    //echo "<script>alert('conectado')</script>";
  }

  catch(PDOException $e)
  {
  //echo "La conexión ha fallado: " . $e->getMessage();
  //echo "<script>alert('no conectado')</script>";
  }

   



?>





  