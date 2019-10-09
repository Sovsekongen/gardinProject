<?php
$response = array();
include 'dbConnect.php';
include 'salt.php';

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

if(isset($input['Email']) && isset($input['Password']))
{
	$email = $input['Email'];
	$password = $input['Password'];
	$query = "SELECT Email, Password, Salt FROM User WHERE Email = ?";
	if($stmt = $con->prepare($query))
	{
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($name, $passwordHashDB, $salt);
		if($stmt->fetch())
		{
			if(password_verify(concatPasswordWithSalt($password, $salt), $passwordHashDB))
			{
				$response["status"] = 0;
				$response["message"] = "Login Successfull";
				$response["name"] = $name;
			}
			else
			{
				$resposne["status"] = 1;
				$response["message"] = "Invalid username and password combination";
			}
		}
		else
		{
			$resposne["status"] = 1;
             $response["message"] = "Invalid username and password combination";
		}

		$stmt->close();
	}
}
else
{
	$response["status"] = 2;
	$response["message"] = "Missing required params";
}

echo json_encode($response);
?>
