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


        //schools -------------------------------------------------------------------------------------
        $SCHOOL="UPDATE schools SET
        full_time_staff='$_POST[full_time]',
        part_time_staff='$_POST[part_time]'
        WHERE school_id='$_POST[school_id]'";

        if ($conn->query($SCHOOL) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $SCHOOL . "<br>" . $conn->error;
        }

        //demographics -----------------------------------------------------------------------------

        $perc_asian=$_POST[percent_asian];
        $perc_black=$_POST[percent_black];
        $perc_hispanic=$_POST[percent_hispanic];
        $perc_white=$_POST[percent_white];
        $perc_other=$_POST[percent_other];
        $perc_luth=$_POST[percent_lutheran];
	$year=$_POST[year];

        //Check if percentages are empty
        $perc_asian=!empty($perc_asian) ? "'$perc_asian'" : "NULL";
        $perc_black=!empty($perc_black) ? "'$perc_black'" : "NULL";
        $perc_hispanic=!empty($perc_hispanic) ? "'$perc_hispanic'" : "NULL";
        $perc_white=!empty($perc_white) ? "'$perc_white'" : "NULL";
        $perc_other=!empty($perc_other) ? "'$perc_other'" : "NULL";
        $perc_luth=!empty($perc_luth) ? "'$perc_luth'" : "NULL";

        $DEM="UPDATE demo SET
        percent_asian=$perc_asian,
        percent_black=$perc_black,
        percent_hispanic=$perc_hispanic,
        percent_white=$perc_white,
        percent_other=$perc_other,
        percent_lutheran=$perc_luth,
	year=$year
        WHERE school_id='$_POST[school_id]'";

        if ($conn->query($DEM) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $DEM . "<br>" . $conn->error;
        }

        //enrollment stats ---------------------------------------------------------------------------

        $freshmen=$_POST[freshmen];
        $sophomore=$_POST[sophomore];
        $junior=$_POST[junior];
        $senior=$_POST[senior];

        //Check if percentages are empty
        $freshmen=!empty($freshmen) ? "'$freshmen'" : "NULL";
        $sophomore=!empty($sophomore) ? "'$sophomore'" : "NULL";
        $junior=!empty($junior) ? "'$junior'" : "NULL";
        $senior=!empty($senior) ? "'$senior'" : "NULL";

        $ENR="UPDATE enr_stats SET
        freshmen=$freshmen,
        sophomore=$sophomore,
        junior=$junior,
        senior=$senior,
        year=$year
        WHERE school_id='$_POST[school_id]'";

        if ($conn->query($ENR) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $ENR . "<br>" . $conn->error;
        }

        mysqli_close($conn);

        ?>
