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
$SCHOOL = "INSERT INTO schools (school_name, data_tel_id, mail_label, public, website, phone, fax, email, boarding_school, founded, accred, affiliation, member_tut, nonmember_tut, full_time_staff, part_time_staff, other) values ('$_POST[school_name]', '$_POST[dataTel]', '$_POST[mail_label]', '$_POST[public]', '$_POST[site]', '$_POST[phone]', '$_POST[fax]', '$_POST[email]', '$_POST[boarding]', '$_POST[founded]', '$_POST[accr]', '$_POST[affil]', '$_POST[mem_tut]', '$_POST[nonmem_tut]', '$_POST[full_time]', '$_POST[part_time]', '$_POST[comments]')";

if ($conn->query($SCHOOL) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $SCHOOL . "<br>" . $conn->error;
}

//Save primary key for schools to link with other tables
$last_id = $conn->insert_id;

//
$SCHOOL2 = "UPDATE schools SET address_id=$last_id WHERE school_id = $last_id";

if ($conn->query($SCHOOL2) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $SCHOOL2 . "<br>" . $conn->error;
}


//address table --------------------------------------------------------------------------------
$SQL = "INSERT INTO address (address_id, street, city, state, country, zip) values ($last_id, '$_POST[addr]', '$_POST[city]', '$_POST[state]', '$_POST[country]', '$_POST[zip]')";

if ($conn->query($SQL) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $SQL . "<br>" . $conn->error;
}

//demographics -----------------------------------------------------------------------------

//Declaring variables
$perc_asian = $_POST[asian];
$perc_black = $_POST[black];
$perc_hispanic = $_POST[hispanic];
$perc_white = $_POST[white];
$perc_other = $_POST[other];
$perc_luth = $_POST[luth];
$enr_year = $_POST[year];

//Check if percentages are empty
$perc_asian = !empty($perc_asian) ? "'$perc_asian'" : "NULL";
$perc_black = !empty($perc_black) ? "'$perc_black'" : "NULL";
$perc_hispanic = !empty($perc_hispanic) ? "'$perc_hispanic'" : "NULL";
$perc_white = !empty($perc_white) ? "'$perc_white'" : "NULL";
$perc_other = !empty($perc_other) ? "'$perc_other'" : "NULL";
$perc_luth = !empty($perc_luth) ? "'$perc_luth'" : "NULL";
$enr_year = !empty($enr_year) ? "'$enr_year'" : "NULL";

$DEM = "INSERT INTO demo (percent_asian, percent_black, percent_hispanic, percent_white, percent_other, percent_lutheran, year, school_id) values ($perc_asian, $perc_black, $perc_hispanic, $perc_white, $perc_other, $perc_luth, $enr_year, $last_id)";

if ($conn->query($DEM) === TRUE) {
    echo "Successful submission";
} else {
    echo "Error: " . $DEM . "<br>" . $conn->error;
}

//enrollment stats ---------------------------------------------------------------------------

//Declaring variables
$freshmen = $_POST[ninth];
$sophomore = $_POST[tenth];
$junior = $_POST[eleventh];
$senior = $_POST[twelfth];

//Check if percentages are empty
$freshmen = !empty($freshmen) ? "'$freshmen'" : "NULL";
$sophomore = !empty($sophomore) ? "'$sophomore'" : "NULL";
$junior = !empty($junior) ? "'$junior'" : "NULL";
$senior = !empty($senior) ? "'$senior'" : "NULL";

$ENR = "INSERT INTO enr_stats (freshmen, sophomore, junior, senior, year, school_id) values ($freshmen, $sophomore, $junior, $senior, $enr_year, $last_id)";

if ($conn->query($ENR) === TRUE) {
    //echo "Successful submission";
} else {
    echo "Error: " . $ENR . "<br>" . $conn->error;
}


//GRADUATION stats ---------------------------------------------------------------------------

//Declaring variables

$grad_num=$_POST[grad_num];
$luth_grad_num=$_POST[luth_grad_num];
$percent_to_clg=$_POST[percent_to_clg];
$grads_at_luth=$_POST[grads_at_luth];
$grads_at_nonluth=$_POST[grads_at_nonluth];
$grads_at_public=$_POST[grads_at_public];
$luth_grads_at_luth=$_POST[luth_grads_at_luth];
$luth_grads_at_priv=$_POST[luth_grads_at_priv];
$luth_grads_at_public=$_POST[luth_grads_at_public];

//Check if percentages are empty
$grad_num = !empty($grad_num) ? "'$grad_num'" : "NULL";
$luth_grad_num = !empty($luth_grad_num) ? "'$luth_grad_num'" : "NULL";
$percent_to_clg = !empty($percent_to_clg) ? "'$percent_to_clg'" : "NULL";
$grads_at_luth = !empty($grads_at_luth) ? "'$grads_at_luth'" : "NULL";
$grads_at_nonluth = !empty($grads_at_nonluth) ? "'$grads_at_nonluth'" : "NULL";
$grads_at_public = !empty($grads_at_public) ? "'$grads_at_public'" : "NULL";
$luth_grads_at_luth = !empty($luth_grads_at_luth) ? "'$luth_grads_at_luth'" : "NULL";
$luth_grads_at_priv = !empty($luth_grads_at_priv) ? "'$luth_grads_at_priv'" : "NULL";
$luth_grads_at_public = !empty($luth_grads_at_public) ? "'$luth_grads_at_public'" : "NULL";


$GRAD = "INSERT INTO grad_stats (grad_num, luth_grad_num, percent_to_clg, grads_at_luth,
  grads_at_nonluth, grads_at_public, luth_grads_at_luth, luth_grads_at_priv,
  luth_grads_at_public, year, school_id)
values ($grad_num, $luth_grad_num, $percent_to_clg, $grads_at_luth,
  $grads_at_nonluth, $grads_at_public, $luth_grads_at_luth,
  $luth_grads_at_priv, $luth_grads_at_public, $enr_year, $last_id)";

if ($conn->query($GRAD) === TRUE) {
    //echo "Successful submission";
} else {
    echo "Error: " . $GRAD . "<br>" . $conn->error;
}


//faculty members ---------------------------------------------------------------------------------

$i = 1;
$index = "txtRow" . $i;
$indexemail = "emlRow" . $i;
$titleIndex = "selRow" . $i;
$title = $_POST[$titleIndex];

while($_POST[$index] != NULL) {
$titleResult = "SELECT title_id FROM title WHERE title = '". $title ."'";
$titleResult2 = mysqli_query($conn, $titleResult);
$titleRow = mysqli_fetch_assoc($titleResult2);
$titleId = $titleRow['title_id'];

//$titleResult = mysqli_query($conn, "SELECT title_id FROM title WHERE title = '". $title ."'");

mysqli_query($conn, "INSERT INTO positions (name, email, title_id, school_id) VALUES ('$_POST[$index]', '$_POST[$indexemail]', $titleId, $last_id)");
$i++;

//Update row variables for next loop
$index = "txtRow" . $i;
$indexemail = "emlRow" . $i;
$titleIndex = "selRow" . $i;
$title = $_POST[$titleIndex];
}

//Return to homepage
header("refresh:1; url=../");

mysqli_close($conn);

?>

</body>
</html>
