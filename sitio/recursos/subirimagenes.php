<?php
	include("../../conexion.php");
	include("../configuracion/configuracionsitio.php");

	$categoria      =$_REQUEST['categoria'];
	$subcategoria   =$_REQUEST['subcategoria'];
	
	$nombre_imagen = $subcategoria."-".$_FILES["file"]["name"];
	$rutaBD       = "galeria_imagenes/";
	$rutasubidaBD = $rutaBD.$nombre_imagen;

	$rutacarpeta  = $rutaabsolutasubirimagenes;
	$rutasubida   = $rutacarpeta.$nombre_imagen;


	if (file_exists($rutasubida)) {
	    echo "Posiblemente existe una imagen igual, sugerencia revisar o cambiar el nombre";
	    return false;
	}

	//echo $rutasubida;

	if (move_uploaded_file($_FILES["file"]["tmp_name"], $rutasubida)) {

	$query =" insert into galeria_imagenes (id_subcategoria, id_categoria, imagen) values('$subcategoria', '$categoria',
	 '$rutasubidaBD')";
	$resultado= $conn->query($query);
		echo "Imagen Insertada!";
	}else{
		//echo "error";
	}
?>