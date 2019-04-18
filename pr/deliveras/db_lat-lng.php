<?php



require_once ('../config.php');

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);



$query = "SELECT lat, lng FROM geolocation WHERE id=1";
$result = mysqli_query($conn, $query);

header("Content-type: text/xml");



while ($row = @mysqli_fetch_assoc($result)){

  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
}

echo $dom->saveXML();



?>
