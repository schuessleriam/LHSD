<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 

// Format doc
   require_once("../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT schools.school_id, schools.school_name, schools.address_id, address.state, address.address_id
FROM `schools`
inner JOIN address on schools.address_id=address.address_id order by state, school_name";
$result = $conn->query($sql);

//store previous state info for formatting.
$prev_state="nostate";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

	if($row["state"] !== $prev_state){
		echo "<br><section id='state'>" . $row["state"] ."</section><br>";
	}

        echo "<section><a class=listedschools onclick=\"openSchool('" . $row["school_id"] . "')\">" . $row["school_name"] . "</a></section>";
	$prev_state = $row["state"];
    }
}
 else {
    echo "0 results";
}
$conn->close();

?>
