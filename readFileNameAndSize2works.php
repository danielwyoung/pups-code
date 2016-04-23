<?php

$servername = "localhost";
$username = "popcorn";
$password = "melvin99!";
$dbname = "professional_test123";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else 
$ppppath = "/home/professional/www/dan/myFiles";
processDir($ppppath,$conn);

function processDir($path,$connin)
{
    if ($handle = opendir($path))
    {
        while (false !== ($file = readdir($handle)))
        {
            if ('.' === $file) continue;
            if ('..' === $file) continue;

            $full_path = $path.'/'.$file;

            if(is_dir($full_path))
                processDir($full_path,$connin);
            } 
            else
            {
                $title = pathinfo($file,PATHINFO_BASENAME);
                $size = filesize($full_path);

                $sql = "UPDATE Files SET Size = '$size' WHERE Name = '$title'";
                if ($connin->query($sql) === TRUE)
                {
                    echo "Record updated successfully";
		        } 
                else 
                {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    closedir($handle);
    }
}
$conn->close();










?>