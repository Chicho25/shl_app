<?php
ob_start();
session_start();
include("include/config.php");
include("include/defs.php");

 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Trabajando con Mapas</title>
		<style media="screen">
	    .cuadro_1{
	      height: 50vh;
	      width: 50vh;
	    }
	  </style>
	</head>
	<body>
		<div class="cuadro_1" id="cuadro_1">

		</div>
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyAb8dDB7xI-1NC_G4190uPvHe-0rzCrEhc"></script>
		<script type="text/javascript">

		var map;
		var mapOptions = {
				zoom:15,
				mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("cuadro_1"), mapOptions);

		navigator.geolocation.getCurrentPosition(function(position){
			var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

			var marker = new google.maps.Marker({
				position: geolocate,
				map: map,
				title: 'Hello World!'
			});
			map.setCenter(geolocate);
		 });
		</script>
	</body>
</html>
