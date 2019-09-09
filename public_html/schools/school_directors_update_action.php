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

//faculty members ---------------------------------------------------------------------------------

$i = 1;
$index = "textRow" . $i;
$indexemail = "emailRow" . $i;
$titleIndex = "selectRow" . $i;
$title = $_POST[$titleIndex];

while($_POST[$index] != NULL) {
$titleResult = "SELECT title_id FROM title WHERE title = '". $title ."'";
$titleResult2 = mysqli_query($conn, $titleResult);
$titleRow = mysqli_fetch_assoc($titleResult2);
$titleId = $titleRow['title_id'];


mysqli_query($conn, "INSERT INTO positions (name, email, title_id, school_id) VALUES ('$_POST[$index]', '$_POST[$indexemail]', $titleId, $_POST[schoolid])");
$i++;

//Update row variables for next loop
$index = "textRow" . $i;
$indexemail = "emailRow" . $i;
$titleIndex = "selectRow" . $i;
$title = $_POST[$titleIndex];
}

mysqli_close($conn);

?>

</body>
</html>
