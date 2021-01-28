
<?php 

	// Se trae por metodo (GET) el (id) del registro, se realiza un consulta SQL para eliminar.

	if(isset($_GET)){

	    $id=$_GET['id'];
	    include 'conexion_bd.php';
	    $sql="DELETE FROM intelcost_bienes WHERE id='".$id."'";
		mysqli_query($conexion,$sql);
	}
	
	// Redirecciona a la pagina principal
	header("location:../index.php");

 ?>