<!DOCTYPE html>
<!--Author:
  Date:
  File:   FixIt1.php
-->

<html>
<head>
  <title>parse test</title>
</head>
<body>
  
<?php

$servername = "localhost";
$username = "*******";
$password = "**************";
$dbname = "***********";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT mbuserid, Country, State, Cities FROM Business LIMIT 10";
  $result = mysqli_query($con, $sql);


  print ("<h1>LIST OF CITIES FROM DB</h1>");
  while ($row = mysqli_fetch_assoc($result))
  {
    $mbuserid = ($row['mbuserid']);
    $getCountry = ($row['Country']);
    $getState = ($row['State']);
    $getCities = ($row['Cities']);
    $splitCities = explode(",", $getCities);
    $city_order = 0;
    foreach ($splitCities as $value)
    {
      $city_order++;
      updateCitiesTable($con, $mbuserid, $getCountry, $getState, $value, $city_order);
    }
  } 


function updateCitiesTable($connection, $userID, $country, $state, $city, $cityOrder)
{
  $sql = "INSERT INTO BusinessCities(user_id, country, state, city, city_order)
  VALUES ($userID, '$country', '$state', '$city', $cityOrder)";

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
