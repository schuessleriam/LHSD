<?php
// connect to the database credentials
require_once("../../resources/config/config.php");
require_once("../../resources/css/outside_style.css");

//get passed school info
$school_id = $_GET["pin"];
$school_name = $_GET["school_name"];

//save current data in php variables for default values
// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
     while($row = $result->fetch_assoc()) {
      $public = $row["public"];
      $pubdate = $row["pubdate"];
      $data_tel = $row["data_tel_id"];
      $website = $row["website"];
      $public = $row["public"];
      $mail_label = $row["mail_label"];
      $address_id = $row["address_id"];
      $founded = $row["founded"];
      $accred = $row["accred"];
      $member_tut = $row["member_tut"];
      $nonmember_tut = $row["nonmember_tut"];
      $other = $row["other"];
      $boarding_school = $row["boarding_school"];
      $phone = $row["phone"];
      $fax = $row["fax"];
      $email = $row["email"];
      $full_time = $row["full_time_staff"];
      $part_time = $row["part_time_staff"];
      $affil = $row["affiliation"];
      }
}

$sql = "SELECT * FROM address where address_id = $address_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
   while($row = $result->fetch_assoc()) {
      $street = $row["street"];
      $city = $row["city"];
      $state = $row["state"];
      $zip = $row["zip"];
      $country = $row["country"];
      }
}

$sql = "SELECT * FROM enr_stats where school_id = $school_id";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
        $freshmen = $row["freshmen"];
        $sophomore = $row["sophomore"];
        $junior = $row["junior"];
        $senior = $row["senior"];
        }
  }

$sql = "SELECT * FROM demo where school_id = $school_id";
$result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
     while($row = $result->fetch_assoc()) {
        $percent_asian = $row["percent_asian"];
        $percent_black = $row["percent_black"];
        $percent_hispanic = $row["percent_hispanic"];
        $percent_white = $row["percent_white"];
        $percent_other = $row["percent_other"];
        $percent_lutheran = $row["percent_lutheran"];
        }
}

//declare current sql values for default form values
$sql="select * from grad_stats where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
        $year=$row["year"];
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
}

//close first database connection
$conn->close();

// Create secondary connection
$conn1 = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn1) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT title FROM title ORDER BY title";
$result = $conn1->query($query);
$affilQuery = "SELECT * FROM affil ORDER BY code";
$affilResult = $conn1->query($affilQuery);
?>


<!--Form html-------------------------------------------------------------->






<form align = "left"  action = "./outside_form_action.php" method="POST" name="destination">
<div id="form_part1">

<!--Instructions for part 1 of form-------------------------->
<p>
<b>Section 1/5</b><br><br>

<i>Please Update the fields if neccesary, or <a type="button" id="continue" onclick="shows_form_part(2)">continue.</a></i>

</p>

<?php echo "School Name: " . $school_name  . "<br>"; ?>
<input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
<input type="hidden" name="data_tel" value="<?php echo $data_tel; ?>">
<input type="hidden" name="school_name" value="<?php echo $school_name; ?>">
<input type="hidden" name="address_id" value="<?php echo $address_id; ?>">
Share to Outside Institutions: <select name="public">
  <option <?php if($public == '1'){echo("selected=\"selected\" ");} ?> value="1">Yes</option>
  <option <?php if($public == '0'){echo("selected=\"selected\" ");} ?> value="0">No</option>
</select><br>
Enrollment Year:  <input type="text" name="enr_year" value="<?php echo date("Y"); ?>"><br><br>
Mail Label: <input type="text" name="mail_label" value="<?php echo $mail_label; ?>"><br>
Address: <input type="text" name="addr" value="<?php echo $street; ?>"><br>
City: <input type="text" name="city" value="<?php echo $city; ?>"><br>
State:<input type="text" name = "state" value="<?php echo $state; ?>"><br>
Zip Code: <input type="text" name="zip" value="<?php echo $zip; ?>"><br>
Country: <input type="text" name="country" value="<?php echo $country; ?>"><br><br>
Website: <input type="text" name="site" value="<?php echo $website; ?>"><br>
Phone: <input type="text" name="phone" value="<?php echo $phone; ?>"><br>
Fax: <input type="text" name="fax" value="<?php echo $fax; ?>"><br>
Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
Boarding School: <select name="boarding">
  <option <?php if($boarding_school == '1'){echo("selected=\"selected\" ");} ?> value="1">Yes</option>
  <option <?php if($boarding_school == '0'){echo("selected=\"selected\" ");} ?> value="0">No</option>
