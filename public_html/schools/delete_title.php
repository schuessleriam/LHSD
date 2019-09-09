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

//select school to be outputted
$position_id = $_REQUEST["position_id"];

$sql = "DELETE from positions
where position_id = $position_id";
$result = $conn->query($sql);

//close database connection
$conn->close();
?>

