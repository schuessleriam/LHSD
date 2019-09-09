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

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<h3>" . $row["school_name"]."</h3>".

                 "<button id='edit' onclick=\"loadTab('Grad_stats',
                 'schools/school_grad_stats_update.php?school_id=',
                 $school_id)\">Edit</button>";
		}
	}
$sql = "SELECT * FROM grad_stats where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<table><tr><th>General</th><td></td></tr>" .
        "<tr><td>Enrollment Year: </td><td>" . $row["year"]. "</td></tr>" .
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
            echo "0 results";
        }

        //close database connection
        $conn->close();
        ?>
