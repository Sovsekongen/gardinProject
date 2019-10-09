<?php
header('Content-type: application/json; charset=utf-8');
include 'dbConnect.php';

$response = array();
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['location']))
{
    $name = $input['location'];

    $query = "SELECT tempVal, humVal FROM sensorData WHERE location = ?";

    if($stmt = $con ->prepare($query))
    {
        $stmt->bind_param("s", $name);

        if($stmt->execute())
        {
            $stmt->bind_result($valT, $valH);

            if($stmt->fetch())
            {
                $response["status"] = 0;
                $response["message"] = "Success";
                $response["valH"] = $valH;
                $response["valT"] = $valT;
            }
            else
            {
                $response["status"] = 1;
                $response["message"] = "Unable to fetch";
                $response["valH"] = 0;
                $response["valT"] = 0;
            }
        }
        else
        {
            $response["status"] = 2;
            $response["message"] = "unable to execute";
            $response["valH"] = 0;
            $response["valT"] = 0;
        }
    }
    else
    {
        $response["status"] = 3;
        $response["message"] = "Unable to run query";
        $response["valH"] = 0;
        $response["valT"] = 0;
    }
}
elseif(isset($input['nameArr']) && isset($input['dateFrom']) && isset($input['dateTo']))
{
    $nameArr = $input['nameArr'];
    $dateFrom = $input['dateFrom'];
    $dateTo = $input['dateTo'];

    $queryBetween = "SELECT val, valH FROM $nameArr WHERE rec BETWEEN '$dateFrom' AND '$dateTo';";

    if($stmtBetween = $con->prepare($queryBetween))
    {

        if($stmtBetween->execute())
        {
            if($res = $stmtBetween->get_result())
            {
                if($res->num_rows > 0)
                {
                    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
                }
                else
                {
                    $response["status"] = 1;
                    $response["message"] = "no results";
                }
            }
            else
            {
                $response["status"] = 1;
                $response["message"] = "Unable to fetch";
            }
        }
        else
        {
            $response["status"] = 2;
            $response["message"] = "unable to execute";
        }
    }
    else
    {
        $response["status"] = 3;
        $response["faultNO"] = $con->connect_errno;
        $response["fault"] = $con->connect_error;
        $response["errNO"] = $stmtBetween->errno;
        $response["err"] = $stmtBetween->error;
        $response["message"] = "Unable to run query";
    }
}
else
{
    $response["message"] = "Remember to set input";
    $response["status"] = 3;
}
echo json_encode($response);
