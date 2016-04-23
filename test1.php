<!DOCTYPE html>
<!--Author:
	Date:
	File:	  FixIt1.php
-->

<html>
<head>
	<title>parse test</title>
</head>
<body>
	
<?php

$servername = "localhost";
$username = "popcorn";
$password = "melvin99!";
$dbname = "professional_my_m";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

	$sql = "SELECT mbuserid, Zips FROM Business WHERE Zips <> '' LIMIT 10";
	$result = mysqli_query($con, $sql);


	print ("<h1>LIST OF STUFF FROM DB</h1>");
	while ($row = mysqli_fetch_assoc($result))
	{
		$mbuserid = $row['mbuserid'];
		$getZips = ($row[Zips]);
		$splitZips = explode(",", $getZips);
		$zip_order = 0;
		foreach ($splitZips as $value)
		{
			$zip_order++;
			updateZipsTable($con, $mbuserid, $value, $zip_order);
		}
	}


function updateZipsTable($connection, $userID, $zipCode, $zipCodeOrder)
{
	$zipCode = strtoupper(trim($zipCode));
	// if zipcode is less than 2 or greater than 10 don't insert
	if (strlen($zipCode) < 2 || strlen($zipCode) > 10)
	{
		return;
	}
	$sql = "INSERT INTO BusinessZips(user_id, zip, zip_order)
	VALUES ($userID, '$zipCode', $zipCodeOrder)";


	if (mysqli_query($connection, $sql)) 
	{
    echo "New record created successfully";
	} else 
	{
    echo "Error: " . $sql . "<br>" . mysqli_error($connection);
	}

}

$con->close();
?>
</body>
</html>
