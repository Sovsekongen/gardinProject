<?php
$response = array();
include 'dbConnect.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['DevID']))
{
	$devID = $input['DevID'];
	$query = "SELECT lastSeen, latLocation, longLocation FROM DevLocation WHERE DeviceId = ?";
	
	if($stmt = $con->prepare($query))
	{
		$stmt->bind_param("s", $devID);
		$stmt->execute();
		$stmt->bind_result($lastSeen, $latLocation, $longLocation);
		
		if($stmt->fetch())
		{
			$response["lastSeen"] = $lastSeen;
			$response["latLocation"] = $latLocation;
			$response["longLocation"] = $longLocation;
			$response["message"] = "Succes!";
			$response["status"] = 0;
		}
		else
		{
			$response["lastSeen"] = 0;
			$response["latLocation"] = 0;
			$response["longLocation"] = 0;
			$response["message"] = "Unable to Fetch";
			$response["status"] = 1;
		}
		
		$stmt->close();
	}
	else
	{
		$response["lastSeen"] = 0;
		$response["latLocation"] = 0;
		$response["longLocation"] = 0;
		$response["message"] = "Please enter valid Device ID";
		$response["status"] = 4;
	}
}
else
{
	$response["lastSeen"] = 0;
	$response["latLocation"] = 0;
	$response["longLocation"] = 0;
	$response["message"] = "Remember to input DeviceID";
	$response["status"] = 3;
}

echo json_encode($response);
?>