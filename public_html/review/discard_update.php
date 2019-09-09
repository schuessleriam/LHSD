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
$conn=mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//select update submission to be submitted
$temp_data_id=$_REQUEST["temp_data_id"];

$sql="DELETE FROM temp_data where temp_data_id=$temp_data_id";
$result=$conn->query($sql);

if ($conn->query($sql) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

$sql="DELETE FROM temp_positions where temp_data_id=$temp_data_id";
$result=$conn->query($sql);

if ($conn->query($sql) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

mysqli_close($conn);

        ?>
