<?php
$response = array();
include 'dbConnect.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['DevID']))
{
    $devId = $input['DevID'];

    $query = "SELECT pin FROM Tracker WHERE deviceId = ?";

    if($stmt = $con->prepare($query))
    {
        $stmt->bind_param("s", $devId);

        if($stmt->execute())
        {
            $stmt->bind_result($pin);

            if($stmt == null)
            {
                $response["message"] = "Pin is not set.";
                $response["status"] = 0;
                $response["pinSet"] = false;
            }
            else
            {
                $response["message"] = "Pin has been set.";
                $response["status"] = 0;
                $response["pinSet"] = true;
            }
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