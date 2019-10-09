<?php
	define('DB_USER', "bylockuser");
	define('DB_PASSWORD', "Preacher-123");
	define('DB_DATABASE', "ByLock");
	define('DB_SERVER', 'localhost');

	$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

	if(mysqli_connect_errno())
	{
		echo "failted to connect to mysql: " . mysqli_connect_errno();
	}
?>
