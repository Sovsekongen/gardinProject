<?php
include 'dbConnect.php';
include 'salt.php';

$response = array();

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['Email']) && isset($input['Password']) && isset($input['Name']))
{
	$email = $input['Email'];
	$password = $input['Password'];
	$name = $input['Name'];

	if(!userExists($email))
	{
		$salt = getSalt();
		$passwordHash = password_hash(concatPasswordWithSalt($password, $salt), PASSWORD_DEFAULT);
		$insertQuery = "INSERT INTO User(Email, Password, Name, Salt) VALUES (?,?,?,?)";
		if($stmt = $con->prepare($insertQuery))
		{
			error_log("Run query");
			$stmt->bind_param("ssss", $email, $passwordHash, $name, $salt);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "User created";
			$stmt->close();
		}
		else
		{
			$response["status"] = 3;
			$response["message"] = "Unable to Connect to DB";
		}

	}
	else
	{
		error_log("Reached aleready exists");
		$response["status"] = 1;
		$response["message"] = "User exists";
	}
}
else
{
	error_log("Missing Params");
	$response["status"] = 2;
	$response["message"] = "Missing mandatory parameters";
}
echo json_encode($response);
?>
