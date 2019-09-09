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

$sql="SELECT * FROM temp_data where temp_data_id=$temp_data_id";
$result=$conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row=$result->fetch_assoc()) {
	  $affil=$row["affil"];
          $year=$row["year"];
          $school_id=$row["school_id"];
	  $school_name=$row["school_name"];
          $address_id=$row["address_id"];
          $pubdate=$row["pubdate"];
          $website=$row["website"];
          $mail_label=$row["mail_label"];
	  $addr=$row["street"];
          $city=$row["city"];
          $state =$row["state"];
          $zip=$row["zip"];
          $country=$row["country"];
          $boarding_school=$row["boarding_school"];
          $phone=$row["phone"];
          $fax=$row["fax"];
          $email=$row["email"];
          $founded =$row["founded"];
          $accred=$row["accred"];
          $description =$row["description"];
          $code=$row["code"];
          $member_tut=$row["member_tut"];
          $nonmember_tut=$row["nonmember_tut"];
        $other=$row["other"];
        $full_time_staff=$row["full_time_staff"];
        $part_time_staff=$row["part_time_staff"];
        $freshmen=$row["freshmen"];
        $sophomore=$row["sophomore"];
        $junior=$row["junior"];
        $senior=$row["senior"];
        $perc_asian=$row["percent_asian"];
        $perc_black=$row["percent_black"];
        $perc_hispanic=$row["percent_hispanic"];
        $perc_white=$row["percent_white"];
        $perc_other=$row["percent_other"];
        $perc_luth=$row["percent_lutheran"];
	$grad_num=$row["grad_num"];
        $luth_grad_num=$row["luth_grad_num"];
        $percent_to_clg=$row["percent_to_clg"];
        $grads_at_luth=$row["grads_at_luth"];
        $grads_at_nonluth=$row["grads_at_nonluth"];
        $grads_at_public=$row["grads_at_public"];
        $luth_grads_at_luth=$row["luth_grads_at_luth"];
        $luth_grads_at_priv=$row["luth_grads_at_priv"];
        $luth_grads_at_public=$row["luth_grads_at_public"];

        }
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        //schools -------------------------------------------------------------------------------------
        $SCHOOL="UPDATE schools SET
	school_name='$school_name',
        affiliation='$affil',
	website='$website',
	mail_label='$mail_label',
        phone='$phone',
        fax='$fax',
        email='$email',
        boarding_school='$boarding_school',
        founded='$founded',
        accred='$accred',
        member_tut='$member_tut',
        nonmember_tut='$nonmember_tut',
        full_time_staff='$full_time_staff',
        part_time_staff='$part_time_staff',
        other='$other',
        pubdate='$pubdate'
	WHERE school_id='$school_id'";

        if ($conn->query($SCHOOL) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $SCHOOL . "<br>" . $conn->error;
        }


        //address table --------------------------------------------------------------------------------
        $SQL="UPDATE address SET
        street='$addr',
        city='$city',
        state='$state',
        zip='$zip',
        country='$country'
        WHERE address_id='$address_id'";

        if ($conn->query($SQL) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $SQL . "<br>" . $conn->error;
        }

        //demographics -----------------------------------------------------------------------------

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
        percent_lutheran=$perc_luth
        WHERE school_id=$school_id";

        if ($conn->query($DEM) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $DEM . "<br>" . $conn->error;
        }

        //enrollment stats ---------------------------------------------------------------------------

        $enr_year=$pubdate;

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
        WHERE school_id='$school_id'";

        if ($conn->query($ENR) === TRUE) {
            //echo "Successful submission";
        } else {
            echo "Error: " . $ENR . "<br>" . $conn->error;
        }

	//grad stats -------------------------------------------------------------------------------------
	$update="UPDATE grad_stats SET
	year=$year,
	grad_num=$grad_num,
	luth_grad_num=$luth_grad_num,
	percent_to_clg=$percent_to_clg,
	grads_at_luth=$grads_at_luth,
	grads_at_nonluth=$grads_at_nonluth,
	grads_at_public=$grads_at_public,
	luth_grads_at_luth=$luth_grads_at_luth,
	luth_grads_at_priv=$luth_grads_at_priv,
	luth_grads_at_public=$luth_grads_at_public
	WHERE school_id=$school_id";

        if ($conn->query($update) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $update . "<br>" . $conn->error;
        }


//faculty ------------------------------------------------------------------

//delete existing positions for school to avoid duplication
$sql="DELETE FROM positions WHERE school_id=$school_id";
$result=$conn->query($sql);

$sql2="SELECT * FROM temp_positions WHERE temp_data_id=$temp_data_id";
$posResult=$conn->query($sql2);

while($row3=$posResult->fetch_assoc()) {
	$position_name = $row3['name'];
	$position_email = $row3['email'];
	$position_title_id = $row3['title_id'];
	mysqli_query($conn, "INSERT INTO positions (name, email, title_id, school_id)
 	VALUES ('$position_name', '$position_email', $position_title_id, $school_id)");
}

// -------------------------------------------------------------------------

$sql="DELETE FROM temp_data WHERE temp_data_id=$temp_data_id";
$result=$conn->query($sql);

$sql2="DELETE FROM temp_positions WHERE temp_data_id=$temp_data_id";
$posResult=$conn->query($sql2);

        mysqli_close($conn);

        ?>
