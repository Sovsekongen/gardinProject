<?php
/*
require_once('db_connect.php');
$db = new DB_CONNECT();

if(isset($_GET['name']))
{
	$name = $_GET['name'];
	$result = mysqli_query($db->myCon, "SELECT value FROM sensor WHERE name = '$name'");

	$rowData = mysqli_fetch_array($result);
	$data = $rowData[0];

	if($data)
	{
		echo $data;
	}
}
else if(isset($_GET['nameArr']) && isset($_GET['date1']) && isset($_GET['date2']))
{
	$date1 = $_GET['date1'];
	$date2 = $_GET['date2'];
	$nameArr = $_GET['nameArr'];
	$valType = $_GET['valType'];

	if($valType == 'temp')
	{
		$result = mysqli_query($db->myCon, "SELECT val FROM $nameArr WHERE rec BETWEEN '$date1' AND '$date2';");
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				echo $row["val"] . "\r\n";
			}
		}
	}
	else if($valType == 'hum')
	{
		$result = mysqli_query($db->myCon, "SELECT valH FROM $nameArr WHERE rec BETWEEN '$date1' AND '$date2';");
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				echo $row["valH"] . "\r\n";
			}
		}
	}
}

/*
if (mysqli_connect_errno($con)) 
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$name = $_GET['name'];
$result = mysqli_query($con,"SELECT value FROM sensor WHERE name = '$name'");
$row = mysqli_fetch_array($result);
$data = $row[0];

if($data)
{
	echo $data;
}

mysqli_close($con);  */

?>
