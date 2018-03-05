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
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyB4BZGp30_-jl3GKfTwdyqvl4o8LJk_rXI"></script>
		<script type="text/javascript">

    var directionsDisplay = new google.maps.DirectionsRenderer();
    var directionsService = new google.maps.DirectionsService();

    var map;
    var boudha = new google.maps.LatLng(9.01211171154881,-79.5177413472077);
    var hattisar = new google.maps.LatLng(8.9790472,-79.5214714999999);

    var mapOptions = {
        zoom:14,
        disableDefaultUI: true,
        center: boudha
    };

    map = new google.maps.Map(document.getElementById("cuadro_1"), mapOptions);

    directionsDisplay.setMap(map);

    var request = {
        origin:boudha,
        destination: hattisar,
        travelMode: 'DRIVING'
    };

    directionsService.route(request, function(result, status){
      directionsDisplay.setDirections(result);
    });

    /*

    var mapOptions = {
        zoom:15,
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

     */

		/*map = new google.maps.Map(document.getElementById("cuadro_1"), mapOptions);

		navigator.geolocation.getCurrentPosition(function(position){
			var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
      */
			/*var marker = new google.maps.Marker({
				position: geolocate,
				map: map,
				title: 'Hello World!'
			});

			/*
			var infoWindow = new google.maps.InfoWindow({
				map: map,
				position: geolocate,
				content: 'Latitude: ' +position.coords.latitude+ ' <br>' +
									'Longitud: '+position.coords.longitude+ ' '
			});
			*/

			//map.setCenter(geolocate);
		 //});
		</script>

		<script type="text/javascript">

		/*function redireccionarPagina() {

			navigator.geolocation.getCurrentPosition(fn_ok, fn_error);

			function fn_error(){

			alert('Error');
			}

			function fn_ok(respuesta){

				var lat = respuesta.coords.latitude;
				var lon = respuesta.coords.longitude;
				global="lat="+lat+'&lon='+lon;
				var urlDestino = "prueba.php?"+global;
				window.open(urlDestino, '_self');
			}

		}*/

		//setTimeout("redireccionarPagina()", 30000);

		</script>
	</body>
</html>
