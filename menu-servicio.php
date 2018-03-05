<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
/* confi cabezera de pagina */
$link = "servicios_pendientes.php";
$nombre_titulo = "Detalle Servicio";
////////////////////////////////

if(!isset($_SESSION['USER_ID']))
   {
        header("Location: login.php");
        exit;
   }

if(GetRecord("phase_detail_general", "Id_service = '".$_REQUEST['id']."'")){

}else{

    $registro = array("Id_service"=>$_REQUEST['id'],
                      "Phase_current"=>1,
                      "Date_create"=>date("Y-m-d H:i:s"),
                      "Id_user"=>$_SESSION['USER_ID'],
                      "Stat"=>2);

    $id_rec = InsertRec("phase_detail_general", $registro);

}

   $MSG="";

   $optener_registros = GetRecords("SELECT services.*, users.Name as Name_customer, users.Last_name FROM services INNER JOIN users on users.Id = services.Id_customer WHERE services.Id = '".$_REQUEST['id']."' AND services.Stat = 2");
   $optener_phase = GetRecords("SELECT Phase_current FROM phase_detail_general WHERE Id_service = '".$_REQUEST['id']."' AND Stat = 2");
?>
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
    <?php include("head_modal.php"); ?>
</head>

<body class="fixed-nav sticky-footer bg-warning" id="page-top" >
  <!-- Navigation-->
  <?php include("menu.php"); ?>
  <div class="content-wrapper fondo">
    <div class="container-fluid">
      <div class="">
        <?php echo $MSG; ?>
          <div class="" style="float:left; position:relative;">
            <?php foreach ($optener_registros as $key => $value) { ?>
            <span style="text-align: left;">Servicio #: <?php echo $value['Id']; ?></span><br>
            <span style="text-align: left;">Cliente: <?php echo $value['Id']; ?></span><br>
            <span style="text-align: left;">Descripcion: <?php echo $value['Description']; ?></span><br>
            <span style="text-align: left;">Fecha de Inicio: <?php echo $value['Date_service']; ?></span>
            <span style="text-align: left;"><b>_________________________________________________</b></span><br>
            <?php } ?>
            <?php $fases = GetRecords("SELECT * FROM phases WHERE Stat = 1"); ?>
            <?php foreach ($fases as $key => $value) { ?>
                  <a href="<?php echo $value['Link'].$_REQUEST['id']; ?>" style="text-decoration: none; color:white; width:90%; margin:10px; border: 1px solid black; <?php if($optener_phase[0]["Phase_current"]==$value["Id"]){ echo "background-color:#FFC300;";}else{ echo 'background-color:gray;';} ?>" class="btn green"><?php echo $value['Name']; ?></a>
            <?php } ?>

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
