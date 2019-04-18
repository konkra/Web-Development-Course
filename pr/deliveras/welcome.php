<!DOCTYPE html>
<html lang="en">


<head>
	<title>Online Delivery System</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:200,300,400,600,700'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">



		<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/theme.css">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form action="welcome.php" method="post">

	<div class="limiter">
		<div class="container-login100">

		<div class="wrap-login100">
		<div class="hl">
				   <h4>Τρέχουσα Τοποθεσία</h4>

</div>
					<div class="col" align="center">
                     <!-- <form method="post" action="index5.php?action=add&id=<?php echo $row["id"]; ?>">

										                     </form> -->
					</div>



					<div class="wrap-input100" >
						<span class="label-input100">Διεύθυνση</span>
						<input class="input100" id="pac-input" type="text" placeholder="Εισάγετε Διεύθυνση" name="Διεύθυνση" >
						<span class="focus-input100"></span>
					</div>

					  <div id="map" style="width:100%;height:400px"> </div>

				  <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>





<div class="hl"></div>




	  <div class="row" >


    <div class="col-sm-5">


      <button type="button"  onclick="location.href='index.php'; Lat_long();" class="btn btn-lg btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
				<div class="handle"></div>
			</button>

    </div>







  </div>





</div>


				</div>





		</div>







    <script>

		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 38.246639, lng: 21.734573},
				zoom: 15
			});
			var card = document.getElementById('pac-card');
			var input = document.getElementById('pac-input');


			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

			var autocomplete = new google.maps.places.Autocomplete(input);

			autocomplete.bindTo('bounds', map);

			var infowindow = new google.maps.InfoWindow();
			var infowindowContent = document.getElementById('infowindow-content');
			infowindow.setContent(infowindowContent);

			var marker = new google.maps.Marker({
				map: map,
				draggable:true,
				anchorPoint: new google.maps.Point(0, -29)
			});



			window.google.maps.event.addListener(marker, 'position_changed', (e) => {
				var position = marker.getPosition()
				window.lat = position.lat()
				window.lng = position.lng()


			});






			autocomplete.addListener('place_changed', function() {
				infowindow.close();
				marker.setVisible(false);
				var place = autocomplete.getPlace();


				if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				} else {
					map.setCenter(place.geometry.location);
					map.setZoom(15);
				}
				marker.setPosition(place.geometry.location);
				marker.setVisible(true);


		var address = '';
				if (place.address_components) {
					address = [
						(place.address_components[0] && place.address_components[0].short_name || ''),
						(place.address_components[1] && place.address_components[1].short_name || ''),
						(place.address_components[2] && place.address_components[2].short_name || '')
					].join(' ');
				}

				infowindowContent.children['place-icon'].src = place.icon;
				infowindowContent.children['place-name'].textContent = place.name;
				infowindowContent.children['place-address'].textContent = address;
				infowindow.open(map, marker);
			});



			setupClickListener('changetype-all', []);
			setupClickListener('changetype-address', ['address']);
			setupClickListener('changetype-geocode', ['geocode']);


		}

		function Lat_long() {
			$.ajax({
				url: "db_entry.php",
				dataType: 'json',
				type: 'POST',
				data:{ lat: window.lat, lng: window.lng },
				success: function(data)
				{

				}
		});
	}


    </script>

    <!-- <script src="db.js"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqeos-P3HBFcxqA1Fg0SaaR-kEZh-foVU&libraries=places&callback=initMap"
        async defer></script>



<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</form>
</body>
</html>
