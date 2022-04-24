<?php 
include("../conexion.php");
include("configuracion/configuracionsitio.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Inicio Admin</title>
<?php 

  include("estiloscss.php");

?>

  </head>

  <body class="nav-md">

<?php 

  include("left.php");

?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Nuevos requerimientos ingresados</h3>
      </div>
    </div>

    <div class="clearfix"></div>
      <div class="row">
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
                          <th>Pyme</th>
                          <th>Imagen</th>
                          <th>Titulo</th>
                          <th>Empresa</th>
                          <th>Fecha Creación</th>
                          <th>Ver Más</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
   $sql      = "SELECT * from requerimientos r  inner join usuarios u on u.id_usuarios = r.id_usuarios  where r.activo = 0";  
   $result   = mysqli_query($conn, $sql);
   if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){ 

        $foto_perfil  = $row['foto_perfil'];

        if ($foto_perfil == null){
          $foto_perfil       = $rutaabsolutavyvytion."Img/default_avatar.jpg" ;
        }else{
          $foto_perfil       = $rutaabsolutavyvytion.$row['foto_perfil'];
        }



        $imagen       = $row['imagen'];

        if ($imagen == null){
            $imagen       = $rutaabsolutavyvytion."Img/default_avatar.jpg" ;
        }else{
            $imagen       = $rutaabsolutavyvytion.$row['foto_perfil'];
        }

?>    
              <tr>
                <td align="center"><img src="<?php echo $foto_perfil ;?>" style="width:50px; 
                                          border-radius: 200px 200px 200px 200px;
                                  -moz-border-radius: 200px 200px 200px 200px;
                                  -webkit-border-radius: 200px 200px 200px 200px;
                                  border: 0px solid #000000;">
                </td>
                <td align="center"><img src="<?php echo $imagen ;?>" style="width:50px; 
                                          border-radius: 200px 200px 200px 200px;
                                  -moz-border-radius: 200px 200px 200px 200px;
                                  -webkit-border-radius: 200px 200px 200px 200px;
                                  border: 0px solid #000000;" onclick="editarcontenido(<?php echo $row['id_requerimiento']; ?>);" title="Presione aqui para cambiar imagen de requerimiento">
                </td>
                <td><?php echo $row['titulo'] ;?></td>
                <td><?php echo $row['nombre_empresa'] ;?></td>
                <td><?php echo $row['fecha'] ;?></td>
                <td><a href="">ver detalles...</a></td>
              </tr>
<?php 
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