<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
/* confi cabezera de pagina */
$link = "";
$nombre_titulo = "Menú";
/////////////////////////////////

if(isset($_GET['new_service'])){
  $array_rec = array("new_service"=>1);
  UpdateRec("services","Id_operator=".$_SESSION['USER_ID'],$array_rec);
}

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
  <style media="screen">
      .fondo {
      width: 100%;
      height: 100%;
      /*background-image: url('images/11.jpg');*/
      background-repeat: repeat;
      background-size: contain;
      /*opacity: 1;
      background-color:black;*/
      color:black;
    }
  </style>
  <?php include("head_modal.php"); ?>
  <script src="push/bin/push.min.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-warning" id="page-top">
  <?php

      $servicios = GetRecords("Select count(*) as contar from services where Id_operator = '".$_SESSION['USER_ID']."' AND new_service = 0");
      foreach($servicios as $key => $value){
        $contar = $value['contar'];
      }
      if($contar >= 1){ ?>
      <script type="text/javascript">
        Push.create("Gruas SHL", {
          body: "Nuevo Servicio",
          icon: 'images/logo.png',
          onClick: function () {
            window.location="http://localhost/shl_app/operador.php?new_service=1";
            this.close();
          }
        });
      </script>
      <?php } ?>

  <!-- Navigation-->
  <?php include("menu.php"); ?>
  <div class="content-wrapper fondo">
    <div class="container-fluid">
      <div class="">
        <?php /*echo $MSG;*/ ?>
        <div class="card-body" style="float:left; text-align: center;">
          <div class="" style="float:left; position:relative;">
            <span style="text-align: center;">
            <a style="margin:20px; border: 1px solid black;" href="servicios_pendientes.php" name="button" class="btn green btn-warning"><i style="font-size:60px;" class="fa fa-clipboard"></i></a>
            <br>Servicios</span>
          </div>
          <div class="" style="float:left; position:relative;">
            <span>
            <a style="margin:20px; border: 1px solid black;" href="historial_servicios.php" name="button" class="btn green btn-warning"><i style="font-size:60px;" class="fa fa-folder"></i></a>
            <br>Historial</span>
          </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <?php include("body_modal.php"); ?>
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
