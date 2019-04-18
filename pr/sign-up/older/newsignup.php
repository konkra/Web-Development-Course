<?php

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "delivery";

$conn = new mysqli($servername, $username, $password, $dbname);

$username_err = $password_err = $name_err = $last_name_err = $number_err = "";


if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    printf("Current character set: %s \n", $conn->character_set_name());
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['email']))) {
      $username_err = "Εισάγετε έγκυρο email.";
    } else {
      $sql = "SELECT ID FROM users WHERE Username = ?";

      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = trim($_POST['email']);

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){
              $username_err = "Email υπάρχει ήδη";
          } else{
              $username = trim($_POST['email']);
          }
        }
      }
      mysqli_stmt_close($stmt);
    }

      if(empty(trim($_POST['pass']))){
          $password_err = "Εισάγετε κωδικό";
      } else {
          $password = trim($_POST['pass']);
      }

      if(empty(trim($_POST['Όνομα']))){
          $name_err = "Εισάγετε Όνομα";
      } else {
          $name = trim($_POST['Όνομα']);
      }

      if(empty(trim($_POST['Επώνυμο']))){
          $last_name_err = "Εισάγετε Επώνυμο";
      } else {
          $last_name = trim($_POST['Επώνυμο']);
      }

      if(empty(trim($_POST['Τηλέφωνο']))){
          $number_err = "Εισάγετε Τηλέφωνο";
      } else {
          $number = trim($_POST['Τηλέφωνο']);
      }


      if(empty($username_err) && empty($password_err) && empty($name_err) && empty($name_err) && empty($last_name_err)){

        $sql = "INSERT INTO Users (Username, Password, Name, Surname, Phone) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_name, $param_lastname, $param_number);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_name = $name;
            $param_lastname = $last_name;
            $param_number = $number;


            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
      }


    mysqli_close($conn);

  }
  ?>
