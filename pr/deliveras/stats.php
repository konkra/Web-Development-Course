
<?php	
session_start();
require_once ('../config.php');

$sql="SELECT id FROM geolocation ORDER BY id";
$result1=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result1);

?>


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




<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyCoL_955IwoSWVTtNfiKZZ2p_jsXdqXLKQ"></script>
		<style type="text/css">
			#map_canvas { 
				height: 100%;
			}
			
			input[type=submit] {
    background: #82653d;
	color:white!important;
	
}
		</style>
	
			
		<script type="text/javascript">
			
		var directionDisplay;
		var directionsService = new google.maps.DirectionsService();
		var map;
		
		function initialize() {
			directionsDisplay = new google.maps.DirectionsRenderer();
			var melbourne = new google.maps.LatLng(38.2900842, 21.799769200000014);
			
			var myOptions = {
				zoom:12,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				center: melbourne
			}

			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			directionsDisplay.setMap(map);
		}

		
		
		function calcRoute() { 
		var total=0;
<?php  for ($id = 1; $id < $rowcount; $id++) {
 
$query1 = "SELECT * FROM geolocation WHERE id =$id";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_array($result1);

$query2 = "SELECT * FROM geolocation WHERE id =$id+1";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_array($result2);

?>  				
				
			var start ="<?php echo $row1["lat"]; ?>,<?php echo $row1["lng"]; ?>";
			console.log(start);
			var end = "<?php echo $row2["lat"]; ?>,<?php echo $row2["lng"]; ?>";
				console.log(end);
			var distanceInput = document.getElementById("distance");
									
			var request = {
				origin:start, 
				destination:end,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
			
			directionsService.route(request, function(response, status) {
				
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
					distanceInput.value = response.routes[0].legs[0].distance.value / 1000;
					total=total+parseFloat(distanceInput.value);
					console.log(total);	
			window.location.href= "savevar.php?name=" + total;
					} 
			         			}
								
						); 


				<?php   }	?>			
			  }
			  
			 

		
		
		 
		
		</script>


</head>


<body onload="initialize()">
		
			
		
		
	

	<div class="limiter">
		<div class="container-login100">

		<div class="wrap-login100">
		<div class="col" align="center">
		<img src="images/user.png" height=130px;>
 			
			<?php  
 $query = "SELECT * FROM apostasi ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result); ?>		
		
<h5 class="text-info">Για τον υπολογισμό τον χιλιομέτρων πάτησε κλικ:  </h5>
		
		
		
		<div>
			
		</div>
		
		
		  <div class="container-login100-form-btn" >

						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button  class="login100-form-btn">
        
	
				
				<input type="submit" value="ΥΠΟΛΟΓΙΣΜΟΣ" onclick="calcRoute()" />
			
								<input  type="hidden" name="distance" id="distance" readonly="true" />
						
							</button>
							</div>
						</div>







		
						
			
			
			

				
	  <div class="row" >

    <div class="hl"></div>	
  

   
   
			

  </div>
		</div>	
		
   

  </div>
  
  
					
						
						
</div>  


				</div>



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
