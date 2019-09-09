<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>
<html>

<body>
<?php
// connect to the database
require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//schools -------------------------------------------------------------------------------------
$TITLE = "INSERT INTO title (title) values ('$_POST[title]')";

if ($conn->query($TITLE) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $TITLE . "<br>" . $conn->error;
}

//Return to homepage
header("refresh:1; url=../");
mysqli_close($conn);

?>

</body>
</html>
