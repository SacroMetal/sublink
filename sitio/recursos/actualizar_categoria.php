<?php
include("../../conexion.php");


$idcombo      	  = $_REQUEST["idcombo"];
$idcategoria      = $_REQUEST["idcategoria"];

$query =" UPDATE sub_Categorias set id_categoria='$idcombo' where  id_subcategoria='$idcategoria'";

$resultado= $conn->query($query);

echo "Actualizado";
?>