<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");

$arrValue = array("Latitude"=>$_REQUEST['lat'],
 									"longitude"=>$_REQUEST['lon']);

InsertRec("localization", $arrValue);

header("Location: prueba2.php");

 ?>
