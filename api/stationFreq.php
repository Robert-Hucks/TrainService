<?php
header('Content-Type: application/json');

include('dbConnection.php');
//echo $_GET['tlc'] . "</br>";
//echo $_GET['apiKey'] . "</br>";
$response = array();
$error = array();
$data = array();

// Check if the APIKey exists...
if (isset($_GET['apiKey']) && ($_GET['apiKey'] != "")) {
	echo "Key is included</br>";
	$apiCheckSQL = "SELECT `apiKey` FROM `user` WHERE `apiKey` = '" . $_GET['apiKey'] . "'";
	echo $apiCheckSQL;
	$result = mysqli_query($link, $apiCheckSQL) or die(mysqli_error());
	// Check the API key is valid
	if(!mysqli_num_rows($result) == 0) {
		echo "Key is valid</br>";
		// Check if the station var is set...
		if (isset($_GET['tlc']) && ($_GET['tlc'] != "")) {
			echo "TLC is included</br>";
			// Check if the station var is valid
			$result = mysqli_query($link, "SELECT `station` FROM `Stations` WHERE `TLC` = '" . strtoupper($_GET['tlc']) . "'") or die(mysqli_error());
			if(!mysqli_num_rows($result) == 0) {
				echo "Key is valid</br>";
				$apiResult = mysqli_query($link, "SELECT * FROM `StationLineHistory` WHERE `TLC` = '" . strtoupper($_GET['tlc']) . "'") or die(mysqli_error());
				while ($row = mysqli_fetch_assoc($apiResult)){
					$tmp = array();
					$tmp['Operator'] = $row['Operator'];
					$tmp['Count'] = $row['Count'];
					$data[] = $tmp;
				}

			} else {
				$error['description'] = "The station specified in the requested URL does not exist. Read the documents at https://trainservice.herokuapp.com/#APIDiv";
			}
		} else {
			$error['description'] = "The TLC code is not included in the requested URL. Read the documents at https://trainservice.herokuapp.com/#APIDiv";
		}
	} else {
		$error['description'] = "The API key included in the requested URL is not valid. Read the documents at https://trainservice.herokuapp.com/#APIDiv";
	}
} else {
	$error['description'] = "The API key is not included in the requested URL. Read the documents at https://trainservice.herokuapp.com/#APIDiv";
}

if (isset($error['description'])) {
	$response[] = $error;
}

echo json_encode($response);
?>