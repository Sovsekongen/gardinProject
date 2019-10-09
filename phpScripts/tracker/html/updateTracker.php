<?php
$response = array();
include 'dbAccessUpdate.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['DevID']) && $input['LongLocation'] && $input['LatLocation'])
{
	$devID = $input['DevID'];
	$latLocation = $input['LatLocation'];
	$longLocation = $input['LongLocation'];
	$query = "UPDATE Tracker SET latLocation = ?, longLocation = ? WHERE DeviceId = ?";
	$insertQuery = "INSERT INTO DevLocation(DeviceId, latLocation, longLocation) VALUES (?, ?, ?)";
	
	if($stmt = $con->prepare($query))
	{
		$stmt->bind_param("sss", $latLocation, $longLocation, $devID);
		
		if($stmt->execute())
		{
			$response["message"] = "Succes!";
			$response["status"] = 0;
		}
		else
		{
			$response["message"] = "Unable to Fetch";
			$response["status"] = 1;
		}
		
		$stmt->close();
	}
	else
	{
		$response["message"] = "Unable to connect to DB";
		$response["status"] = 4;
	}
	
	if($stmt = $con->prepare($insertQuery))
    {
        $stmt->bind_param("sss", $latLocation, $longLocation, $devID);

        if($stmt->execute())
        {
            $response["messageInsert"] = "Succes!";
            $response["statusInsert"] = 0;
        }
        else
        {
            $response["messageInsert"] = "Unable to Fetch";
            $response["statusInsert"] = 1;
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