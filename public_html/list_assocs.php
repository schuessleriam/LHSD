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

$sql = "SELECT * from assocs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<section><a class=listedschools onclick=\"loadTab('Associations', 'associations/assocs.php?assoc_id=', '" . $row["assoc_id"] . "')\">" . $row["assoc_name"] . "</a></section>" . "<aside>" . $row["website"] ."</aside><br>";
    }
}
 else {
    echo "0 results";
}
$conn->close();

?>
