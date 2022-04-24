<?php 
include("../../conexion.php");
$tipocategoria      = $_POST["tipocategoria"];


if ($tipocategoria  == 1){

  $id_categoria          = $_POST["id_categoria"];
  $nombre_categoria      = $_POST["nombre_categoria"];

  $consulta="update categorias set  nombre_categoria='$nombre_categoria' where id_categoria=$id_categoria";      
 
  echo "Nombre de categoria actualizado a " .$nombre_categoria;
  $resultado = $conn->query($consulta);
  
}
if ($tipocategoria  == 2){

  $id_subcategoria          = $_POST["id_subcategoria"];
  $nombre_subcategoria      = $_POST["nombre_subcategoria"];

  $consulta="update sub_categorias set  nombre_subcategoria='$nombre_subcategoria' where id_subcategoria=$id_subcategoria";      
 
  echo "Nombre de categoria actualizado a " .$nombre_subcategoria;
  $resultado = $conn->query($consulta);

}
?>