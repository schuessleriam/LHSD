<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

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
$school_id = $_REQUEST["school_id"];


//retreive staff data from school table
$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
            while($row = $result->fetch_assoc()) {
		echo "<h3>" . $row["school_name"]."</h3>".
"<button id='back' onclick=\"loadTab('Population', 'schools/school_population.php?school_id=', $school_id)\">Back</button>
<form id=\"update_population\" name=\"destination\">
     <input type=\"hidden\" name=\"school_id\" value=\"" . $school_id  . "\">
<table>
<tr><td>Enrollment Year:</th><td> <input type=\"text\" name=\"year\" value=\"" . date("Y") . "\"></td></tr>
<tr><th>Faculty</th><td></td></tr>
<tr><td>Full Time:</th><td>
    <input type=\"text\" name=\"full_time\" value=\"" . $row["full_time_staff"]. "\"></td></tr>
<tr><td>Part Time:</th><td>
    <input type=\"text\" name=\"part_time\" value=\"" . $row["part_time_staff"]. "\"></td></tr>";

    }
} else {
echo "0 results";
}

//select enrollment data for default values
$sql = "SELECT * FROM enr_stats where school_id = $school_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

//create inputes with current values as default
echo "<tr><th>Current Enrollment</th><td></td></tr>
<tr><td>9th: </th><td>
    <input type=\"text\" name=\"freshmen\" value=\"" . $row["freshmen"]. "\"></td></tr>
<tr><td>10th: </th><td>
    <input type=\"text\" name=\"sophomore\" value=\"" . $row["sophomore"]. "\"></td></tr>
<tr><td>11th: </th><td>
    <input type=\"text\" name=\"junior\" value=\"" . $row["junior"]. "\"></td></tr>
<tr><td>12th: </th><td>
    <input type=\"text\" name=\"senior\" value=\"" . $row["senior"]. "\"></td></tr>";

    }
} else {
    echo "0 results";
}


//select demographics data for default values
$sql = "SELECT * FROM demo where school_id = $school_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
      while($row = $result->fetch_assoc()) {

//create inputes with current values as default
echo "<tr><th>Estimated Ethnicity Percentages</th><td></td></tr>" .
"<tr><td>Asian: </th><td>
    <input type=\"text\" name=\"percent_asian\" value=\"" . $row["percent_asian"]. "\"></td></tr>
<tr><td>Black: </th><td>
    <input type=\"text\" name=\"percent_black\" value=\"" . $row["percent_black"]. "\"></td></tr>
<tr><td>Hispanic: </th><td>
    <input type=\"text\" name=\"percent_hispanic\" value=\"" . $row["percent_hispanic"]. "\"></td></tr>
<tr><td>White: </th><td>
    <input type=\"text\" name=\"percent_white\" value=\"" . $row["percent_white"]. "\"></td></tr>
<tr><td>Other: </th><td>
    <input type=\"text\" name=\"percent_other\" value=\"" . $row["percent_other"]. "\"></td></tr>
<tr><td>Lutheran: </th><td>
    <input type=\"text\" name=\"percent_lutheran\" value=\"" . $row["percent_lutheran"]. "\"></td></tr>
</section>";

    }
} else {
    echo "0 results";
}

//close database connection
$conn->close();

echo "<input id=\"submit\" onclick=\"update_population($school_id)\" name= \"submit\" type=\"button\" value=\"Submit\">";
?>
</form>
