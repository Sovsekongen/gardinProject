<?php
header('Content-type: application/json; charset=utf-8');
$response = array();
include 'dbConnect.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input[0]))
{
	$email = $input[0];
	$query = "SELECT * FROM Tracker WHERE bikeOwner = ?";
	
	if($stmt = $con->prepare($query))
	{
		$stmt->bind_param("s", $email);
		$stmt->execute();
		
		if($res = $stmt->get_result())
		{
			if($res->num_rows > 0)
			{
				echo json_encode($res->fetch_all(MYSQLI_ASSOC));
			}
			else
			{
				var_dump($response);
				$response['message'] = "No results returned";
				$response['email'] = $email;
				$response['query'] = $query;
				echo json_encode($response);
			}
		}
		else
		{
			var_dump($response);
			$response['message'] = "Resultset Failed";
			$response['query'] = $query;
			$response['email'] = $email;
			echo json_encode($response);
		}
		
		$stmt->close();
	}
	else
	{
		var_dump($response);
		$response['message'] = "Unavailable?";
		$response['query'] = $query;
		$response['email'] = $email;
		echo json_encode($response);
	}
}
else
{
	var_dump($response);
	$response['message'] = "No owner";
	$response['query'] = $query;
	echo json_encode($response);
}
?>