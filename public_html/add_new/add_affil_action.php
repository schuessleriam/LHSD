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

//Affiliations -------------------------------------------------------------------------------------
$AFFIL = "INSERT INTO affil (description,code) values ('$_POST[description]','$_POST[code]')";

if ($conn->query($AFFIL) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $AFFIL . "<br>" . $conn->error;
}

//Return to homepage!!!!!!
header("refresh:2; url=../");

mysqli_close($conn);

?>

</body>
</html>
