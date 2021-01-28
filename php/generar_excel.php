<?php

	//...Incluyendo la conexión a la base de datos...
    include("conexion_bd.php");

	//Campos seleccionados, recibidos por el metodo(POST).
    $ciudad = htmlspecialchars($_POST['ciudad2']);
    $tipo = htmlspecialchars($_POST['tipo2']);
	
	// Se realiza una consulta SQL mientras los campos seleccionados son iguales a los de la tabla.
	$registros = "SELECT * FROM datos_generales WHERE ciudad = '$ciudad' AND tipo = '$tipo' ORDER BY ciudad DESC";
	$resultado=$conexion->query($registros);

	// Variable definida para almacenar los datos de la consulta.
	$txt = "";
	
	$txt =  $txt.'ID'.";".
   			    utf8_decode('DIRECCIÓN'.";").
   			    utf8_decode('CIUDAD'.";").
   			    utf8_decode('TELÉFONO'.";").
   			    utf8_decode('CODIGO POSTAL'.";").
   			    utf8_decode('TIPO'.";").
   			    utf8_decode('PRECIO'."\n");
			   	
		// array numérico y asociativo
		while ($dato = $resultado->fetch_array(MYSQLI_BOTH)) {

		$txt =  $txt.$dato['id'].";".
   			    utf8_decode($dato['direccion'].";").
   			    utf8_decode($dato['ciudad'].";").
   			    utf8_decode($dato['telefono'].";").
   			    utf8_decode($dato['codigo_postal'].";").
   			    utf8_decode($dato['tipo'].";").
			   	utf8_decode($dato['precio']."\n");
				              
				              }

    //Apertura del fichero y escritura en el.
	$fp = fopen("../php/temp.csv", "w");
	fwrite($fp, $txt);
	fclose($fp);
	
	// Redirecciona a la pagina principal
	header("Location: ../php/temp.csv");

?>
