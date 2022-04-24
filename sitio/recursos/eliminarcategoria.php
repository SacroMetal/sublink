<?php
include("../../conexion.php");

	$id_Categoria=$_REQUEST['id_Categoria'];

    $query="delete from categorias where id_Categoria='$id_Categoria'";
	$resultado= $conn->query($query);

	$query="delete from sub_categorias where id_categoria='$id_categoria'";
	$resultado= $conn->query($query);
?>