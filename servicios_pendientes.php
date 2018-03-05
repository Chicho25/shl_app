<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
/* confi cabezera de pagina */
if($_SESSION['USER_ROLE']==3){
$link = "customer.php";
}else{
$link = "operador.php";}
$nombre_titulo = "Servicios";
////////////////////////////////

if(!isset($_SESSION['USER_ID']))
   {
        header("Location: login.php");
        exit;
   }

   $MSG="";

   if($_SESSION['USER_ROLE']==3){

     $optener_registros = GetRecords("SELECT
                                      services.*,
                                      users.Name as Name_customer,
                                      users.Last_name
                                      FROM
                                      services INNER JOIN users on users.Id = services.Id_operator
                                      WHERE
                                      services.Id_customer = '".$_SESSION['USER_ID']."'
                                      AND
                                      services.Stat = 2");

   }else{

   $optener_registros = GetRecords("SELECT
                                    services.*,
                                    users.Name as Name_customer,
                                    users.Last_name
                                    FROM
                                    services INNER JOIN users on users.Id = services.Id_customer
                                    WHERE
                                    services.Id_operator = '".$_SESSION['USER_ID']."'
                                    AND
                                    services.Stat = 2");
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
      /*background-image: url('images/2.jpg');*/
      background-repeat: no-repeat;
      background-size: contain;
      opacity: 1;
      /*background-color:black;
      color:white;*/
    }
  </style>
<?php //Ventana Modal ?>
<?php include("head_modal.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-warning" id="page-top" >
  <!-- Navigation-->
  <?php include("menu.php"); ?>
  <div class="content-wrapper fondo">
    <div class="container-fluid">
      <div class="">
        <?php echo $MSG; ?>
        <div class="card-body" style="float:left; text-align: left;">

          <div class="" style="float:left; position:relative;">

            <?php if ($_SESSION['USER_ROLE'] == 3){ ?>
            <?php $linkroll = "servicio_ejecucion.php"; ?>
            <?php }else{ ?>
            <?php $linkroll = "menu-servicio.php";} ?>

            <?php foreach ($optener_registros as $key => $value) { ?>
              <a style="text-decoration: none; color:black;" href="<?php echo $linkroll; ?>?id=<?php echo $value['Id'];?>">
            <span style="text-align: left;">Servicio #: <?php echo $value['Id']; ?></span><br>
            <span style="text-align: left;">Operador: <?php echo $value['Name_customer'].' '.$value['Last_name']; ?></span><br>
            <span style="text-align: left;">Descripcion: <?php echo $value['Description']; ?></span><br>
            <span style="text-align: left;">Fecha de Inicio: <?php echo $value['Date_service']; ?></span><i style="float: right;" class="fa fa-bars"></i><br>
            <span style="text-align: left;">Longitud: <?php echo $value['Id']; ?></span><br>
            <span style="text-align: left;">Latitud: <?php echo $value['Id']; ?></span><br>
            <span style="text-align: left;"><b>_________________________________________________</b></span><br>
              </a>
            <?php } ?>
          </div>

        </div>
    </div>
    </div>
    <?php include("body_modal.php"); ?>
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
