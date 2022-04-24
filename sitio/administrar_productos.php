<?php 
include("../conexion.php");
include("configuracion/configuracionsitio.php");

$valor = $_REQUEST["valor"];

if ($valor == null){
  $valor = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Administrar Sitio</title>
<?php 
  include("estiloscss.php");
?>
<script> 
function cargasitio(valor){
	var valor = valor;
	window.location = "administrar_productos.php?valor="+valor;
}

function subirimagen(){

    var categoria             = document.getElementById('categoria').value; 
    var subcategoria          = document.getElementById('subcategoria').value; 


    var formData = new FormData();
    var files = $('#imagen')[0].files[0];


    if (files == null){

      alert("Debe seleccionar imagen");
      return false;
    }

    formData.append('file',files);
    formData.append('categoria',categoria); 
    formData.append('subcategoria',subcategoria); 

    $.ajax({
       url: "recursos/subirimagenes.php",
       type: "POST",
       data: formData,
       processData: false,
       contentType: false,
       success: function(response) { 
          alert(response);  
          location.reload();                 
        }
    });

}

function verImagen(archivo){
    
   w = 800
   h = 600
   t = (screen.height - h) / 2
   l = (screen.width - w) / 2
   
   x = window.open (archivo, "foto", "height=" + h + ",width=" + w + ",top="  +t + ",left=" + l +",noresize,scrollbars")    
}


function actualizarsubcategoria(idcombo, idcategoria){

  var idcombo     = idcombo;
  var idcategoria = idcategoria;
  

     var datos = { 
             "idcombo":idcombo,
             "idcategoria":idcategoria
   }; 
   console.log(datos);
  //  $.ajax({
  //      type:"post",
  //      url:"recursos/actualizar_categoria.php",
  //      data: datos,
  //   success: function (response) {
  //         alert(response);
  //         location.reload(); 
  //                   
  //      }
  //   });  
}



function actualizarcategoria(idcombo, idcategoria){

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
</script>
</head>
<body class="nav-md">
<?php 
  include("left.php");
?>
<div class="right_col" role="main" align="center">
<tr align="right">
<h2>Subir Imagenes</h2>
  <th><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Nuevas Imágenes (+)</button>
</th>
</tr>
<input type="hidden" name="categoria" id="categoria" value="<?php echo $valor;?>">

<tr align="right">
 <h2>Seleccione Categoría</h2>
<?php 
     $sql      = "SELECT * from categorias";  
     $result   = mysqli_query($conn, $sql);  
?> 

<select  class="form-control" style="width:70%;" name="combo_categoria" id="combo_categoria" onchange="cargasitio(this.value);">

<option value="0" name="combo_categoria" id="combo_categoria"  class="form-control">
	Seleccione categoría
</option>
<?php
while($row = mysqli_fetch_assoc($result)){ 
?>    
<option value="<?php echo $row['id_categoria'];?>" name="combo_categoria" id="combo_categoria"  class="form-control" 
  <?php if($valor == $row['id_categoria']) {echo "selected";}?>
  >
  <?php echo $row['nombre_categoria'];?>
</option>

<?php 
}
?>
</select>
</tr>

<?php
  if ($valor != 0){
?>
<div class="row" style="margin-top:50px;">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Tabla de requerimientos </h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Imagen</th>
                    <th>Sub categoria</th>
                    <th>Categoria</th>
                    <th>Detalle</th>
                    <th>Precio $</th>
                    <th>Stock</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>
<?php

$sql      = "SELECT sc.nombre_subcategoria, c.nombre_categoria, gi.imagen, gi.precio, gi.stock, gi.id_subcategoria, gi.id_Categoria, gi.id_galeria
FROM galeria_imagenes gi
inner join sub_categorias sc on sc.id_subcategoria = gi.id_subcategoria
inner join categorias c on c.id_categoria = sc.id_categoria
where gi.id_categoria=$valor";
echo $sql;
$result   = mysqli_query($conn, $sql);
$vuelta = 0;
while($row = mysqli_fetch_assoc($result)){ 

  $id_subcategoria  = $row['id_subcategoria'];
  $id_galeria  = $row['id_galeria']; //id de galeria fotos
  $nombre_subcategoria = $row['nombre_subcategoria'];
  $nombre_categoria = $row['nombre_categoria'];
  $imagen = $row['imagen'];
  $precio = $row['precio'];
  $stock  = $row['stock'];
  $detalle_info  = $row['detalle_info'];

  if ($imagen == null){
      $imagen       = $rutaabsolutaBD."Img/default_avatar.jpg" ;
  }else{
      $imagen       = $imagen;
  }

?>    
        <tr>
          <td align="center">

<input type="hidden" id="id_galeria<?php echo $vuelta; ?>" name="id_galeria<?php echo $vuelta; ?>" value="<?php echo $id_galeria;?>">


            <img src="<?php echo $imagen ;?>"onclick="verImagen('<?php echo $imagen ;?>')" 
            style="width:50px;
            cursor: pointer; 
             border-radius: 200px 200px 200px 200px;
            -moz-border-radius: 200px 200px 200px 200px;
            -webkit-border-radius: 200px 200px 200px 200px;
            border: 0px solid #000000;">
          </td>
          <td>

<select  class="form-control" style="width:100%;"  
onchange="actualizarsubcategoria(this.value, <?php echo $id_galeria?> );">
<?php
    $sql2      = "SELECT * from sub_categorias";  
    $result2   = mysqli_query($conn, $sql2);  
    while($row2 = mysqli_fetch_assoc($result2)){ 
?>    
    <option value="<?php echo $row2['id_subcategoria'];?>"  class="form-control" 
      <?php if($row['id_subcategoria'] == $row2['id_subcategoria']) {
        echo "selected";
      }?> >
      <?php echo $row2['nombre_subcategoria'];?>
    </option>

<?php 
    }
?>
</select>  
          </td>
          <td>
<?php 
     $sql3      = "SELECT * from categorias";  
     $result3   = mysqli_query($conn, $sql3);  
?> 
<select  class="form-control" style="width:100%;"  
onchange="actualizarcategoria(this.value, <?php echo $id_galeria?> );">
  <?php

    while($row3 = mysqli_fetch_assoc($result3)){ 
  ?>    
    <option value="<?php echo $row3['id_categoria'];?>"  class="form-control" 
      <?php if($row['id_Categoria'] == $row3['id_categoria']) {echo "selected";}?>
      ><?php echo $row3['nombre_categoria'];?>
    </option>

  <?php 
    }
  ?>
    </select>  


          </td>
          <td>
<textarea id="detalleinfo" name="detalleinfo" class="form-control"><?php echo $detalleinfo; ?></textarea>

          </td>
          <td>
<center><input type="text" id="precio" name="precio" style="text-align:center;"  value="<?php echo $precio;?>"></center>
          </td>
          <td>
<center><input type="text" id="stock" name="stock"  style="text-align:center;" value="<?php echo $stock;?>"></center>
          </td>
          <td>
        <a href="#" title="editar contenido" onclick="editarsubcategoria(<?php echo $vuelta; ?>);">
        <img src="images/edit.png" style="width: 70px;">
        </a>     
          </td>
          <td>
        <a href="#" title="eliminar contenido" onclick="eliminarsubcategoria(<?php echo $id_categoria; ?>);">
        <img src="images/delete.png" style="width: 40px;">
        </a>       
          </td>
        </tr>
<?php 
$vuelta = $vuelta + 1;
}
}

?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>



<!-- Modal agregar categoria-->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Subir imagen producto</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
      <div class="modal-body">
        <div class="modal-body">
          <p>Asociar a Sub Categoría</p>
        <?php 
           $sql      = "SELECT * from sub_categorias where id_categoria='$valor'";  
           $result   = mysqli_query($conn, $sql); 
             if (mysqli_num_rows($result) > 0) { 
        ?> 

          <select  class="form-control" style="width:100%;" name="subcategoria" id="subcategoria">
            <option value="0"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">----SELECCIONE ----</font></option> 
        <?php
          while($row = mysqli_fetch_assoc($result)){ 
        ?>    
          <option value="<?php echo $row['id_categoria'];?>" class="form-control" >
            <?php echo $row['nombre_subcategoria'];?>
          </option>

        <?php 
          }
            }else{
              Echo "<b style='font-size:15px; color: red;'>No se encuentran registros</b>";
              echo "<br>";
              echo "<a type='button' href='administrar_categorias.php' class='btn btn-primary'>Crear categoría</a>";

              $disabled = "disabled";
            }
        ?>
          </select>

        </div>
      </div>
      <div class="modal-body">
        <p>Imagen</p>
        <input type="file" class="form-control" name="imagen" id="imagen" <?php echo $disabled; ?>><br>
      </div>
    <div class="modal-footer">
      <button id="btnAgregar" class="btn btn-primary" onclick="subirimagen()" <?php echo $disabled; ?>>Enviar</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
    </div>
  </div>
</div>
</div>
<!-- Fin Modal-->



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
<script src="../vendors/datatables.net/js/jquery.dataTables.min2.js"></script>
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
