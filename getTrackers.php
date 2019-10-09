<?php
$response = array();
include 'db_adgang.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['Owner']))
{
	$email = $input['Owner'];
	$query = "SELECT * FROM Tracker WHERE Owner = ?";
	
	if($stmt = $con->prepare($query))
	{
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$response = $stmt->get_result();
		
		$stmt->close();
	}
	else
	{
		$resposne['message'] = "Unavailable?";
	}
}
else
{
	$response['message'] = "No owner";
}

echo json_encode($response->fetch_fields());
?>