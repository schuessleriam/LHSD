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

$sql = "SELECT temp_data_id, school_id, school_name
FROM temp_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<section><a class=listedschools onclick=\"openReview('"
        . $row["school_id"] . "', '" . $row["temp_data_id"] . "')\"> Update to " . $row["school_name"]. "</a></section>";
    }
}
 else {
    echo "<br>There are currently no updates to process.";
}
$conn->close();

?>
