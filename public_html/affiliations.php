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

$sql = "SELECT * from affil";
$result = $conn->query($sql);

echo "<section><table><tr>
<th>Affiliation</th>
<th>Code</th>
</tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
	echo "<tr><td>" . $row["description"] . "</td><td>"
	. $row["code"] . "</td><td><button onclick=\"
		delete_affil(" . $row['affil_id']  . ", $affil_id)\">
		Delete</button></td></tr></section>";


   }
}
 else {
    echo "0 results";
}
$conn->close();

?>
