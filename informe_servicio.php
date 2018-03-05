<?php ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
if(!isset($_SESSION['USER_ID']))
   {
        header("Location: login.php");
        exit;
   }
/* confi cabezera de pagina */
if($_SESSION['USER_ROLE']==3){
$link = "historial_servicios.php";
}else{
$link = "historial_servicios.php";
}
$nombre_titulo = "Informe de Servicios";
////////////////////////////////
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
  <style media="screen">
    .cuadro_1{
      height: 50vh;
      width: 50vh;
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
        <div class="card-body" style="float:left; text-align: left;">
          <div class="" style="float:left; position:relative;">
            <?php $service= GetRecords("SELECT * FROM services WHERE Id = '".$_REQUEST['id']."' AND Stat = 4"); ?>
            <?php $general_phase = GetRecords("SELECT * FROM phase_detail_general WHERE Id_service = '".$_REQUEST['id']."' AND Stat = 4"); ?>
            <h3>Informe del Servicio</h3>
            <b>Informacion General <br></b>
               Fecha de inicio: <?php echo $general_phase[0]['Date_start']; ?><br>
               Fecha de Fin: <?php echo $general_phase[0]['Date_end']; ?><br>
               Total de Kilimetros: <br>
            <b>Movilizacion <br>
              <?php $fase_1 = GetRecords("SELECT * FROM phase_detail WHERE Id_phase = 1 AND Id_service = '".$_REQUEST['id']."' AND Stat = 8"); ?>

              Origen - Destino: </b><br>
              Fecha de inicio: <?php echo $fase_1[0]['Date_start']; ?><br>
              Fecha de Fin: <?php echo $fase_1[0]['Date_end']; ?><br>
              Kilometros <br>
              <?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
              <?php if($general_phase[0]["Phase_current"]==6){ ?>

              <?php $Origen = GetRecords("SELECT
                                          Latitude, longitude
                                          FROM
                                          localization
                                          WHERE
                                          Id_user = '".$service[0]['Id_operator']."'
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
                                          Id_user = '".$service[0]['Id_operator']."'
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
                                          <?php } ?>

              <?php } ?>
              <?php ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
            <b>Armado:</b><br>
            <?php $fase_2 = GetRecords("SELECT * FROM phase_detail WHERE Id_phase = 2 AND Id_service = '".$_REQUEST['id']."' AND Stat = 8"); ?>
              Fecha de inicio: <?php echo $fase_2[0]['Date_start']; ?><br>
              Fecha de Fin: <?php echo $fase_2[0]['Date_end']; ?><br>
            <?php $photo1 = GetRecords("SELECT * FROM phase_photo WHERE Id_phase = 2 AND Id_service = '".$_REQUEST['id']."' AND Stat = 2 AND Id_user = '".$service[0]['Id_operator']."'"); ?>
            <div>
            <?php foreach ($photo1 as $key => $value) { ?>
                <a data-toggle="modal" data-target="#popupNuevaAventura<?php echo $value['Id']; ?>">
                  <img width="80" height="80" src="<?php echo str_replace("_thumb", '', $value['Photo']); ?>" alt="">
                </a>
              <?php /////////////////////////// imagen modal ////////////////////////////// ?>
              <div class="modal fade" id="popupNuevaAventura<?php echo $value['Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Armado - Imagen</h4>
                  </div>
                  <div id="nuevaAventura" class="modal-body">
                    <img width="250" height="250" src="<?php echo str_replace("_thumb", '', $value['Photo']); ?>" alt="">
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
            -----------------------------------------------
            <br>
            <b>Operacion</b><br>
            <?php $fase_3 = GetRecords("SELECT * FROM phase_detail WHERE Id_phase = 3 AND Id_service = '".$_REQUEST['id']."' AND Stat = 8"); ?>
              Fecha de inicio: <?php echo $fase_3[0]['Date_start']; ?><br>
              Fecha de Fin: <?php echo $fase_3[0]['Date_end']; ?><br>
            <?php $photo2 = GetRecords("SELECT * FROM phase_photo WHERE Id_phase = 3 AND Id_service = '".$_REQUEST['id']."' AND Stat = 2 AND Id_user = '".$service[0]['Id_operator']."'"); ?>
            <div>
            <?php foreach ($photo2 as $key => $value) { ?>
                <a data-toggle="modal" data-target="#popupNuevaAventura<?php echo $value['Id']; ?>">
                  <img width="80" height="80" src="<?php echo str_replace("_thumb", '', $value['Photo']); ?>" alt="">
                </a>
              <?php /////////////////////////// imagen modal ////////////////////////////// ?>
              <div class="modal fade" id="popupNuevaAventura<?php echo $value['Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Operacion - Imagen</h4>
                  </div>
                  <div id="nuevaAventura" class="modal-body">
                    <img width="250" height="250" src="<?php echo str_replace("_thumb", '', $value['Photo']); ?>" alt="">
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
            -----------------------------------------------
            <br>
            <b>Desarmado</b><br>
            <?php $fase_4 = GetRecords("SELECT * FROM phase_detail WHERE Id_phase = 4 AND Id_service = '".$_REQUEST['id']."' AND Stat = 8"); ?>
              Fecha de inicio: <?php echo $fase_4[0]['Date_start']; ?><br>
              Fecha de Fin: <?php echo $fase_4[0]['Date_end']; ?><br>
            <?php $photo3 = GetRecords("SELECT * FROM phase_photo WHERE Id_phase = 4 AND Id_service = '".$_REQUEST['id']."' AND Stat = 2 AND Id_user = '".$service[0]['Id_operator']."'"); ?>
            <div>
            <?php foreach ($photo3 as $key => $value) { ?>
                <a data-toggle="modal" data-target="#popupNuevaAventura<?php echo $value['Id']; ?>">
                  <img width="80" height="80" src="<?php echo str_replace("_thumb", '', $value['Photo']); ?>" alt="">
                </a>
              <?php /////////////////////////// imagen modal ////////////////////////////// ?>
              <div class="modal fade" id="popupNuevaAventura<?php echo $value['Id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Desarmado - Imagen</h4>
                  </div>
                  <div id="nuevaAventura" class="modal-body">
                    <img width="250" height="250" src="<?php echo str_replace("_thumb", '', $value['Photo']); ?>" alt="">
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
            </div>
            -----------------------------------------------
            <br>
            <b>Movilizacion <br>
              Destino - Origen:</b>
              <?php $fase_5 = GetRecords("SELECT * FROM phase_detail WHERE Id_phase = 5 AND Id_service = '".$_REQUEST['id']."' AND Stat = 8"); ?>
              <br>
              Fecha de inicio: <?php echo $fase_5[0]['Date_start']; ?><br>
              Fecha de Fin: <?php echo $fase_5[0]['Date_end']; ?><br>
              Kilometros <br>
              <?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
              <?php if($general_phase[0]["Phase_current"]==6){ ?>

              <?php $Origen = GetRecords("SELECT
                                          Latitude, longitude
                                          FROM
                                          localization
                                          WHERE
                                          Id_user = '".$service[0]['Id_operator']."'
                                          AND
                                          Id_service = '".$_REQUEST['id']."'
                                          AND
                                          Id_phase = 5
                                          And
                                          Stat = 2
                                          ORDER BY Id ASC
                                          LIMIT 1");

                    $Destino = GetRecords("SELECT
                                          Latitude, longitude
                                          FROM
                                          localization
                                          WHERE
                                          Id_user = '".$service[0]['Id_operator']."'
                                          AND
                                          Id_service = '".$_REQUEST['id']."'
                                          AND
                                          Id_phase = 5
                                          And
                                          Stat = 2
                                          ORDER BY Id DESC
                                          LIMIT 1");?>
                                          <?php if(isset($Origen[0]["Latitude"], $Destino[0]["Latitude"]) && $Origen[0]["Latitude"] !="" && $Destino[0]["Latitude"] !=""){ ?>
                                          <div class="cuadro_1" id="cuadro_map">
                                          </div>
                                          <!--<script src="https://maps.google.com/maps/api/js?key=AIzaSyAb8dDB7xI-1NC_G4190uPvHe-0rzCrEhc"></script>-->
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
                                          <?php } ?>

              <?php } ?>
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
