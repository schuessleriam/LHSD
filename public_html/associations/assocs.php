<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQYN020CihWfnLSA16KJ8Etrj1RBxbU9Q&callback=initMap"></script>
<body style="margin:0px; padding:0px;" onload="initialize()">

<div class="subtab" style="overflow:hidden;">
<button class="subtablinks" onclick="loadSimpleTab('Associations', 'list_assocs.php');">Back</button>
</div>

<?php
// connect to the database
require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<section class=\"infoaside\">";
//select school to be outputted
//$school_id = $_GET[school_id];
$assoc_id = $_REQUEST["assoc_id"];

$sql = "SELECT * FROM assocs where assoc_id = $assoc_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo "<h3>" . $row["assoc_name"]."</h3>".


          "<table><tr><td>Mail Label:</th><td>" . $row["mail_label"]. "</td></tr>" .
          "<tr><td>Website: </th><td>" .  $row["website"]  . "</td></tr>";
          $address=$row["address_id"];

              }
          } else {
              echo "0 results";
          }


$sql = "SELECT * FROM address where address_id = $address";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
             while($row = $result->fetch_assoc()) {
                  echo "<tr><td>Address:</td><td>" . $row["street"].
          " " . $row["city"] . ", " . $row["state"] . "</td></tr>" .
          "<tr><td>Zip:</td><td>" . $row["zip"]. "</td></tr>" .
          "<tr><td>Country: </td><td>" .  $row["country"]  . "</td></tr>";

        $mapAddress=$row["city"] . "," . $row["state"] . "," .  $row["country"];
              }
          } else {
              echo "0 results";
          }

//remove school
echo "<tr><td><button id='addrem' onclick=\"delete_association($assoc_id)\">REMOVE ASSOCIATION</button></td><td></td></tr>";


//close database connection
$conn->close();

echo "</section><aside class=\"mapaside\"><iframe src=\"map.php?map_address=" . $mapAddress . "\" height=\"400\" width=\"400\" align=\"right\"></iframe></aside>";

?>
