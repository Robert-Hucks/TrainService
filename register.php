<?php
  session_start(); 
  include('dbConnection.php');
  include("pagefunction.php");
    // If the values are posted, insert them into the database.
    if (isset($_POST['email']) && isset($_POST['password'])){

		$token = rand(100000000000,999999999999);
		$uniqID = rand(1000,9999);
		$hash = $token . $uniqID; 
		$apiKey = md5($hash);

        $email = $_POST['email'];
        $password = $_POST['password'];
		
									
        $query = "INSERT INTO user (`email`, `password`, `token`, `uniqueID`, `apiKey`) VALUES ('" . $email . "', '" . $password . "', '" . $token . "', '" . $uniqID . "', '" . $apiKey . "')";
        $result = mysqli_query($link, $query) or die("Issue with details");
        if($result){
			$extra = 'login.php';
			redirect($extra);
        }
		else{
			?>
			<html>
			<head> <title>Not success</title> </head>
	<body>
	<p>
	User Created Not Successfully.
	</p>
	</body>
	</html>
	<?php
		}
    }
    ?>
