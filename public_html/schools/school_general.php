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
$school_id = $_REQUEST["school_id"];

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo "<h3>" . $row["school_name"]."</h3>".


          "<button id='edit' onclick=\"loadTab('gen', 'schools/school_general_update.php?school_id=', $school_id)\">Edit</button>" .       
          "<table><tr><td>Data Tel ID:</th><td>" . $row["data_tel_id"]. "</td></tr>" .
          "<tr><td>Public: </th><td>"; if($row["public"]){echo "yes";} else{echo "no";} echo "</td></tr>" .
	  "<tr><td>Last Update: </th><td>" . $row["pubdate"]. "</td></tr>" .
          "<tr><td>Website: </th><td>" .  $row["website"]  . "</td></tr>
	  <tr><td>Mail Label: </th><td>" .  $row["mail_label"]  . "</td></tr>";
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

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          echo "<tr><td>Boarding school:</td><td> ";
            if($row["boarding_school"]){
              echo "Yes</td></tr>";
            }

            else{
               echo "No</td></tr>";
            }

          echo "<tr><td>Phone:</th><td> " . $row["phone"]. "</td></tr>" .
          "<tr><td>Fax:</th><td> " . $row["fax"]. "</td></tr>" .
          "<tr><td>Email:</th><td> " .  $row["email"]  . "</td></tr>";

              }
          } else {
              echo "0 results";
          }




//details

          $sql = "SELECT * FROM schools where school_id = $school_id";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {

           echo
          "<tr><td>Founded:</td><td> " . $row["founded"]. "</td></tr>" .
          "<tr><td>Accreditation:</td><td> " . $row["accred"]. "</td></tr>" ;
          $aff=$row[affiliation];

              }
          } else {
              echo "0 results";
          }


$sql = "SELECT * FROM affil where affil_id = $aff";
$result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

         echo
        "<tr><td>Affiliation:</td><td> " . $row["description"] . " (" . $row["code"] .  ")</td></tr>";
            }
         }
         else {
            echo "<tr><td>No Affiliation</td></tr>";
        }

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

         echo
        "<tr><td>Member Tuition:</td><td> " . $row["member_tut"]. "</td></tr>" .
        "<tr><td>Non-Member Tuition: </td><td>" . $row["nonmember_tut" ]. "</td></tr>" .
        "<tr><td>Comments: </td><td>" . $row["other"]. "</td></tr>" ;

            }
        } else {
            echo "0 results";
        }

//remove school
echo "<tr><td><button id='addrem' onclick=\"delete_school($school_id)\">REMOVE SCHOOL</button></td><td></td></tr>";
//close database connection
$conn->close();

echo "</section><aside class=\"mapaside\"><iframe src=\"map.php?map_address=" . $mapAddress . "\" height=\"400\" width=\"400\" align=\"right\"></iframe></aside>";

?>
