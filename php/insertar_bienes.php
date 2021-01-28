<?php

// Inserción (MySQL INSERT INTO SELECT) de la tabla (datos_generales) la Tabla (intelcost_bienes)

	include("conexion_bd.php");
    
	mysqli_query($conexion,"INSERT INTO intelcost_bienes ( 
		      id, 
		      direccion, 
		      ciudad, 
		      telefono,
		      codigo_postal,
		      tipo,
		      precio) 
		SELECT id, 
		      direccion, 
		      ciudad, 
		      telefono, 
		      codigo_postal,
		      tipo,
		      precio
		FROM datos_generales WHERE id=".$_GET['id']);

		// Redirecciona a la pagina principal
		header("location:../index.php");
	
?>