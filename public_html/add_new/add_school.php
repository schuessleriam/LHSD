<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {

        $('#add_school').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: './add_new/add_school_action.php',
            data: $('#add_school').serialize(),
            success: function () {
              alert('New School added.');
		$("#add_school")[0].reset();
            }
          });

        });

      });
    </script>

<?php
// connect to the database
require_once("../resources/config/config.php");
require_once("../resources/css/style.css");

// Create connection
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

<form id = "add_school" align = "left" name="destination">
School Name: <input type="text" name="school_name" required><br>
DataTel ID: <input type="text" name="dataTel"><br>
Public: <select name = "public">
        <option value="1">Yes</option>
        <option value="0">No</option>
	</select> <br>
Enrollment Year: <input type="text" name="year"><br>
Mail Label: <input type="text" name="mail_label"><br>
Address: <input type="text" name="addr"><br>
City: <input type="text" name="city" required><br>
State:<select name = "state">
	<option value=""></option>
	<option value="INTL">International</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select> <br>
Zip Code: <input type="text" name="zip" required><br>
Country: <input type="text" name="country" value="United States"><br><br>
Website: <input type="text" name="site"><br>
Phone: <input type="text" name="phone"><br>
Fax: <input type="text" name="fax"><br>
Email: <input type="text" name="email"><br>
Boarding School: <select name="boarding"><option value="1">Yes</option><option value="0">No</option></select><br>
Founded: <input type="text" name="founded"><br>
Accreditation: <input type="text" name="accr"><br>
Affiliation: <select name="affil" style="width: 50px;">

    <?php
	while($affilRow = mysqli_fetch_array($affilResult)) {
		echo "<option value = ".$affilRow['affil_id'].">".$affilRow['code']."</option>";
	}
     ?>

</select><br>
Member's Tuition: <input type="text" name="mem_tut"><br>
Non-Member's Tuition: <input type="text" name="nonmem_tut"><br>
Comments: <textarea rows="4" cols="50"  name="comments"></textarea><br>
<br></br>

<h3>FACULTY NUMBERS</h3>
Full Time: <input type="text" name="full_time"><br>
Part Time: <input type="text" name="part_time"><br>
<br></br>

<h4>CURRENT ENROLLMENT</h4>
9th: <input type="text" name="ninth"><br>
10th: <input type="text" name="tenth"><br>
11th: <input type="text" name="eleventh"><br>
12th: <input type="text" name="twelfth"><br>
<br></br>

<h5>ESTIMATED ETHNICITY PERCENTAGES</h5>
Asian: <input type="text" name="asian"><br>
Black: <input type="text" name="black"><br>
Hispanic: <input type="text" name="hispanic"><br>
White: <input type="text" name="white"><br>
Other: <input type="text" name="other"><br>
Lutheran: <input type="text" name="luth"><br>

<h5>GRADUATION STATISTICS</h5>
Graduates:<input type="text" name="grad_num"><br>
Lutheran Graduates:<input type="text" name="luth_grad_num"><br>
Total Percent to College:<input type="text" name="percent_to_clg"><br>
<b>All Graduates:</b><br>
Lutheran College/University:<input type="text" name="grads_at_luth"><br>
Non-Lutheran College/University:<input type="text" name="grads_at_nonluth"><br>
Public College/University:<input type="text" name="grads_at_public"><br>
<b>Lutheran Graduates:</b><br>
Lutheran College/University:<input type="text" name="luth_grads_at_luth"><br>
Private College/University:<input type="text" name="luth_grads_at_priv"><br>
Public College/University:<input type="text" name="luth_grads_at_public"><br>

<h5>FACULTY MEMBERS</h5>

<!-- Dynamic input table for faculty members -->

<p>
<input id="addrem" type="button" value="Add" onclick="addRowToTable1();" />
<input id="addrem" type="button" value="Remove" onclick="removeRowFromTable();" />

</p>
<p>
</p>
<table border="1" id="tblSample">
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
<input id="submit" type="submit" value="Submit">
<br>
</form>
