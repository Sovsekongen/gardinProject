<?php
$response = array();
include 'dbAccessUpdate.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['DevID']) && isset($input['DevName']) && isset($input['DevOwner']) && isset($input['DevColour']) && isset($input['DevIconID']) && isset($input['DevPin']))
{
	$devID = $input['DevID'];
	$devName = $input['DevName'];
	$devColour = $input['DevColour'];
	$devOwner = $input['DevOwner'];
	$devIconID = $input['DevIconID'];
	$devPin = $input['DevPin'];
	
	$addQuery = "INSERT INTO Tracker(deviceId, trackerName, iconId, colour, bikeOwner, pin) VALUES (?, ?, ?, ?, ?, ?)";
	
	if($stmt = $con->prepare($addQuery))
	{
		$stmt-> bind_param("ssssss", $devID, $devName, $devIconID, $devColour, $devOwner, $devPin);
		 
		if($stmt->execute())
		{
			$response["message"] = "Succes!";
			$response["status"] = 0;
		}
		else
		{
			$response["message"] = "Unable to add to db";
			$response["status"] = 1;
		}
		
		$stmt->close();
	}
	else
	{
		$response["message"] = "Unable to connect to DB";
		$response["status"] = 4;
	}
}
else
{
	$response["message"] = "Input proper information";
	$response["status"] = 3;
}

echo json_encode($response);
?>