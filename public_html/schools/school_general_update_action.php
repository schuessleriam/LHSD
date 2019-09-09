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
        public='$_POST[public]',
	website='$_POST[site]',
        phone='$_POST[phone]',
        fax='$_POST[fax]',
        email='$_POST[email]',
        boarding_school='$_POST[boarding]',
        founded='$_POST[founded]',
        accred='$_POST[accr]',
        affiliation='$_POST[affil]',
        member_tut='$_POST[mem_tut]',
        nonmember_tut='$_POST[nonmem_tut]',
        other='$_POST[comments]',
        pubdate='$_POST[pubdate]',
	data_tel_id='$_POST[data_tel]',
	mail_label='$_POST[mail_label]'
	WHERE school_id='$_POST[school_id]'";

        if ($conn->query($SCHOOL) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $SCHOOL . "<br>" . $conn->error;
        }


        //address table --------------------------------------------------------------------------------
        $SQL="UPDATE address SET
        street='$_POST[addr]',
        city='$_POST[city]',
        state='$_POST[state]',
        zip='$_POST[zip]',
        country='$_POST[country]'
        WHERE address_id='$_POST[address_id]'";

        if ($conn->query($SQL) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $SQL . "<br>" . $conn->error;
        }


mysqli_close($conn);

        ?>
