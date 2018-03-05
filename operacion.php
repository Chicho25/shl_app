<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
/* confi cabezera de pagina */
$link = "menu-servicio.php?id=".$_REQUEST['id']."";
$nombre_titulo = "Operacion";
////////////////////////////////

if(!isset($_SESSION['USER_ID']))
   {
        header("Location: login.php");
        exit;
   }

   $MSG ="";

////////////////////////////////// Eventos ////////////////////////////
  include("event_messaje_header.php");
//////////////////////////////////////////////////////////////////////

if(GetRecord("phase_detail", "Id_service = '".$_REQUEST['id']."' AND Id_phase = 3")){
   $_SESSION['id_servicio'] = $_REQUEST['id'];
}else{

  $registro = array("Id_service"=>$_REQUEST['id'],
                    "Id_phase"=>3,
                    "Date_create"=>date("Y-m-d H:i:s"),
                    "Id_user"=>$_SESSION['USER_ID'],
                    "Stat"=>2);

  $id_rec = InsertRec("phase_detail", $registro);

  $_SESSION['id_servicio'] = $_REQUEST['id'];

}

if(isset($_FILES['foto']) && $_FILES['foto']['tmp_name'] != "")
{

  $array_photo = array("Id_service"=>$_SESSION['id_servicio'],
                       "Id_phase"=>3,
                       "Stat"=>2,
                       "Date_register"=>date("Y-m-d H:i:s"),
                       "Id_user"=>$_SESSION['USER_ID']);

  $ind = InsertRec("phase_photo", $array_photo);

    $target_dir = "fotos/armado/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $filename = $target_dir . $ind.".".$imageFileType;
    $filenameThumb = $target_dir . $ind."_thumb.".$imageFileType;
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $filename))
    {
        /*makeThumbnailsWithGivenWidthHeight($target_dir, $imageFileType, $nId, 100, 100);*/
    }

    $array_photo_up = array("Photo"=>$filenameThumb);

    UpdateRec("phase_photo", "Id =".$ind, $array_photo_up);

    $MSG = '<div class="alert alert-success bg-success"><a href="#" class="close" style="color:white;" data-dismiss="alert">&times;</a><strong style="color:white;">Foto Registrada...!</strong></div>';

}

if (isset($_POST['start'])) {

  $arrValue = array("Stat"=>3,
                    "Date_start"=>date("Y-m-d H:i:s"));

  UpdateRec("phase_detail", "Id =".$_POST['Id_detail'], $arrValue);

}elseif(isset($_POST['end'])){

  $arrValue = array("Date_end"=>date("Y-m-d H:i:s"),
                    "Stat"=>8);

  UpdateRec("phase_detail", "Id =".$_POST['Id_detail'], $arrValue);

  $arrValue2 = array("Phase_current"=>4);

  UpdateRec("phase_detail_general", "Id_service =".$_SESSION['id_servicio'], $arrValue2);

  header("Location: menu-servicio.php?id=".$_SESSION['id_servicio']);

}


   $optener_registros = GetRecords("SELECT * FROM
                                    phase_detail
                                    WHERE
                                    Id_service = '".$_REQUEST['id']."'
                                    AND
                                    Stat in(2,3,4)");?>

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
    }
    .cuadro_1{
      height: 50vh;
      width: 50vh;
    }
    #Selector {
        width: 200px;
        margin: 0 auto;
    }

    .SubirFoto {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
        line-height: normal;
        font.size: 100%
        margin:0;
    }

    .SubirFoto + label {
        font-size: 1.2rem;
        font-weight: bold;
        color: #d3394c;
        display: inline-block;
        text-overflow: ellipsis;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        padding: 0.6rem 1.2rem;
        cursor: pointer;
    }

    .SubirFoto:focus + label,
    .SubirFoto + label:hover {
        color: orange;
        outline: 1px dotted #000;
        fill: orange;
    }

    .SubirFoto + label figure {
        width: 100%;
        height: 100%;
        fill: #f1e5e6;
        border-radius: 50%;
        background-color: #d3394c;
        display: block;
        padding: 20px;
        margin: 0 auto 10px;
    }

    .SubirFoto + label:hover figure {
        background:orange;
    }

    inputfile + label svg {
        vertical-align: middle;
        width: 100%;
        height: 100%;
        fill: #f1e5e6;
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
            <button type="submit" <?php if($optener_registros[0]["Stat"]==3){ echo "name='end'";}else{} ?> style="width:100%; margin:10px; border: 1px solid black; <?php if($optener_registros[0]["Stat"]==3){ echo "background-color:#FFC300;";}else{ echo 'background-color:gray;';} ?>" class="btn green">Finalizar</button>
            <input type="hidden" name="Id_detail" value="<?php echo $optener_registros[0]["Id"]; ?>">
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
          </form>
          <?php if ($optener_registros[0]["Stat"] == 3) { ?>
            <div id="Selector" style="text-align:center;">
              <form class="" action="" method="post" enctype="multipart/form-data">
                <input type="file" name="foto" id="foto" class="SubirFoto" accept="image/*" capture="camera" />
                <label for="foto">
                  <i style="font-size:50px; color:black;" class="fa fa-camera" aria-hidden="true"></i>
                </label>
                <h5>Tomar una foto</h5>
                <button type="submit" <?php if($optener_registros[0]["Stat"]==3){}else{} ?> style="width:70%; margin:10px; border: 1px solid black; <?php if($optener_registros[0]["Stat"]==3){ echo "background-color:#FFC300;";}else{ echo 'background-color:gray;';} ?>" class="btn green">Guardar Foto</button>
              </form>
            </div>
            <?php $phase=3; ?>
            <?php include("event_messaje_body.php"); ?>
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
