<?php 
include("../conexion.php");
include("configuracion/configuracionsitio.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Administrar Sitio</title>
<?php 
  include("estiloscss.php");
?>
<style> 
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</style>
</head>
<body class="nav-md">
<?php 
  include("left.php");
?>
<div class="right_col" role="main" align="center">

<tr align="right">
  <h2>Crear categoría</h2>
    <th><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Nueva categoría (+)</button>
</th>
</tr>

<table id="datatable" class="table table-striped table-bordered" style="width:100%">

    <thead>
        <tr>
            <th><center>Nombre Categoría</center></th>
            <th><center>Editar</center></th>
            <th><center>Eliminar</center></th>
        </tr>
    </thead>
    <tbody>
<?php
   $sql      = "SELECT * from categorias";  
   $result   = mysqli_query($conn, $sql);
   if (mysqli_num_rows($result) > 0) {
   		$vuelta = 0;
      while($row = mysqli_fetch_assoc($result)){ 

        $id_categoria = $row['id_categoria'] ;
      	$nombre_categoria = $row['nombre_categoria'] ;
?>    
<tr>
    <td> 
    <input type="hidden" class="form-control" id="id_categoria<?php echo $vuelta; ?>" name="id_categoria<?php echo $vuelta; ?>" value="<?php echo $id_categoria;?>">

      <input type="text" class="form-control" id="nombre_categoria<?php echo $vuelta; ?>" name="nombre_categoria<?php echo $vuelta; ?>" value="<?php echo $nombre_categoria;?>">
    </td>

    <td><center>
        <a href="#" title="editar contenido" onclick="editarcategoria(<?php echo $vuelta;?>);">
        <img src="images/edit.png" style="width: 70px;">
        </a>
    </center>
    </td>
    <td><center>
        <a href="#" title="eliminar contenido" onclick="eliminarcategoria(<?php echo $id_categoria; ?>);">
        <img src="images/delete.png" style="width: 40px;">
        </a>
    </center>
    </td>
</tr>
<?php 
	$vuelta = $vuelta + 1;
  }
}
?>
  </tbody>
</table>   


<tr align="right">
  <h2>Crear subcategoría</h2>
    <th><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalsubcategoria">Nueva SubCategoría (+)</button>
</th>

</tr>
<table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
<!--<table id="" class="table table-striped table-bordered" style="width:100%">-->
    <thead>
        <tr>
            <th><center>Sub Categoría</center></th>
            <th><center>Categoría principal</center></th>
            <th><center>Editar</center></th>
            <th><center>Eliminar</center></th>
        </tr>
    </thead>
    <tbody>
<?php
   $sql      = "SELECT * from sub_categorias order by id_categoria";  
   $resultado = $conn->query($sql); 
   $vuelta = 0;
    if (mysqli_num_rows($result) > 0) {
      while(($row = $resultado->fetch_assoc())){ 

        $id_subcategoria = $row['id_subcategoria'];
        $id_categoria = $row['id_categoria'];
        $nombre_subcategoria = $row['nombre_subcategoria'];
?>    
<tr>
    <td align="center">
      <input type="hidden" class="form-control" id="id_subcategoria<?php echo $vuelta; ?>" name="id_subcategoria<?php echo $vuelta; ?>" value="<?php echo $id_subcategoria;?>">

      <input type="text" class="form-control" id="nombre_subcategoria<?php echo $vuelta; ?>" name="nombre_subcategoria<?php echo $vuelta; ?>" value="<?php echo $nombre_subcategoria;?>">
    </td>

    <td align="center">

  <?php 
     $sql      = "SELECT * from categorias";  
     $result   = mysqli_query($conn, $sql);  
  ?> 

    <select  class="form-control" style="width:100%;"  onchange="actualizar(this.value, <?php echo $id_subcategoria?> );">
  <?php
    while($row = mysqli_fetch_assoc($result)){ 
  ?>    
    <option value="<?php echo $row['id_categoria'];?>"  class="form-control" 
      <?php if($id_categoria == $row['id_categoria']) {echo "selected";}?>
      >
      <?php echo $row['nombre_categoria'];?>
    </option>

  <?php 
    }
  ?>
    </select>

    </td>

    <td><center>
        <a href="#" title="editar contenido" onclick="editarsubcategoria(<?php echo $vuelta; ?>);">
        <img src="images/edit.png" style="width: 70px;">
        </a>
    </center>
    </td>
    <td><center>
        <a href="#" title="eliminar contenido" onclick="eliminarsubcategoria(<?php echo $id_categoria; ?>);">
        <img src="images/delete.png" style="width: 40px;">
        </a>
    </center>
    </td>
</tr>
<?php 
  $vuelta = $vuelta + 1;
  }
}
?>
  </tbody>
</table>   

<!-- Modal agregar categoria-->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Crear Categoría producto</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
      <div class="modal-body">
        <p>Nombre Nueva Categoría</p>
        <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control"><br>
      </div>
    <div class="modal-footer">
      <button id="btnAgregar" class="btn btn-primary" onclick="enviarinformacion()">Enviar</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </div>
  </div>
</div>
</div>
<!-- Fin Modal-->


<!-- Modal agregar subcategoria-->
  <div id="myModalsubcategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Crear Sub categoría</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body">
          <p>Nombre SubCategoría</p>
          <input type="text" name="nombre_subcategoria" id="nombre_subcategoria" class="form-control"><br>
        </div>
        <div class="modal-body">
          <p>Asociar a Categoría</p>
  <?php 
     $sql      = "SELECT * from categorias";  
     $result   = mysqli_query($conn, $sql);  
  ?> 

    <select  class="form-control" style="width:100%;" name="combo_subcategoria" id="combo_subcategoria">
      <option value="0"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">----SELECCIONE ----</font></option> 
  <?php
    while($row = mysqli_fetch_assoc($result)){ 
  ?>    
    <option value="<?php echo $row['id_categoria'];?>" class="form-control" >
      <?php echo $row['nombre_categoria'];?>
    </option>

  <?php 
    }
  ?>
    </select>

        </div>
      <div class="modal-footer">
        <button id="btnAgregar" class="btn btn-primary" onclick="crearsubcategoria()">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
  </div>
<!-- Fin Modal-->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<script>

function actualizar(idcombo, idcategoria){
  var idcombo     = idcombo;
  var idcategoria = idcategoria;
  

     var datos = { 
             "idcombo":idcombo,
             "idcategoria":idcategoria
   }; 
    $.ajax({
        type:"post",
        url:"recursos/actualizar_categoria.php",
        data: datos,
     success: function (response) {
           alert(response);
           location.reload(); 
                     
        }
     });  
}


function enviarinformacion(){
  // crea categoria

    var nombre_categoria = document.getElementById("nombre_categoria").value;

    if (nombre_categoria == 0){
      alert("El nombre de categoría se encuentra vacío");
      return false;
    }

    var datos = { 
                "nombre_categoria":nombre_categoria
                };  

    $.ajax({
        type:"post",
        url:"recursos/insertar_categoria.php",
        data: datos,
        success: function (response){
          alert(response)
          location.reload();
      }
    });  
}

function crearsubcategoria(){

  var nombre_subcategoria = document.getElementById("nombre_subcategoria").value;
  var combo_subcategoria  = document.getElementById("combo_subcategoria").value;
  

  if (nombre_categoria == 0){
      alert("El nombre de categoría se encuentra vacío");
      return false;
  }

    var datos = { 
                "nombre_subcategoria":nombre_subcategoria,
                "combo_subcategoria":combo_subcategoria //numeros
                };  

  $.ajax({
      type:"post",
      url:"recursos/insertar_subcategoria.php",
      data: datos,
      success: function (response){
        alert(response)
        location.reload();
    }
  });  
}

function eliminarcategoria(id) {
    var id = id;
    //Ingresamos un mensaje a mostrar
    var mensaje = confirm("¿Seguro que desea eliminar esta categoría? se eliminará sub categorías asociadas");
    if (mensaje) {

    datos = {
       "id_Categoria": id
    }

    $.ajax({
         type: "post",
         url:  "recursos/eliminarcategoria.php",
         data: datos,          
         success: function (response) {
            alert(response)
            location.reload();  ;
         }
      });  


    }
    else {
    alert("¡Cancelado!");
    }
 }


function eliminarsubcategoria(id) {
    var id = id;

    var mensaje = confirm("¿Seguro que desea eliminar? se eliminara su requerimiento");
    if (mensaje) {

    datos = {
       "id_subcategoria": id
    }

    $.ajax({
         type: "post",
         url:  "recursos/eliminarsubcategorias.php",
         data: datos,          
         success: function (response) {
            alert(response)
            location.reload();  ;
         }
      });  


    }
    else {
    alert("¡Cancelado!");
    }
 }


 function editarcategoria(vuelta){
    var id_categoria          = document.getElementById("id_categoria"+vuelta).value;
    var nombre_categoria      = document.getElementById("nombre_categoria"+vuelta).value;
    var tipocategoria         = 1;

    var datos = { 
               "id_categoria":id_categoria,
               "nombre_categoria":nombre_categoria,
               "tipocategoria" : tipocategoria
    }; 

    $.ajax({
        type:"post",
        url:"recursos/editar_categoria.php",
        data: datos,
        success: function (response){
          alert(response)
          location.reload();  
      }
    });  
 }

  function editarsubcategoria(vuelta){
    var id_subcategoria          = document.getElementById("id_subcategoria"+vuelta).value;
    var nombre_subcategoria      = document.getElementById("nombre_subcategoria"+vuelta).value;
    var tipocategoria            = 2;

    var datos = { 
               "id_subcategoria":id_subcategoria,
               "nombre_subcategoria":nombre_subcategoria,
               "tipocategoria" : tipocategoria
    }; 

    $.ajax({
        type:"post",
        url:"recursos/editar_categoria.php",
        data: datos,
        success: function (response){
          alert(response)
          location.reload();  
      }
    });  
 }
</script>


</div>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>
