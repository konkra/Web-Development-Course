  <?php

 session_start();

require_once ('../config.php');



 ?>


<!DOCTYPE html>
<html lang="en">


<head>
	<title>Online Παραγγελία</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<script>
var refreshId = setInterval(function()
{
     $('#responsecontainer').load('mindex.php').fadeIn("slow");
}, 9000);
</script>


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




<script src="http://code.jquery.com/jquery-latest.js"></script>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form action="mindex.php" method="post">



	<div class="limiter" id="responsecontainer">
		<div class="container-login100">

		<div class="wrap-login100" >
   <img src="images/logo.png" class="img-fluid">
 <div class="hl"></div>	
 
 
 
 
 
 <h4>Παραγγελίες σε εκκρεμότητα:</h4>
				
			   
<div class="table-responsive">      

  <table class="table">
   
   <thead >
                          <tr>   <th>ID</th>
                               <th>Όνομα</th>
                               <th>Επώνυμο</th>
                               <th>Τηλέφωνο</th>
                               <th>Διεύθυνση</th>
                               <th>Σύνολο</th>
                          </tr>
                           </thead>     <tbody>
<?php
                $query = "SELECT * FROM orders ORDER BY id ASC";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
                {
                     while($row = mysqli_fetch_array($result))
                     {
                ?>                        
						<tr>
						  <td> # <?php echo $row["id"]; ?> &nbsp </td>
                               <td> <?php echo $row["order_name"]; ?></td>
                               <td><?php echo $row["order_lastname"]; ?></td>
							   <td> <?php echo $row["phone"]; ?></td>
							   <td> <?php echo $row["address"]; ?> </td>
							   <td><?php echo $row["item_price"]; ?> €</td>							                            
                          </tr>
                         
                   
                                </tbody> 
								 <?php
                     }
                }
                ?>   
                     </table>
	
				
</div> 



<?php
			 
	 
global $id;
global $qty;


  if(isset($_POST['save']))
{
    
  $id = $_POST['id'];
  $qty = $_POST['qty'];
  
  
 
  $sql = "UPDATE proionta SET qty = '$qty' WHERE id = '$id'";
$result2 = mysqli_query($conn,$sql);
	
}



?>

 <div class="hl"></div>	
 
 
 
 
 
 <h4>Αλλαγή Ποσότητας:</h4> <br>

 	
		

		<div class="wrap-login100" >

<form action="mindex.php" method="post"> 
 <h6>Ποσότητα που διαθέτω από:</h6> 

<select name="id" >
  
  <option value="6">Τυρόπιτα</option>
  <option value="7">Χορτόπιτα</option>
  <option value="8">Κουλούρι</option>
  <option value="9">Τοστ</option>
  <option value="10">Κέικ</option>
</select> <br>





<input type="text"  name="qty" class="form-control"><br/>

<button type="submit" name="save" style="margin-top:5px;"  class="btn btn-info">save</button>

</form> 
</div>  

				




                                              

							  
							</div>   
					                    
					                
                <div style="clear:both"></div>
						
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
