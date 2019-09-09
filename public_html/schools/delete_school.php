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
$school_id = $_REQUEST["school_id"];

$sql = "select address_id from schools where school_id = $school_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $address_id = $row["address_id"];
    }
}

$sql = "DELETE from address
where address_id = $address_id";
$result = $conn->query($sql);

$sql = "DELETE from schools
where school_id = $school_id";
$result = $conn->query($sql);

$sql = "DELETE from positions
where school_id = $school_id";
$result = $conn->query($sql);

$sql = "DELETE from grad_stats
where school_id = $school_id";
$result = $conn->query($sql);

$sql = "DELETE from enr_stats
where school_id = $school_id";
$result = $conn->query($sql);

$sql = "DELETE from demo
where school_id = $school_id";
$result = $conn->query($sql);

//close database connection
$conn->close();
?>
