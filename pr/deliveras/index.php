
<?php

session_start();

require_once ('../config.php');






 ?>

<!DOCTYPE html>
<html lang="en">


<head>
	<title>Online Delivery System</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">




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


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form action="hold.php" method="post">

	<div class="limiter">
		<div class="container-login100">

		<div class="wrap-login100">
		<div class="hl">
				   <h4>Τρέχουσα Παραγγελία</h4>

</div>
					<div class="col" align="center">




	<?php


        $query = "SELECT * FROM orders ORDER BY id ASC limit 1";
        $result = mysqli_query($conn, $query);


                if(mysqli_num_rows($result) > 0) {
                     while($row = mysqli_fetch_array($result)) {

						 $r1=$row["id"];

				$del = "DELETE FROM orders WHERE id=$r1";

                ?>
			    <div class="col" align="center">

              <h5 class="text-info"> <img src="images/user.png" height=30px;>  <?php echo $row["order_name"]; ?>
			  <?php echo $row["order_lastname"]; ?></h5> <br />


			   <h5 class="text-info"> <img src="images/phone.png" height=30px;>  <?php echo $row["phone"]; ?>     </h5> <br />


				 <h5 class="text-info"> <img src="images/sin.png" height=30px;>  <?php echo $row["item_price"]; ?>    €</h5> <br />

				 <h5 class="text-info"> <img src="images/home.png" height=30px;>  <?php echo $row["address"];    ?>




			    <br />




										<br>   <br>

					</div>


                <?php
				            $result2 = mysqli_query($conn,$del);

                     }
                }



                ?>
                <div style="clear:both"></div>



					 </form>
					</div>




<div class="hl"></div>
 <h4>Διεύθυνση Αποστολής:</h4>
    <br>









					  <div id="map" style="width:100%;height:400px"> </div>


					   <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>




<div class="hl"></div>

					  <div class="container-login100-form-btn">

						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button  class="login100-form-btn">
              <input type="hidden" name="submit1">

								ΟΛΟΚΛΗΡΩΘΗΚΕ
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


        function downloadUrl(url, callback) {
              var request = window.ActiveXObject ?
                  new ActiveXObject('Microsoft.XMLHTTP') :
                  new XMLHttpRequest;

              request.onreadystatechange = function() {
                if (request.readyState == 4) {
                  request.onreadystatechange = doNothing;
                  callback(request, request.status);
                }
              };

              request.open('GET', url, true);
              request.send(null);
            }

        function doNothing() {}



        downloadUrl('db_lat-lng.php', function(data) {
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName('marker');
					Array.prototype.forEach.call(markers, function(markerElem) {
						     var point = new google.maps.LatLng(
								 parseFloat(markerElem.getAttribute('lat')),
								 parseFloat(markerElem.getAttribute('lng')));


			      var marker = new google.maps.Marker({
			         map: map,
			         position: point,

			       });
					 });
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


</body>
</html>
