<?php 
include("../../conexion.php");
$tipocategoria      = $_POST["tipocategoria"];


if ($tipocategoria  == 1){

  $id_categoria          = $_POST["id_categoria"];
  $nombre_categoria      = $_POST["nombre_categoria"];
  $habillitar_formulario = $_POST["checkbox"];



  $consulta="update categorias set  nombre_categoria='$nombre_categoria', habillitar_formulario =$habillitar_formulario where id_categoria=$id_categoria";      

  echo "Categoria " .$nombre_categoria." actualizada";
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