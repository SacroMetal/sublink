<?php 
include("../conexion.php");
include("configuracion/configuracionsitio.php");


$valor 	= $_REQUEST["valor"];
$id_galeria = $_REQUEST["id_galeria"];

if ($id_galeria == null){
  $id_galeria = 0;
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
function regresar(valor){
	location.href = "administrar_productos.php?valor="+valor;
}
function verImagen(archivo){
    
   w = 800
   h = 600
   t = (screen.height - h) / 2
   l = (screen.width - w) / 2
   
   x = window.open (archivo, "foto", "height=" + h + ",width=" + w + ",top="  +t + ",left=" + l +",noresize,scrollbars")    
}

function editarcontenido(){
	   var categoria             = document.getElementById('categoria').value; 
    var subcategoria          = document.getElementById('subcategoria').value; 


    var formData = new FormData();
    var files = $('#imagen')[0].files[0];


    if (subcategoria == 0){
      alert("Debe seleccionar sub categoria asociada");
      return false;
    }

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
</script>
</head>
<body class="nav-md">
<?php 
  include("left.php");
?>
<div class="right_col" role="main" align="center">
<?php
$sql      = "SELECT sc.nombre_subcategoria, c.nombre_categoria, gi.imagen, gi.precio, gi.stock, gi.id_subcategoria, gi.id_Categoria, gi.id_galeria, gi.nombre_producto, gi.detalle_info
FROM galeria_imagenes gi
inner join sub_categorias sc on sc.id_subcategoria = gi.id_subcategoria
inner join categorias c on c.id_categoria = sc.id_categoria
where gi.id_galeria=$id_galeria";

$result   = mysqli_query($conn, $sql);
$vuelta = 0;
while($row = mysqli_fetch_assoc($result)){ 

  $id_galeria  		= $row['id_galeria']; //id de galeria fotos
  $imagen 		    = $row['imagen'];
  $detalle_info     = $row['detalle_info'];
  $nombre_producto  = $row['nombre_producto'];
  $precio 			= $row['precio'];
  $stock  			= $row['stock'];

  $id_Categoria  = $row['id_Categoria'];
  $id_subcategoria  = $row['id_subcategoria'];

  if ($imagen == null){
      $imagen       = $rutaabsolutaBD."Img/default_avatar.jpg" ;
  }else{
      $imagen       = $imagen;
  }
?>
<input type="hidden" class="form-control" name="id_galeria" id="id_galeria" value="<?php echo $id_galeria; ?>">

<table border="0" style="border: hidden; width:95%;"> 
	    <tr style="border: hidden"  >
        <th style="border: hidden" WIDTH="250" >
        	<center>
              <img  width="150" height="150" title="Imagen actual ganadora" src="<?php echo  $imagen; ?>" loading="lazy" 
                 style="border-radius: 200px 200px 200px 200px;
                        -moz-border-radius: 200px 200px 200px 200px;
                        -webkit-border-radius: 200px 200px 200px 200px;
                        border: 0px solid #000000; cursor: pointer;" onclick="verImagen('<?php echo $imagen ;?>')">
           </center>
        </th>

        <th style="border: hidden" WIDTH="250" >

        <input type="file" class="form-control" name="imagen" id="imagen">


		

        	<b><font size="5">Nombre Producto:<br>
           <input type="text" class="form-control" name="nombre_producto" id="nombre_producto" value="<?php echo $nombre_producto; ?>">
           </font>
           </b>

           <font size="2">
              <b><font size="5">Detalles productos:<br></font></b>

<textarea type="text" class="form-control" name="detalle_info" id="detalle_info" cols="40" rows="5"><?php echo $detalle_info; ?></textarea>

           </font>
        </th>
    </tr>
    <tr style="border: hidden; margin-top:15px;">
        <td style="border: hidden" align="center"><b>Precio:</b></td>
        <td style="border: hidden">

          <input type="number" id="$precio" name="$precio" class="form-control" value="<?php echo $precio?>">

        </td>
    </tr>
     <tr style="border: hidden">
        <td style="border: hidden" align="center"><b>Stock:</b></td>
        <td style="border: hidden">
           <input type="number" class="form-control" name="stock" id="stock" value="<?php echo $stock; ?>">
        </td>
     </tr>

   

    <tr style="border: hidden">
    	<td style="border: hidden" align="left" style="border: hidden; margin-top: 35px;">
    	<br><br>
    	</td>
    </tr>

    <tr style="border: hidden; margin-top: 35px;">
      	<td style="border: hidden" align="left" style="border: hidden; margin-top: 35px;">

      		<img src="images/volver.png" width="90" title="Volver atrás" onclick="regresar(<?php echo $valor;?>);" style="cursor: pointer;">
        
    	</td>
      	<td style="border: hidden" align="right" style="border: hidden; margin-top: 35px;">
        
      		<img src="images/edit.png" width="120" title="Modificar informacion" onclick="editarcontenido();" style="cursor: pointer;">

     	</td>
    </tr>
</table>
<?php
	}
?>
</div>
</body>
</html>

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
