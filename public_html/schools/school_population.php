<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

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
$school_id = $_REQUEST[school_id];

$sql = "SELECT * FROM enr_stats where school_id = $school_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<table><tr><td>Enrollment year:</td><td>" . $row["year"] . "</td></tr>";
            }
        } else {
            echo "0 results";
        }

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
		echo "<h3>" . $row["school_name"]."</h3>".

                 "<button id='edit' onclick=\"loadTab('Population', 'schools/school_population_update.php?school_id=', $school_id)\">Edit</button>" .

	"<tr><th>Faculty</th><td></td></tr>" .
        "<tr><td>Full Time:</th><td>" . $row["full_time_staff"]. "</th></td>" .
        "<tr><td>Part Time: </th><td>" . $row["part_time_staff"]. "</th></td>";
            }
        } else {
            echo "0 results";
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
        "<tr><td>White: </th><td>" . $row["percent_white"]. "</td></tr>" .
        "<tr><td>Other: </th><td>" . $row["percent_other"]. "</td></tr>" .
        "<tr><td>Lutheran: </th><td>" . $row["percent_lutheran"]. "</td></tr></section>" ;

            }
        } else {
            echo "0 results";
        }

//close database connection
$conn->close();
?>
