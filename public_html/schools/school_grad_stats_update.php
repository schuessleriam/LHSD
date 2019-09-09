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
$school_id = $_REQUEST[school_id];

//declare current sql values for default form values
$sql="select * from grad_stats where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
	// output data of each row
            while($row = $result->fetch_assoc()) {
        $year=$row["year"];
        $grad_num=$row["grad_num"];
        $luth_grad_num=$row["luth_grad_num"];
        $percent_to_clg=$row["percent_to_clg"];
        $grads_at_luth=$row["grads_at_luth"];
        $grads_at_nonluth=$row["grads_at_nonluth"];
        $grads_at_public=$row["grads_at_public"];
        $luth_grads_at_luth=$row["luth_grads_at_luth"];
        $luth_grads_at_priv=$row["luth_grads_at_priv"];
        $luth_grads_at_public=$row["luth_grads_at_public"];

}
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<h3>" . $row["school_name"]."</h3>".
    "<button id='back' onclick=\"loadTab('Grad_stats','schools/school_grad_stats.php?school_id=', $school_id)\">Back</button>
    <form id=\"update_grad_stats\" name=\"destination\">
    <input type=\"hidden\" name=\"school_id\" value=\"" . $school_id  . "\">";

    }
}

//place form inside table with default values
	echo "<table><tr><th>General</th><td></td></tr>" .
        "<tr><td>Enrollment Year: </th><td>
            <input type=\"text\" name=\"year\" value=\"$year\">
        </th></td>" .
        "<tr><td>Graduates: </th><td>
            <input type=\"text\" name=\"grad_num\" value=\"$grad_num\">
        </th></td>" .
        "<tr><td>Lutheran Graduates: </th><td>
            <input type=\"text\" name=\"luth_grad_num\" value=\"$luth_grad_num\">
	</th></td>" .
        "<tr><td>Total Percent to College: </th><td>
            <input type=\"text\" name=\"percent_to_clg\" value=\"$percent_to_clg\">
        </th></td>" .

        "<tr><th>Graduates </th><td></td></tr>" .
        "<tr><td>Lutheran College/University: </th><td>
            <input type=\"text\" name=\"grads_at_luth\" value=\"$grads_at_luth\">
        </th></td>" .
        "<tr><td>Non-Lutheran College/University: </th><td>
            <input type=\"text\" name=\"grads_at_nonluth\" value=\"$grads_at_nonluth\">
        </th></td>" .
        "<tr><td>Public College/University: </th><td>
            <input type=\"text\" name=\"grads_at_public\" value=\"$grads_at_public\">
        </th></td>" .

        "<tr><th>Lutheran Graduates</th><td></td></tr>" .
        "<tr><td>Lutheran College/University: </th><td>
            <input type=\"text\" name=\"luth_grads_at_luth\" value=\"$luth_grads_at_luth\">
        </th></td>" .
        "<tr><td>Private College/University: </th><td>
            <input type=\"text\" name=\"luth_grads_at_priv\" value=\"$luth_grads_at_priv\">
        </th></td>" .
        "<tr><td>Public College/University: </th><td>
            <input type=\"text\" name=\"luth_grads_at_public\" value=\"$luth_grads_at_public\">
        </th></td>";



        //close database connection
        $conn->close();
echo "<input id=\"submit\" onclick=\"update_grad_stats($school_id)\" name= \"submit\" type=\"button\" value=\"Submit\">";
?>

</form>
