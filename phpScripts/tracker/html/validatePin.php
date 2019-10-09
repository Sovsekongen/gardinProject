<?php
$response = array();
include 'dbAccessUpdate.php';
include '../../login/html/salt.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['DevID']) && isset($input['DevPin']))
{
    $devId = $input['DevID'];
    $devPin = $input['DevPin'];
    $query = "SELECT Tracker.pin, User.Salt FROM Tracker, User WHERE Tracker.bikeOwner = User.Email AND Tracker.deviceId = ?;";

    if($stmt = $con->prepare($query))
    {
        $stmt->bind_param("s", $devId);
        $stmt->execute();
        $stmt->bind_result($pinHash, $salt);

        if($stmt->fetch())
        {
            if(password_verify(concatPasswordWithSalt($devPin, $salt), $pinHash))
            {
                $response["status"] = 0;
                $response["message"] = "Pin Verified";
            }
            else
            {
                $response["status"] = 1;
                $response["message"] = "Wrong Pin";
            }
        }
        $stmt->close();
    }
    else
    {
        $response["status"] = 3;
        $response["message"] = "Unable to connect to DB. Perhaps something wrong with query?";
    }
}
else
{
    $response["status"] = 2;
    $response["message"] = "Missing required params";
}

echo json_encode($response);
?>