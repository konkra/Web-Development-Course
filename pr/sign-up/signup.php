<?php

require_once ('../config.php');

$username_err = $password_err = $name_err = $last_name_err = $number_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['email']))) {
      $username_err = "Εισάγετε έγκυρο email.";
      echo "<script type='text/javascript'>alert('$username_err');</script>";
    } else {
      $sql = "SELECT ID FROM users WHERE Username = ?";

      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = trim($_POST['email']);

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1){
              $username_err = "Email υπάρχει ήδη";
              echo "<script type='text/javascript'>alert('$username_err');</script>";
          } else{
              $username = trim($_POST['email']);
          }
        }
      }
      mysqli_stmt_close($stmt);
    }

      if(empty(trim($_POST['pass']))){
          $password_err = "Εισάγετε κωδικό";
          echo "<script type='text/javascript'>alert('$password_err');</script>";
      } else {
          $password = trim($_POST['pass']);
      }

      if(empty(trim($_POST['Όνομα']))){
          $name_err = "Εισάγετε Όνομα";
          echo "<script type='text/javascript'>alert('$name_err');</script>";
      } else {
          $name = trim($_POST['Όνομα']);
      }

      if(empty(trim($_POST['Επώνυμο']))){
          $last_name_err = "Εισάγετε Επώνυμο";
          echo "<script type='text/javascript'>alert('$last_name_err');</script>";
      } else {
          $last_name = trim($_POST['Επώνυμο']);
      }

      if(empty(trim($_POST['Τηλέφωνο']))){
          $number_err = "Εισάγετε Τηλέφωνο";
          echo "<script type='text/javascript'>alert('$number_err');</script>";
      } else {
          $number = trim($_POST['Τηλέφωνο']);
      }


      if(empty($username_err) && empty($password_err) && empty($name_err) && empty($name_err) && empty($last_name_err) && empty($number_err)){

        $sql = "INSERT INTO Users (Username, Password, Name, Surname, Phone) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){

            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_name, $param_lastname, $param_number);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_name = $name;
            $param_lastname = $last_name;
            $param_number = $number;


            if(mysqli_stmt_execute($stmt)){
                header("location: ../log-in/login.php");
            }
        }

        mysqli_stmt_close($stmt);
      }


    mysqli_close($conn);

  }
  ?>






<!DOCTYPE html>
<html lang="en">
<head>
	<title>signup V13</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!--===============================================================================================-->


</head>
<body style="background-color: #999999;">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

	<div class="limiter">
		<div class="container-signup100">
			<div class="signup100-more" style="background-image: url('images/bg-01.jpg');"></div>

			<div class="wrap-signup100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="signup100-form validate-form">
					<span class="signup100-form-title p-b-59">
						Sign Up
					</span>

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

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Διεύθυνση email...">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "To πεδίο Password είναι απαραίτητο">
						<span class="label-input100">Password</span>
						<input class="input100" type="text" name="pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>



					<div class="container-signup100-form-btn">
						<div class="wrap-signup100-form-btn">
							<div class="signup100-form-bgbtn"></div>
							<button class="signup100-form-btn">
								Sign Up
							</button>
						</div>

						<a href="../log-in/login.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Sign in
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


</body>
</body>
</html>
