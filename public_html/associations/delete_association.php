<?php
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        }

// connect to the database
require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//select school to be outputted
$assoc_id = $_REQUEST["assoc_id"];

$sql = "DELETE from assocs
where assoc_id = $assoc_id";
$result = $conn->query($sql);

//close database connection
$conn->close();
?>
