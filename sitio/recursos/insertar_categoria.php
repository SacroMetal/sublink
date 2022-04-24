<?php
include("../configuracion/configuracionsitio.php");
include("../../conexion.php");
$nombre_categoria      = $_REQUEST["nombre_categoria"];


$query =" insert into categorias (nombre_categoria) values ('$nombre_categoria')";
$resultado= $conn->query($query);

echo "Registro ".$nombre_categoria." creado";


$sql2      = "SELECT max(id_categorias) as maximo from categorias";  
$result   = mysqli_query($conn, $sql2);
while($row = mysqli_fetch_assoc($result)){ 
	$maximo      = $row["maximo"];
}

$RutaCreacioncarpeta = $rutaabsolutasubirimagenes.$maximo;
mkdir($RutaCreacioncarpeta);
?>