<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
/* confi cabezera de pagina */
$link = "";
$nombre_titulo = "SHL - Historial de Servicios";
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
          <i class="fa fa-table"></i> Historial de Servicios Finalizados / Cancelados</div>
        <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Servicio</th>
              <th>Cliente</th>
              <th>Operador</th>
              <th>Fecha de Inicio</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Servicio</th>
              <th>Cliente</th>
              <th>Operador</th>
              <th>Fecha de Inicio</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
          <tbody>
            <?php $register_services = GetRecords("SELECT
                                                    services.Id,
                                                    services.Date_service,
                                                    services.Name,
                                                    (SELECT CONCAT(Name, ' ', Last_name) FROM users WHERE Id = services.Id_customer) AS customer,
                                                    (SELECT CONCAT(Name, ' ', Last_name) FROM users WHERE Id = services.Id_operator) AS operator,
                                                    master_stat.Name_stat
                                                   FROM
                                                   services INNER JOIN master_stat ON services.Stat = master_stat.Id
                                                   WHERE
                                                   services.Stat IN(4,5)"); ?>
            <?php foreach ($register_services as $key => $value) { ?>
            <tr>
              <td><?php echo $value["Id"]; ?></td>
              <td><?php echo $value["Name"]; ?></td>
              <td><?php echo $value["customer"]; ?></td>
              <td><?php echo $value["operator"]; ?></td>
              <td><?php echo $value["Date_service"]; ?></td>
              <td><?php echo $value["Name_stat"]; ?></td>
              <td>
                <a href="services_detail.php?historical=1" title="Detalle" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-icon btn-primary"><i class="fa fa-bar-chart"></i></a>
              </td>
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
