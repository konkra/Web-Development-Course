<?php

require_once ('../config.php');



$lat=$_POST['lat'];
$lng=$_POST['lng'];


$query = "INSERT INTO del_geolocation (lat, lng)
VALUES ('$lat','$lng')";

$result = mysqli_query($conn, $query);



$conn->close();
?>
