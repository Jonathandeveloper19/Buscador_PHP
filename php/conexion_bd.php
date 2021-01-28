
<!-------------------------------------------------------------------------
   				     ( Conexión a base de datos ) 
--------------------------------------------------------------------------->

<?php 
   $host="localhost";
      $usuario="root";
      $contraseña="";
      $base="intelcost";

      $conexion= new mysqli($host, $usuario, $contraseña, $base);
      /* Se verifica la conexión */
      if ($conexion -> connect_errno)
      {
        die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> mysqli_connect_error());
      }
 ?>