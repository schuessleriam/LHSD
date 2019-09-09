<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<body style="margin:0px; padding:0px;" onload="initialize()">
<?php
// connect to the database
require_once("../../resources/config/config.php");
require_once("../../resources/css/style.css");

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

	  echo "<br><br><h3><br></h3>
		<br><br>
                <h4>Current stored information:</h4><br>";

          echo "<table id='update_tbl'>
          <tr><td>Website: </th><td>" .  $row["website"]  . "</td></tr>";
          $address=$row["address_id"];

              }
          } else {
              echo "There are currently no updates to process.";
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
              }
          } else {
              echo "There are currently no updates to process.";
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
              echo "There are currently no updates to process.";
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
              echo "There are currently no updates to process.";
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
            echo "<tr><td>No Affiliation</td><td></td></tr>";
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
            echo "There are currently no updates to process.";
        }


$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
        echo "<tr><th>Faculty</th><td></td></tr>" .
        "<tr><td>Full Time:</th><td>" . $row["full_time_staff"]. "</th></td>" .
        "<tr><td>Part Time: </th><td>" . $row["part_time_staff"]. "</th></td>";
            }
        } else {
            echo "There are currently no updates to process.";
        }


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
            echo "There are currently no updates to process.";
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
        "<tr><td>White: </th><td>" . $row["percent_white"]. "</td></tr>" .
        "<tr><td>Other: </th><td>" . $row["percent_other"]. "</td></tr>" .
        "<tr><td>Lutheran: </th><td>" . $row["percent_lutheran"]. "</td></tr></section>" ;

            }
        } else {
            echo "There are currently no updates to process.";
        }

// Display Graduation Statistics
$sql = "SELECT * FROM grad_stats where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<table id='update_tbl'><tr><th>Graduation Statistics</th><td></td></tr>" .
        //"<tr><td>Enrollment Year: </td><td>" . $row["year"]. "</td></tr>" .
        "<tr><td>Graduates: </td><td>" . $row["grad_num"]. "</td></tr>" .
        "<tr><td>Lutheran Graduates: </td><td>" . $row["luth_grad_num"]. "</td></tr>" .
        "<tr><td>Total Percent to College: </td><td>" . $row["percent_to_clg"]. "</td></tr>" .

        "<tr><th>Graduates </th><td></td></tr>" .
        "<tr><td>Lutheran College/University: </td><td>" . $row["grads_at_luth"]. "</tr></tr>" .
        "<tr><td>Non-Lutheran College/University: </td><td>" . $row["grads_at_nonluth"]. "</td></tr>" .
        "<tr><td>Public College/University: </td><td>" . $row["grads_at_public"]. "</td></tr>" .

        "<tr><th>Lutheran Graduates</th><td></td></tr>" .
        "<tr><td>Lutheran College/University: </td><td>" . $row["luth_grads_at_luth"]. "</td></tr>" .
        "<tr><td>Private College/University: </td><td>" . $row["luth_grads_at_priv"]. "</td></tr>" .
        "<tr><td>Public College/University: </td><td>" . $row["luth_grads_at_public"]. "</td></tr>" ;

            }
        } else {
            echo "There are currently no updates to process.";
        }

// Display School's director info
        $sql = "SELECT positions.title_id, positions.name, positions.email, title.title_id,
        title.title
        FROM title
        INNER JOIN positions ON title.title_id=positions.title_id
        where school_id = $school_id";
        $result = $conn->query($sql);

echo "<tr><th>Directors</th><td></td><td></td></tr>";

        if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "<tr><td>" . $row["title"] . "</td><td> " . $row["name"]
                      . "</td><td> " . $row["email"] . "</td></tr></section>";

                  }
              } else {
                  echo "There are currently no updates to process.";
              }

        //close database connection
        $conn->close();
        ?>
