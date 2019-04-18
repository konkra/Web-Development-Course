<?php

session_start();

require_once ('../config.php');



 if(isset($_POST["add_to_cart"]))
 {
      if(isset($_SESSION["shopping_cart"]))
      {
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
           if(!in_array($_GET["id"], $item_array_id))
           {
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                     'item_id'               =>     $_GET["id"],
                     'item_name'               =>     $_POST["hidden_name"],
                     'item_price'          =>     $_POST["hidden_price"],
                     'item_quantity'          =>     $_POST["quantity"]
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
           }
           else
           {
                echo '<script>alert("Item Already Added")</script>';
                echo '<script>window.location="index5.php"</script>';
           }
      }
      else
      {
           $item_array = array(
                'item_id'               =>     $_GET["id"],
                'item_name'               =>     $_POST["hidden_name"],
                'item_price'          =>     $_POST["hidden_price"],
                'item_quantity'          =>     $_POST["quantity"]
           );
           $_SESSION["shopping_cart"][0] = $item_array;
      }

 }
 if(isset($_GET["action"]))
 {
      if($_GET["action"] == "delete")
      {
           foreach($_SESSION["shopping_cart"] as $keys => $values)
           {
                if($values["item_id"] == $_GET["id"])
                {
                     unset($_SESSION["shopping_cart"][$keys]);
                     echo '<script>alert("Item Removed")</script>';
                     echo '<script>window.location="index5.php"</script>';
                }
           }
      }
 }

 if(isset($_POST['submit'])){
   session_start();
   header("location: complete.php");

 }



 ?>


<!DOCTYPE html>
<html lang="en">


<head>
	<title>Online Παραγγελία</title>
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

<script type="text/javascript">
// Quantity spin buttons
function increase_by_one(field) {
 nr = parseInt(document.getElementById(field).value);
 document.getElementById(field).value = nr + 1;
}

function decrease_by_one(field) {
 nr = parseInt(document.getElementById(field).value);
 if (nr > 0) {
   if( (nr - 1) > -1) {
     document.getElementById(field).value = nr - 1;
   }
 }
}
</script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form action="index5.php" method="post">

	<div class="limiter">
		<div class="container-login100">

		<div class="wrap-login100">


   <img src="images/logo.png" class="img-fluid">


		<div class="hl"></div>

				<?php
                $query = "SELECT * FROM proionta ORDER BY id ASC";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                     while($row = mysqli_fetch_array($result))
                     {
                ?>
			    <div class="col" align="center">

                     <form method="post" action="index5.php?action=add&id=<?php echo $row["id"]; ?>">

							   <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />
                               <h5 class="text-info"><?php echo $row["pname"]; ?></h5>
                               <h6 class="text-important">€ <?php echo $row["price"]; ?></h6>  <br />
                               <input type="text" name="quantity" class="form-control" value="1" />
                               <input type="hidden" name="hidden_name" value="<?php echo $row["pname"]; ?>" />
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                    		   <input type="submit" name="add_to_cart" style="margin-top:5px;"  class="btn btn-info" value="Αγορά"/>
										<br>   <br>
                     </form>
					</div>


                <?php
                     }
                }
                ?>
                <div style="clear:both"></div>



                <div class="hl"></div>
				   <h4>Η Παραγγελία Μου:</h4>
                     <table class="table table-bordered ">
                          <tr>  <br> <br>
                               <th width="14%">Προϊόν</th>
                               <th width="10%">Ποσότητα</th>
                               <th width="14%">Τιμή</th>
                               <th width="10%">Σύνολο</th>
                               <th width="5%"></th>
                          </tr>
                          <?php



                          if(!empty($_SESSION["shopping_cart"]))
                          {
                               $total = 0;
                               foreach($_SESSION["shopping_cart"] as $keys => $values)
                               {
                          ?>
                          <tr>
                               <td><?php echo $values["item_name"]; ?></td>
                               <td><?php echo $values["item_quantity"]; ?></td>
                               <td>€ <?php echo $values["item_price"]; ?></td>
                               <td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                               <td><a href="index5.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Αφαίρεση</span></a></td>
                          </tr>
                          <?php
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                               }

                               if(isset($_POST['submit'])) {
                                 $order_name = $_POST["Όνομα"];
                                 $order_lastname = $_POST["Επώνυμο"];
                                 $order_phone = $_POST["Τηλέφωνο"];
                                 $order_address = $_POST["Διεύθυνση"];

                                 $query = "INSERT INTO orders (order_name, order_lastname, phone, address, item_price)
                                 VALUES ('$order_name', '$order_lastname', '$order_phone', '$order_address', '$total')";

                                 $result = mysqli_query($conn, $query);

                                 unset($_SESSION);

                             		 session_destroy();



                             }
                          ?>
                          <tr>
                               <td colspan="3" align="right">Σύνολο</td>
                               <td align="right">€ <?php echo number_format($total, 2); ?></td>
                               <td></td>
                          </tr>
                          <?php
                          }
                          ?>
                     </table>








<div class="hl"></div>
 <h4>Διεύθυνση Αποστολής:</h4>
    <br>







			<div class="wrap-input100 validate-input" data-validate="Το πεδίο Όνομα είναι απαραίτητο">
						<span class="label-input100">Όνομα</span>
						<input class="input100" type="text" name="Όνομα" placeholder="Όνομα...">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Το πεδίο Επώνυμο είναι απαραίτητο">
						<span class="label-input100">Επώνυμο</span>
						<input class="input100" type="text" name="Επώνυμο" placeholder="Επώνυμο...">
						<span class="focus-input100"></span>
					</div>

				<div class="wrap-input100" >
						<span class="label-input100">Τηλέφωνο</span>
						<input class="input100" type="number" name="Τηλέφωνο" placeholder="Τηλέφωνο...">
						<span class="focus-input100"></span>
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

					  <div class="container-login100-form-btn">

						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button onclick="Lat_long()" class="login100-form-btn" name='submit'>
              <form action="index5.php" method="post">

								Αποστολή Παραγγελίας

              </form>
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
        url: "db_lat-lng.php",
        dataType: 'json',
        type: 'POST',
        data:{ lat: window.lat, lng: window.lng },
        success: function(data)
        {

        }
    });
  }

    </script>


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
