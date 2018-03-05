<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
/* confi cabezera de pagina */
$link = "menu-servicio.php?id=".$_REQUEST['id']."";
$nombre_titulo = "Origen - Destino";
////////////////////////////////

if(!isset($_SESSION['USER_ID']))
   {
        header("Location: login.php");
        exit;
   }

 $MSG = "";

   ////////////////////////////////// Eventos ////////////////////////////
     include("event_messaje_header.php");
   //////////////////////////////////////////////////////////////////////

if(isset($_REQUEST['id'])){$_SESSION['id_servicio'] = $_REQUEST['id'];}

if(GetRecord("phase_detail", "Id_service = '".$_REQUEST['id']."' AND Id_phase = 1")){

}else{

  $registro = array("Id_service"=>$_REQUEST['id'],
                    "Id_phase"=>1,
                    "Date_create"=>date("Y-m-d H:i:s"),
                    "Id_user"=>$_SESSION['USER_ID'],
                    "Stat"=>2);

  $id_rec = InsertRec("phase_detail", $registro);

}

if (isset($_POST['start'])) {

  $arrValue = array("Stat"=>7,
                    "Date_start"=>date("Y-m-d H:i:s"));

  UpdateRec("phase_detail", "Id =".$_POST['Id_detail'], $arrValue);

  $arrValue2 = array("Date_start"=>date("Y-m-d H:i:s"));

  UpdateRec("phase_detail_general", "Id_service =".$_SESSION['id_servicio'], $arrValue2);

}elseif(isset($_POST['end'])){

  $arrValue = array("Date_end"=>date("Y-m-d H:i:s"),
                    "Stat"=>8);

  UpdateRec("phase_detail", "Id =".$_POST['Id_detail'], $arrValue);

  $arrValue2 = array("Phase_current"=>2);

  UpdateRec("phase_detail_general", "Id_service =".$_SESSION['id_servicio'], $arrValue2);

  header("Location: menu-servicio.php?id=".$_SESSION['id_servicio']);

}

   $optener_registros = GetRecords("SELECT * FROM
                                    phase_detail
                                    WHERE
                                    Id_service = '".$_REQUEST['id']."'
                                    AND
                                    Stat in(2,7,8)");?>

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
      /*background-image: url('images/2.jpg');
      background-repeat: no-repeat;
      background-size: contain;
      opacity: 1;
      background-color:black;
      color:white;*/
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
        <?php echo $MSG; ?>
        <div class="card-body" style="text-align: left;">
          <form class="" action="" method="post">
            <button type="submit" <?php if($optener_registros[0]["Stat"]==2){ echo "name='start'";}else{} ?> style="width:100%; margin:10px; border: 1px solid black; <?php if($optener_registros[0]["Stat"]==2){ echo "background-color:#FFC300;";}else{ echo 'background-color:gray;';} ?>" class="btn green">Iniciar</button>
            <input type="hidden" name="Id_detail" value="<?php echo $optener_registros[0]["Id"]; ?>">
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
          </form>
          <form class="" action="" method="post">
            <button type="submit" <?php if($optener_registros[0]["Stat"]==7){ echo "name='end'";}else{} ?> style="width:100%; margin:10px; border: 1px solid black; <?php if($optener_registros[0]["Stat"]==7){ echo "background-color:#FFC300;";}else{ echo 'background-color:gray;';} ?>" class="btn green">Finalizar</button>
            <input type="hidden" name="Id_detail" value="<?php echo $optener_registros[0]["Id"]; ?>">
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
          </form>

          <?php if ($optener_registros[0]["Stat"] == 7) { ?>
              <div style="width:100%; height:100%; z-index:99;">
                <article>
                  <p>Ubicacion actual <span id="status"></span></p>
                </article>
              </div>

          		<script src="https://maps.google.com/maps/api/js?key=AIzaSyAb8dDB7xI-1NC_G4190uPvHe-0rzCrEhc"></script>
          		<script type="text/javascript">
              function success(position) {
                var s = document.querySelector('#status');

                if (s.className == 'success') {
                  // not sure why we're hitting this twice in FF, I think it's to do with a cached result coming back
                  return;
                }

                s.innerHTML = "";
                s.className = 'success';

                var mapcanvas = document.createElement('div');
                mapcanvas.id = 'mapcanvas';
                mapcanvas.style.height = '400px';
                mapcanvas.style.width = '100%';

                document.querySelector('article').appendChild(mapcanvas);

                var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                var myOptions = {
                  zoom: 15,
                  disableDefaultUI: true,
                  center: latlng,
                  mapTypeControl: false,
                  navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title:"Tu estas Aqui! (a menos de "+position.coords.accuracy+" Radio Aproximado)"
                });
              }

              function error(msg) {
                var s = document.querySelector('#status');
                s.innerHTML = typeof msg == 'string' ? msg : "failed";
                s.className = 'fail';

                // console.log(arguments);
              }

              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, error);
              } else {
                error('No Soportado');
              }
          		</script>

              <script type="text/javascript">

          		function redireccionarPagina() {

          			navigator.geolocation.getCurrentPosition(fn_ok, fn_error);

          			function fn_error(){

          			alert('Error');
          			}

          			function fn_ok(respuesta){

          				var lat = respuesta.coords.latitude;
          				var lon = respuesta.coords.longitude;
          				global="lat="+lat+'&lon='+lon;
          				var urlDestino = "guardarUbicacion.php?"+global;
          				window.open(urlDestino, '_self');
          			}

          		}

               setTimeout("redireccionarPagina()", 15000);
          		</script>
          <?php $phase=1; ?>
          <?php include("event_messaje_body.php"); ?>
          <?php }elseif($optener_registros[0]["Stat"] == 8){ ?>
            <h2>Recorrido Finalizado</h2>
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
