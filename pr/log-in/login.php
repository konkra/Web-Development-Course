<?php

require_once ('../config.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['email'];
    $password = ($_POST['pass']);

    $sql = "SELECT Username, Password, user_permissions FROM users WHERE Username = ?";

    if($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $param_username);

       $param_username = $username;

       if(mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);

          if(mysqli_stmt_num_rows($stmt) == 1) {
             mysqli_stmt_bind_result($stmt, $username, $hashed_password, $permission);

             if(mysqli_stmt_fetch($stmt)) {

                if(password_verify($password, $hashed_password)) {

                      if($permission == 'a'){

                          session_start();
                          $_SESSION['username'] = $username;
                          header("location: ../cart/index5.php");

                        } elseif ($permission == 'b') {
                          session_start();
                          $_SESSION['username'] = $username;
                          header("location: ../deliveras/welcome.php");
                      } elseif ($permission == 'c') {
                        session_start();
                        $_SESSION['username'] = $username;
                        header("location: ../manager/mindex.php");
                      }
                } else{
                  echo "<script type='text/javascript'>alert('Λάθος κωδικός');</script>";
                }

             }

          }

        }

      }

      mysqli_stmt_close($stmt);

      mysqli_close($conn);

}
?>















<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
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
</head>
<body>



	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="login.php" method="post" >
					<span class="login100-form-title">
						Καλώς Ήρθατε!
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>


					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">

								Είσοδος

							</button>
						</div>




					<div class="text-center p-t-136">
						<a class="txt2" href="..\sign-up\signup.php">
							Δημιουργία Λογαριασμού
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
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


</form>
</body>
</html>
