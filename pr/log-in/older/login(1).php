<?php

require_once ('../config.php');


if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    printf("Current character set: %s \n", $conn->character_set_name());
}


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['email'];
    $password = ($_POST['pass']);

    $sql = "SELECT Username, Password FROM users WHERE Username = ?";

    if($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $param_username);

       $param_username = $username;

       if(mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1) {
             mysqli_stmt_bind_result($stmt, $username, $hashed_password);

             if(mysqli_stmt_fetch($stmt)) {

                if(password_verify($password, $hashed_password)) {

                  session_start();
                  $_SESSION['username'] = $username;
                  header("location: welcome.php");

                }

             }

          }

        }

      }

      mysqli_stmt_close($stmt);

      mysqli_close($conn);

}
?>
