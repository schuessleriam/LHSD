<?php

//enrollment stats ---------------------------------------------------------------------------

//Declaring variables
$freshmen = $_POST[ninth];
$sophomore = $_POST[tenth];
$junior = $_POST[eleventh];
$senior = $_POST[twelfth];
$enr_year = $_POST[enr_year];
$affil = $_POST[affil];
$date = date('m/d/Y h:i:s a', time());

//Check if percentages are empty
$freshmen = !empty($freshmen) ? "'$freshmen'" : "NULL";
$sophomore = !empty($sophomore) ? "'$sophomore'" : "NULL";
$junior = !empty($junior) ? "'$junior'" : "NULL";
$senior = !empty($senior) ? "'$senior'" : "NULL";
$enr_year = !empty($enr_year) ? "'$enr_year'" : "NULL";
$affil = !empty($affil) ? "'$affil'" : "NULL";

//demographics -----------------------------------------------------------------------------

//Declaring variables
$perc_asian = $_POST[asian];
$perc_black = $_POST[black];
$perc_hispanic = $_POST[hispanic];
$perc_white = $_POST[white];
$perc_other = $_POST[other];
$perc_luth = $_POST[luth];

//Check if percentages are empty
$perc_asian = !empty($perc_asian) ? "'$perc_asian'" : "NULL";
$perc_black = !empty($perc_black) ? "'$perc_black'" : "NULL";
$perc_hispanic = !empty($perc_hispanic) ? "'$perc_hispanic'" : "NULL";
$perc_white = !empty($perc_white) ? "'$perc_white'" : "NULL";
$perc_other = !empty($perc_other) ? "'$perc_other'" : "NULL";
$perc_luth = !empty($perc_luth) ? "'$perc_luth'" : "NULL";

// connect to the database
require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//schools -------------------------------------------------------------------------------------
$SCHOOL = "INSERT INTO temp_data (school_id, address_id, school_name, website, phone, fax,
  email, boarding_school, founded, accred, affil, member_tut, nonmember_tut,
  full_time_staff, part_time_staff, other, mail_label, street, city, state, zip, country, percent_asian,
  percent_black, percent_hispanic, percent_white, percent_other, percent_lutheran,
  freshmen, sophomore, junior, senior, year, grad_num, luth_grad_num, percent_to_clg, grads_at_luth, grads_at_nonluth,
grads_at_public, luth_grads_at_luth, luth_grads_at_priv, luth_grads_at_public, pubdate)
  values ('$_POST[school_id]', '$_POST[address_id]', '$_POST[school_name]', '$_POST[site]',
    '$_POST[phone]', '$_POST[fax]', '$_POST[email]', '$_POST[boarding]',
    '$_POST[founded]', '$_POST[accr]', $affil, '$_POST[mem_tut]',
    '$_POST[nonmem_tut]', '$_POST[full_time]', '$_POST[part_time]', '$_POST[comments]',
    '$_POST[mail_label]', '$_POST[addr]', '$_POST[city]', '$_POST[state]', '$_POST[zip]', '$_POST[country]', $perc_asian,
    $perc_black, $perc_hispanic, $perc_white, $perc_other, $perc_luth, $freshmen,
    $sophomore, $junior, $senior, $enr_year, '$_POST[grad_num]','$_POST[luth_grad_num]','$_POST[percent_to_clg]','$_POST[grads_at_luth]',
'$_POST[grads_at_nonluth]', '$_POST[grads_at_public]','$_POST[luth_grads_at_luth]',
'$_POST[luth_grads_at_priv]','$_POST[luth_grads_at_public]', '$date')";

if ($conn->query($SCHOOL) === TRUE) {
    echo "Thank you for your participation.";
} else {
    echo "Error: " . $SCHOOL . "<br>" . $conn->error;
}

$last_id = $conn->insert_id;


//Add existing positions that have been selected to keep to temp_positions ------------------------------------------------------
foreach($_POST['check_list'] as $selected) {

$sql = "SELECT * FROM positions where position_id = '". $selected ."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$position_name = $row['name'];
$position_email = $row['email'];
$position_title_id = $row['title_id'];

mysqli_query($conn, "INSERT INTO temp_positions (name, email, title_id, school_id, temp_data_id)
VALUES ('$position_name', '$position_email', $position_title_id, '$_POST[school_id]', $last_id)");

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

mysqli_query($conn, "INSERT INTO temp_positions (name, email, title_id, school_id, temp_data_id) VALUES ('$_POST[$index]', '$_POST[$indexemail]', $titleId, '$_POST[school_id]', $last_id)");
$i++;

//Update row variables for next loop
$index = "txtRow" . $i;
$indexemail = "emlRow" . $i;
$titleIndex = "selRow" . $i;
$title = $_POST[$titleIndex];
}

header("refresh:2; url=../.");
mysqli_close($conn);

?>
