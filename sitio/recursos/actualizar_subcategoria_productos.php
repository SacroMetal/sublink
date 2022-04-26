<?php
include("../../conexion.php");


$idcombo      	 = $_REQUEST["idcombo"];
$id_galeria      = $_REQUEST["id_galeria"];

$query =" UPDATE galeria_imagenes set id_subcategoria='$idcombo' where  id_galeria='$id_galeria'";

$resultado= $conn->query($query);

echo "Actualizado";
?>