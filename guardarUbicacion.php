<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");
$arrValue = array("Latitude"=>$_REQUEST['lat'],
 									"Longitude"=>$_REQUEST['lon'],
                  "Id_user"=>$_SESSION['USER_ID'],
                  "Date_register"=>date("Y-m-d H:i:s"),
                  "Id_service"=>$_SESSION['id_servicio'],
                  "Id_phase"=>1,
                  "Stat"=>2);
InsertRec("localization", $arrValue);
header("Location: origen_destino.php?id=".$_SESSION['id_servicio']);?>
