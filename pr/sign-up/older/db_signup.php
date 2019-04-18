<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "delivery";

$conn = new mysqli($servername, $username, $password, $dbname);




if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    printf("Current character set: %s \n", $conn->character_set_name());
}



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// if($_SERVER["REQUEST_METHOD"] == "POST"){

  $first_name=$_POST['Όνομα'];
  $last_name=$_POST['Επώνυμο'];
  $number=$_POST['Τηλέφωνο'];
  $email=$_POST['email'];
  $param_password = password_hash($_POST['pass'], PASSWORD_DEFAULT);


  $sql = "INSERT INTO users (Username, Password, Name, Surname, Phone)
  VALUES ('$email','$param_password', '$first_name', '$last_name', '$number' )";

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully \n";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

$conn->close();
?>
