<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQYN020CihWfnLSA16KJ8Etrj1RBxbU9Q&callback=initMap"></script>
<body style="margin:0px; padding:0px;" onload="initialize()">
<?php
// connect to the database
require_once("../../resources/config/config.php");
require_once("../../resources/css/public_style.css");
//require_once("../resources/style.css");
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
echo "<button onclick=\"return_to_schools()\">Back</button><br></br>";

$sql = "SELECT * FROM schools
inner join address on schools.address_id=address.address_id
 where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo "<h2>" . $row["school_name"] . "</h2>
		<h3>" . $row["street"] . "<br>"
		. $row["city"] . ", " . $row["state"] . $row["zip"] . "</h3>
		<h4><a href=\"https://" . $row["website"] . "\" target=\"_top\">" . $row["website"] . "</a></h4>";
	  }

          } else {
              echo "0 results";
          }

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
		while($row = $result->fetch_assoc()) {
	  echo "<table>
          <tr><th>". $row["pubdate"].  " Enrollment Year</th><td></td></tr>" .
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
        "<tr><td>Comments: </td><td>" . $row["other"]. "</td></tr><br>" ;

            }
        } else {
            echo "0 results";
        }


echo "</section><aside class=\"mapaside\"><iframe src=\"../map.php?map_address=" . $mapAddress . "\" height=\"200\" width=\"680\" align=\"Center\"></iframe></aside>";


$sql = "SELECT * FROM enr_stats where school_id = $school_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><th>Current Enrollment</th><td></td></tr>" .
        "<tr><td>9th: </th><td>" . $row["freshmen"]. "</th></td>" .
        "<tr><td>10th: </th><td>" . $row["sophomore"]. "</th></td>" .
        "<tr><td>11th: </th><td>" . $row["junior"]. "</th></td>" .
        "<tr><td>12th: </th><td>" . $row["senior"]. "</th></td>" ;

            }
        } else {
            echo "0 results";
        }

$sql = "SELECT * FROM demo where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><th>Estimated Ethnicity Percentages</th><td></td></tr>" .
        "<tr><td>Asian: </th><td>" . $row["percent_asian"]. "</td></tr>" .
        "<tr><td>Black: </th><td>" . $row["percent_black"]. "</td></tr>" .
        "<tr><td>Hispanic: </th><td>" . $row["percent_hispanic"]. "</td></tr>" .
        "<tr><td>White: </th><td>" . $row["white"]. "</td></tr>" .
        "<tr><td>Other: </th><td>" . $row["percent_other"]. "</td></tr>" .
        "<tr><td>Lutheran: </th><td>" . $row["percent_lutheran"]. "</td></tr>" ;

            }
        } else {
            echo "0 results";
        }


$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               // echo "</section><section><table><tr><th></th></tr>" .
        echo "<tr><th>Faculty</th><td></td></tr>" .
        "<tr><td>Full Time:</th><td>" . $row["full_time_staff"]. "</th></td>" .
        "<tr><td>Part Time: </th><td>" . $row["part_time_staff"]. "</th></td>";
            }
        } else {
            echo "0 results";
        }

        //Display School's director info
        $sql = "SELECT positions.title_id, positions.name, positions.email, title.title_id,
        title.title
        FROM title
        INNER JOIN positions ON title.title_id=positions.title_id
        where school_id = $school_id";
        $result = $conn->query($sql);

	echo "<tr><th>Directors</th><td></td></tr>";
        if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "<tr><td>" . $row["title"] . "</td><td> " . $row["name"]
                      . "</td><td> " . $row["email"] . "</td></tr></section>";

                  }
              } else {
                  echo "0 results";
              }

        //close database connection
        $conn->close();
        ?>
