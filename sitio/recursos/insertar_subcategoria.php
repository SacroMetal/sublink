<?php
include("../configuracion/configuracionsitio.php");
include("../../conexion.php");

$nombre_subcategoria        = $_REQUEST["nombre_subcategoria"]; //titulo texto
$combo_subcategoria         = $_REQUEST["combo_subcategoria"]; //recibe el id de subcategoria



$query =" insert into sub_categorias (id_categoria, nombre_subcategoria) values ($combo_subcategoria,'$nombre_subcategoria')";

$resultado= $conn->query($query);
echo "Sub Categoría creada";



?>