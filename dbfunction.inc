<?php 
// Validate a student id and password 
function validatelogin($usremail,$usrpassword){

	include('dbConnection.php');
	//ini_set('display_errors', 'On');

	echo "1";
	
	// Build an SQL statment that will return a record with a
	// matching id and password.
	$sql = "SELECT * FROM `user` WHERE `email` = '" . $usremail . "' AND `password` = '" . $usrpassword . "'";
	//$sql = "SELECT * FROM `user` WHERE `email` = 'rahucks@gmail.com' AND `password` = '123'";
	echo $sql . "</br>";


	$loginresult = mysqli_query($link, $sql) or die("Query failed: " . mysqli_error($link));
	//$userdetails = mysqli_fetch_assoc($loginresult);
	// If the SQL query contains a record
	$userdetails = mysqli_fetch_assoc($loginresult);

	if(mysqli_num_rows($loginresult) == 0) {
		echo "Login Failed</br>";
	} else {
		echo "Login Successful";
		
		$_SESSION['id'] = $userdetails['id'];
	}
}

?>