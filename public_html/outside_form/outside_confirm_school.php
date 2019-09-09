<?php
// connect to the database
require_once("../../resources/config/config.php");
require_once("../../resources/css/outside_style.css");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//select school to be outputted
$school_id = $_REQUEST["pin"];

$sql = "SELECT school_name FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo "<p> You are set to update <b>" . $row["school_name"] . "</b>.</p>";
		  echo "<button onclick=\"GetSchool()\">Re-enter PIN</button>";
		  echo "<button onclick=\"OpenForm('" . $school_id . "', '" . $row["school_name"] . "')\">Confirm</button>";

              }
          } else {
              echo "Sorry, our records cannot find any school associated with this pin. Please try again.";
              echo "<button onclick=\"GetSchool()\">Re-enter PIN</button>";
          }

?>
