<?php
include("../../conexion.php");

	$id_subcategoria=$_REQUEST['id_subcategoria'];

	$query="delete from sub_categorias where id_subcategoria='$id_subcategoria'";
	$resultado= $conn->query($query);

	echo "eliminado";
?>