
<?php
// Connection with Database
$con = new mysqli("localhost", "root", "", "delivery");



// Check Connection
if ($con->connect_errno) {

   echo "Connect failed ".$con->connect_error;

   exit();
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Greek Check
mysqli_set_charset($con, "utf8");

// Query to Database
$query = "SELECT Name, Surname, AMKA, AFM,IBAN FROM users WHERE user_permissions='c' or user_permissions='b'";

//Create Array
$EmployeeArray = array();

//Recieve information from Database and create XML file
if ($result = $con->query($query)) {

    // fetch associative array
    while ($row = $result->fetch_assoc()) {

       array_push($EmployeeArray, $row);
    }

    if(count($EmployeeArray)){

         createXMLfile($EmployeeArray);

     }

    // free result set
    $result->free();
}

// close connection
$con->close();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//XML create Function
function createXMLfile($EmployeeArray){

$filePath = 'Salary.xml';

  $doc     = new DOMdocument('1.0', 'UTF-8');

//XML View Format
$doc->preserveWhiteSpace = false;
$doc->formatOutput = true;

//Tags Nodes
$root = $doc->createElement('xml');

$header = $doc->createElement('header');

$body = $doc->createElement('body');
$transaction= $doc->createElement('transaction');
$period = $doc->createElement('period');
$employees = $doc->createElement('employees');

for($i=0; $i<count($EmployeeArray); $i++){

			 $EFirstName        =  $EmployeeArray[$i]['Name'];

			 $ELastName      =  $EmployeeArray[$i]['Surname'];

			 $EAmka    =  $EmployeeArray[$i]['AMKA'];

			 $EAfm     =  $EmployeeArray[$i]['AFM'];

			 $EIban      =  $EmployeeArray[$i]['IBAN'];

			// $EAmmount  =  $EmployeeArray[$i]['Ammount'];


			$employee = $doc->createElement('employee');

			 $FirstName   = $doc->createElement('firstName', $EFirstName );

			 $employee->appendChild($FirstName);

			 $LastName   = $doc->createElement('lastName', $ELastName );

			 $employee->appendChild($LastName);

			 $Amka    = $doc->createElement('amka', $EAmka);

			 $employee->appendChild($Amka );

			 $Afm    = $doc->createElement('afm', $EAfm );

			 $employee->appendChild($Afm);

			 $Iban = $doc->createElement('iban', $EIban);

			 $employee->appendChild($Iban);

			// $Ammount = $doc->createElement('ammount', $EAmmount);

			// $employee->appendChild($Ammount);

    $employees->appendChild($employee); }
 $root->appendChild($header);

$header->appendChild($transaction);
$transaction->appendChild($period);
$myMonth=$_POST['Month'];
$myYear=$_POST['Year'];
$period->setAttribute('month',$myMonth);
$period->setAttribute('year',$myYear);
 $root->appendChild($body);

$body->appendChild($employees);

 $doc->appendChild($root);

if($doc->save($filePath))
 echo 'The Document was created';

else  echo 'Error: the Salary.xml cannot be created';

}

?>
