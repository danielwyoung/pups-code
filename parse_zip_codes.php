<!DOCTYPE html>
<!--Author: Dan Young
	Date:		4/22/16
	File:	  parse_zip_codes.php
	Original database table has a field called userid and a field called zipcodes. zipcodes is a string of comma delimited zip codes.  This program reads in the userid and zipcode field 1 at a time and parses the zipcode field to create individual userid/zipcode records.  The record is then written to a new (normalized) table. 

	Input: DB of username and zipcode strings
	Output: None
-->

<html>
<head>
	<title>parse zipcodes</title>
</head>
<body>
	
<?php

$servername = "localhost";
$username = "******";
$password = "********";
$dbname = "*************";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

	$sql = "SELECT userid, Zips FROM company WHERE Zips <> '' LIMIT 10";
	$result = mysqli_query($con, $sql);


	print ("<h1>LIST OF STUFF FROM DB</h1>");
	while ($row = mysqli_fetch_assoc($result))
	{
		$userid = $row['userid'];
		$getZips = ($row[Zips]);
		$splitZips = explode(",", $getZips);
		$zip_order = 0;
		foreach ($splitZips as $value)
		{
			$zip_order++;
			updateZipsTable($con, $userid, $value, $zip_order);
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
	$sql = "INSERT INTO companyZips(userid, zip, zip_order)
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
