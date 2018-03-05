<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
/* confi cabezera de pagina */
$link = "";
$nombre_titulo = "SHL - Usuarios";
/////////////////////////////////

if(!isset($_SESSION['USER_ID']))
   {
        header("Location: login.php");
        exit;
   } ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gruas SHL</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-warning" id="page-top">
  <!-- Navigation-->
  <?php include("menu.php"); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Usuarios del Sistema</div>
        <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Tipo de Usuario</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Tipo de Usuario</th>
              <th>Telefono</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $usuarios = GetRecords("SELECT *,
                                          case Stat
                                          when 1 then 'Desactivo'
                                          when 2 then 'Activo'
                                          end as Star_end,
                                          case Type_user
                                          when 1 then 'Administrador'
                                          when 2 then 'Operador'
                                          when 3 then 'Cliente'
                                          end as Type_user_end
                                          FROM users WHERE Stat = 2"); ?>
            <?php foreach ($usuarios as $key => $value) { ?>
            <tr>
              <td><?php echo $value["Id"]; ?></td>
              <td><?php echo $value["Name"]." ".$value["Last_name"]; ?></td>
              <td><?php echo $value["Email"]; ?></td>
              <td><?php echo $value["Type_user_end"]; ?></td>
              <td><?php echo $value["Phone"]; ?></td>
              <td><?php echo $value["Star_end"]; ?></td>
              <td><?php  ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Gruas SHL Todos los Derechos Reservados</div>
    </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
