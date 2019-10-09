<?php
$response = array();
include 'dbAccessUpdate.php';
include '../../login/html/salt.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
$salt = "";

if(isset($input['DevID']) && isset($input['DevPin']))
{
    $devId = $input['DevID'];
    $devPin = $input['DevPin'];
    $query = "UPDATE Tracker SET pin = ? WHERE deviceId = ?";
    $queryGetSalt = "SELECT Salt FROM User, Tracker WHERE Tracker.deviceId = ? AND Tracker.bikeOwner = User.Email";

    if($stmt = $con->prepare($queryGetSalt))
    {
        $stmt->bind_param("s", $devId);
        $stmt->execute();
        $stmt->bind_result($salt);
        if($stmt->fetch())
        {
            $response["status"] = 0;
            $response["message"] = "Fetched Salt";
        }
        else
        {
            $response["status"] = 3;
            $response["message"] = "Unable to fetch salt";
        }
        $stmt->close();
    }
    else
    {
        $response["status"] = 3;
        $response["message"] = "Unable to fetch salt";
    }

    if($salt != "")
    {
        $pinHash = password_hash(concatPasswordWithSalt($devPin, $salt), PASSWORD_DEFAULT);
        $stmt->reset();
        if($stmt = $con->prepare($query))
        {
            $stmt->bind_param("ss", $pinHash, $devId);

            if($stmt->execute())
            {
                $response["status"] = 0;
                $response["message"] = "Updated Pin";
            }
            else
            {
                $response["status"] = 3;
                $response["message"] = "Unable to update pin";
            }
           $stmt->close();
        }
        else
        {
            $response["status"] = 3;
            $response["message"] = "Unable to connect to db";
        }
    }
}
else
{
    $response["status"] = 2;
    $response["message"] = "Wrong parameters";
}

echo json_encode($response);