</select><br><br>
Founded: <input type="text" name="founded" value="<?php echo $founded; ?>"><br>
Accreditation: <input type="text" name="accr" value="<?php echo $accred; ?>"><br>
Affiliation: <select name="affil">
    <option value = ""></option>
    <?php
        while($affilRow = mysqli_fetch_array($affilResult)) {
                echo "<option ";
                if($affil == $affilRow['affil_id']){echo "selected=\"selected\" ";}
                echo " value = ".$affilRow['affil_id'].">"
                . $affilRow['description'] . " (" . $affilRow['code'] . ") </option>";
            }
    	echo "</select><br>";
    ?>

Member's Tuition: <input type="text" name="mem_tut" value="<?php echo $member_tut; ?>"><br>
Non-Member's Tuition: <input type="text" name="nonmem_tut" value="<?php echo $nonmember_tut; ?>"><br>
Comments: <textarea rows="4" cols="50"  name="comments"><?php echo $other; ?></textarea><br>
<br></br>

<!-----------end of general information section------------------>
<button type="button" onclick="shows_form_part(2)">&raquo;</button>
</div>


<!-----------Population data section------------------>
<div id="form_part2" style="display: none;">

<!--Instructions for part 2 of form-------------------------->
<p>
<b>Section 2/5</b><br><br>

<i>Please answer the fields as you can, or <a type="button" id="continue" onclick="shows_form_part(3)">continue.</a></i>

</p>

<h4>CURRENT ENROLLMENT</h4>
9th: <input type="text" name="ninth" ><br>
10th: <input type="text" name="tenth" ><br>
11th: <input type="text" name="eleventh" ><br>
12th: <input type="text" name="twelfth" ><br>

<h4>ESTIMATED ETHNICITY PERCENTAGES</h4>
Asian: <input type="text" name="asian" ><br>
Black: <input type="text" name="black" ><br>
Hispanic: <input type="text" name="hispanic" ><br>
White: <input type="text" name="white" ><br>
Other: <input type="text" name="other" ><br>
Lutheran: <input type="text" name="luth" ><br>

<!-----------end of population data section------------------>
<button type="button" onclick="shows_form_part(1)">&laquo;</button>
<button type="button" onclick="shows_form_part(3)">&raquo;</button>
</div>

<!-----------Current Faculty information section------------------>
<div id="form_part3" style="display: none;">

<!--Instructions for part 3 of form-------------------------->
<p>
<b>Section 3/5</b><br><br>

<i>Please answer the fields and confirm or update current stored faculty members, or <a type="button" id="continue" onclick="shows_form_part(4)">continue.</a><br>
<br>To remove current stored directors, uncheck the </i><b>Keep</b><i> option.
<br>To change information of a director, please uncheck the </i><b>Keep</b><i> option
and create a new entry on the following page.
<br><br><b>Add new faculty on next page.</b></i>

</p>

<h4>FACULTY NUMBERS</h4>
Full Time: <input type="text" name="full_time" value="<?php echo $full_time; ?>"><br>
Part Time: <input type="text" name="part_time" value="<?php echo $part_time; ?>"><br>
<br></br>

<h4>FACULTY MEMBERS</h4>

<?php
// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//Display School's director info
$sql = "SELECT positions.position_id, positions.title_id, positions.name, positions.email, title.title_id,
title.title
FROM title
INNER JOIN positions ON title.title_id=positions.title_id
where school_id = $school_id";
$dir_result = $conn->query($sql);

