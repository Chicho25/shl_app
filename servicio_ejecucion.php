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
      background-repeat: no-repeat;
      background-size: contain;
      opacity: 1;
      color:black;
    }
  </style>
  <?php // Dimenciones google maps ?>
  <style media="screen">
    .cuadro_1{
      height: 50vh;
      width: 50vh;
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
            <?php foreach ($optener_registros as $key => $value) { ?>
            <span style="text-align: left;">Servicio #: <?php echo $value['Id']; ?></span><br>
            <span style="text-align: left;">Cliente: <?php echo $value['Id']; ?></span><br>
            <span style="text-align: left;">Descripcion: <?php echo $value['Description']; ?></span><br>
            <span style="text-align: left;">Fecha de Inicio: <?php echo $value['Date_service']; ?></span>
            <span style="text-align: left;"><b>_________________________________________________</b></span><br>
            <?php } ?>
            <?php $optener_phase = GetRecords("SELECT Phase_current FROM phase_detail_general WHERE Id_service = '".$_REQUEST['id']."' AND Stat in(2,4)"); ?>
            <?php if($optener_phase[0]["Phase_current"]==1){ ?>
              <h3>Movilizacion</h3>

            <?php $Origen = GetRecords("SELECT
                                        Latitude, longitude
                                        FROM
                                        localization
                                        WHERE
                                        Id_user = '".$optener_registros[0]["Id_operator"]."'
                                        AND
                                        Id_service = '".$_REQUEST['id']."'
                                        AND
                                        Id_phase = 1
                                        And
                                        Stat = 2
                                        ORDER BY Id ASC
                                        LIMIT 1");

                  $Destino = GetRecords("SELECT
                                        Latitude, longitude
                                        FROM
                                        localization
                                        WHERE
                                        Id_user = '".$optener_registros[0]["Id_operator"]."'
                                        AND
                                        Id_service = '".$_REQUEST['id']."'
                                        AND
                                        Id_phase = 1
                                        And
                                        Stat = 2
                                        ORDER BY Id DESC
                                        LIMIT 1");?>
                                        <?php if(isset($Origen[0]["Latitude"], $Destino[0]["Latitude"]) && $Origen[0]["Latitude"] !="" && $Destino[0]["Latitude"] !=""){ ?>
                                        <div class="cuadro_1" id="cuadro_map">
                                        </div>
                                        <script src="https://maps.google.com/maps/api/js?key=AIzaSyAb8dDB7xI-1NC_G4190uPvHe-0rzCrEhc"></script>
                                    		<script type="text/javascript">
                                          var directionsDisplay = new google.maps.DirectionsRenderer();
                                          var directionsService = new google.maps.DirectionsService();
                                          var map;
                                          var boudha = new google.maps.LatLng(<?php echo $Origen[0]["Latitude"] ?>,<?php echo $Origen[0]["longitude"] ?>);
                                          var hattisar = new google.maps.LatLng(<?php echo $Destino[0]["Latitude"] ?>,<?php echo $Destino[0]["longitude"] ?>);
                                          var mapOptions = {
                                              zoom:14,
                                              disableDefaultUI: true,
                                              center: boudha
                                          };
                                          map = new google.maps.Map(document.getElementById("cuadro_map"), mapOptions);
                                          directionsDisplay.setMap(map);
                                          var request = {
                                              origin:boudha,
                                              destination: hattisar,
                                              travelMode: 'DRIVING'
                                          };
                                          directionsService.route(request, function(result, status){
                                          directionsDisplay.setDirections(result);
                                          });
                                        </script>
                                        <?php }else{ ?>
                                          <h4>La Movilizacion iniciara en unos minutos.</h4>
                                        <?php } ?>

            <?php }elseif($optener_phase[0]["Phase_current"]==2){ ?>
              <h3>Proceso de Armado</h3>
            <?php }elseif($optener_phase[0]["Phase_current"]==3){ ?>
              <h3>Operacion</h3>
            <?php }elseif($optener_phase[0]["Phase_current"]==4){ ?>
              <h3>Desarmado</h3>
            <?php }elseif($optener_phase[0]["Phase_current"]==5){ ?>
              <h3>Movilizacion</h3>
              <?php $Origen_fin = GetRecords("SELECT
                                          Latitude, longitude
                                          FROM
                                          localization
                                          WHERE
                                          Id_user = '".$optener_registros[0]["Id_operator"]."'
                                          AND
                                          Id_service = '".$_REQUEST['id']."'
                                          AND
                                          Id_phase = 5
                                          And
                                          Stat = 2
                                          ORDER BY Id ASC
                                          LIMIT 1");

                    $Destino_fin = GetRecords("SELECT
                                          Latitude, longitude
                                          FROM
                                          localization
                                          WHERE
                                          Id_user = '".$optener_registros[0]["Id_operator"]."'
                                          AND
                                          Id_service = '".$_REQUEST['id']."'
                                          AND
                                          Id_phase = 5
                                          And
                                          Stat = 2
                                          ORDER BY Id DESC
                                          LIMIT 1");?>
                                          <?php if(isset($Origen_fin[0]["Latitude"], $Destino_fin[0]["Latitude"]) && $Origen_fin[0]["Latitude"] !="" && $Destino_fin[0]["Latitude"] !=""){ ?>
                                          <div class="cuadro_1" id="cuadro_map">
                                          </div>
                                          <script src="https://maps.google.com/maps/api/js?key=AIzaSyAb8dDB7xI-1NC_G4190uPvHe-0rzCrEhc"></script>
                                      		<script type="text/javascript">
                                            var directionsDisplay = new google.maps.DirectionsRenderer();
                                            var directionsService = new google.maps.DirectionsService();
                                            var map;
                                            var boudha = new google.maps.LatLng(<?php echo $Origen_fin[0]["Latitude"] ?>,<?php echo $Origen_fin[0]["longitude"] ?>);
                                            var hattisar = new google.maps.LatLng(<?php echo $Destino_fin[0]["Latitude"] ?>,<?php echo $Destino_fin[0]["longitude"] ?>);
                                            var mapOptions = {
                                                zoom:14,
                                                disableDefaultUI: true,
                                                center: boudha
                                            };
                                            map = new google.maps.Map(document.getElementById("cuadro_map"), mapOptions);
                                            directionsDisplay.setMap(map);
                                            var request = {
                                                origin:boudha,
                                                destination: hattisar,
                                                travelMode: 'DRIVING'
                                            };
                                            directionsService.route(request, function(result, status){
                                            directionsDisplay.setDirections(result);
                                            });
                                          </script>
                                          <?php }else{ ?>
                                            <h4>La Movilizacion iniciara en unos minutos.</h4>
                                          <?php } ?>
            <?php }elseif($optener_phase[0]["Phase_current"]==6){
                  header("Location: customer.php");
             } ?>

          </div>
        </div>
    </div>
    </div>
    <?php include("body_modal_recarga.php"); ?>

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
