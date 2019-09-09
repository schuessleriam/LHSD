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

//address table --------------------------------------------------------------------------------
$SQL = "INSERT INTO address (street, city, state, zip) values ('$_POST[addr]', '$_POST[city]', '$_POST[state]', '$_POST[zip]')";

if ($conn->query($SQL) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $SQL . "<br>" . $conn->error;
}

//Last address id from the address table-------------------------------------------------------
$last_id = $conn->insert_id;


//associations -------------------------------------------------------------------------------------
$ASSOC = "INSERT INTO assocs (address_id,assoc_name,mail_label,website) values ($last_id,'$_POST[assoc_name]','$_POST[mail_label]','$_POST[website]')";

if ($conn->query($ASSOC) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $ASSOC . "<br>" . $conn->error;
}

//Return to homepage
header("refresh:1; url=../");

mysqli_close($conn);

?>
</body>
</html>