echo " <table><tr>
<th>Title</th>
<th>Name</th>
<th>Email</th>
<td>Keep</td>
</tr>";

if ($dir_result->num_rows > 0) {
          // output data of each row
          while($row = $dir_result->fetch_assoc()) {
              echo "<tr><td>" . $row["title"] . "</td><td> " . $row["name"]
              . "</td><td> " . $row["email"] . "</td><td>
                <input type=\"checkbox\" name=\"check_list[]\" value=\"" .$row["position_id"]. "\" checked>
		</td></tr>";

          }
      } else {
          echo "0 results";
      }

//close first database connection
$conn->close();
?>
</table>

<!-----------End of Current Faculty information section------------------>
<button type="button" onclick="shows_form_part(2)">&laquo;</button>
<button type="button" onclick="shows_form_part(4)">&raquo;</button>
</div>

<div id="form_part4" style="display: none;">

<!--Instructions for part 4 of form-------------------------->
<p>
<b>Section 4/5</b><br><br>

<i>Please add new directors information below, or <a type="button" id="continue" onclick="shows_form_part(5)">continue.</a><br>
<br>Click the </i><b>Add</b><i> and </i><b>Remove</b><i> buttons to add or remove a row for how many positions you would like to enter.
<br>Please enter information in order. Do not leave an empty row between entries.</i>

</p>

<!-- Below is the code for the dynamic input table for faculty members -->

<script type="text/javascript" src="lib.js"></script>

<p>
<input type="button" id="addrem" value="Add" onclick="addRowToTable2();" />
<input type="button" id="addrem" value="Remove" onclick="removeRowFromTable();" />

</p>
<br></br>
<p>
</p>
<table border="1" id="sampleTbl">
  <tr>
    <th colspan="3">Add Faculty Members</th>
  </tr>
  <tr>
    <td>1</td>
    <td><input type="text" name="txtRow1"
     id="txtRow1" size="40" onkeypress="keyPressTest(event, this);" /></td>
     <td>Email  <input type="text" name="emlRow1"
     id="emlRow1" size="40" onkeypress="keyPressTest(event, this);" /></td>
    <td>Title
    <select id = "selRow1" name="selRow1" style="width: 200px;">
    <?php
	while($row = mysqli_fetch_array($result)) {
		echo '<option value = "'.$row['title'].'">'.$row['title'].'</option>';
	}
     ?>
    </select>
    </td>
  </tr>
</table>

</br>

<!-----------End of add Faculty section------------------>
<button type="button" onclick="shows_form_part(3)">&laquo;</button>
<button type="button" onclick="shows_form_part(5)">&raquo;</button>
</div>

<div id="form_part5" style="display: none;">

<!--Instructions for part 5 of form-------------------------->
<p>
<b>Section 5/5</b><br><br>

<i>The following information <b>WILL NOT</b> be shared publicaly, regardless of earlier preference.<br>
<br>Please answer the fields as you can. If you are satisfied, click </i><b>Submit Update</b><i>, or use the botton navigation buttons to review.</i>

</p>

<h4>GRADUATION STATISTICS</h4>
Graduates:<input type="text" name="grad_num" ><br>
Lutheran Graduates:<input type="text" name="luth_grad_num" ><br>
Total Percent to College:<input type="text" name="percent_to_clg" ><br>

All Graduates:<br>
Lutheran College/University:<input type="text" name="grads_at_luth" ><br>
Non-Lutheran College/University:<input type="text" name="grads_at_nonluth" ><br>
Public College/University:<input type="text" name="grads_at_public" ><br>

Lutheran Graduates:<br>
Lutheran College/University:<input type="text" name="luth_grads_at_luth" ><br>
Private College/University:<input type="text" name="luth_grads_at_priv" ><br>
Public College/University:<input type="text" name="luth_grads_at_public" ><br>



<!-----------End of Current Faculty information section------------------>
<button type="button" onclick="shows_form_part(4)">&laquo;</button>
<input type="submit" value="Submit Update" id="submit">
</div>

</form>
