<?php
$servername = "localhost";
$username = "*******";
$password = "***********";
$dbname = "***********";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//DO NOT EDIT ABOVE THIS LINE----------

echo "
    <form action = 'c_searchresults.php'> 
        <input name='search_zip'>
        </input>
        <input type='submit'>
        </input>
    </form>";
$primaryZip = $_GET["search_zip"];                
$sql = 'SELECT `business_name` as BusinessName, phone, primary_state, primary_country_code, primary_city, primary_zip, public_email, general_location
            FROM Businesses 
            WHERE business_name <>"" 
              AND primary_zip = "'.$primaryZip.'"
            LIMIT 30';
$result = mysqli_query($con, $sql);
print("<table style='border: 1px solid black; table-layout: fixed; width: 1200px;'>");
while ($row = mysqli_fetch_assoc($result))
{
     //debugging - uncomment to prints the name retreived from the DB at the top of the page
     //echo "my business name is ";
     //echo $row['BusinessName'];

     /*add new element to end of the block list for the template*/
       echo "<tr>
               <td>
                   <div style='word-wrap: break-word;'>$row[BusinessName]
                   <br/>
                   $row[phone]
                   <br/>
                   $row[public_email]</div>
                </td>
                <td>
                    <div style='word-wrap: break-word;'>AREA: $row[general_location]</div>
                    <br/>
                    <div style='word-wrap: break-word;'>ZIPS:$row[primary_zip]</div>
                </td>
                <td>
                    <div style='word-wrap: break-word;'>CITIES: $row[primary_city]</div>
                </td>
                <td>
                    STATE: $row[primary_state]
                </td>
                <td>
                    COUNTRY: $row[primary_country_code]
                </tr>
                <tr>
                    <td>
                        ________________
                    </td>
                </tr>";
/*   print("<tr>");
     print("<td>");
     print("<div style='word-wrap: break-word;'>ZIPS: $row[BusinessName]</div>");
     print("<br/>");
     print("$row[phone]");
     print("<br/>");
     print("$row[public_email]");
     print("</td>");
     print("<td>");
     print("<div style='word-wrap: break-word;'>AREA: $row[general_location]</div>");
     print("<br/>");
     print("<div style='word-wrap: break-word;'>ZIPS:$row[primary_zip]</div>");
     print("</td>");
     print("<td>");
     print("<div style='word-wrap: break-word;'>CITIES: $row[primary_city]</div>");
     print("</td>");
     print("<td>STATE: $row[primary_state]</td>");
     print("<td>COUNTRY: $row[primary_country_code]</td>");
     print("</tr>");
     print("<tr><td>________________</td></td>");
*/
}
echo "</table>";

?>