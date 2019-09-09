<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<?php

// Format doc
   require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$q=$_GET["q"];
$sql = "SELECT schools.school_id, schools.school_name, schools.address_id, address.state, address.address_id FROM `schools` inner JOIN address on schools.address_id=address.address_id WHERE school_name LIKE '$q%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<section><a class=listedschools onclick=\"openSchool('" . $row["school_id"] . "')\">" . $row["school_name"] . "</a></section>" . "<aside>" . $row["state"] ."</aside><br>";
    }
}
 else {
    echo "0 results";
}
$conn->close();

?>
