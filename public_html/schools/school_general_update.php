<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
// connect to the database
require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<section class=\"infoaside\">";
//select school to be outputted
//$school_id = $_GET[school_id];
$school_id = $_REQUEST["school_id"];


$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo "<h3>" . $row["school_name"]."</h3>" .

	  "<button id='back' onclick=\"loadTab('gen', 'schools/school_general.php?school_id=', $school_id)\">Back</button>".
          "<form id=\"update_general\" name=\"destination\"> 
          
	  <input type=\"hidden\" name=\"school_id\" value=\"" . $school_id  . "\">
          <input type=\"hidden\" name=\"address_id\" value=\"" . $row["address_id"] . "\">
	  <input type=\"hidden\" name=\"pubdate\" value=\"" . date('m/d/Y h:i:s a', time()) . "\">

	  <table><tr><td>Data Tel ID:</th><td><input type=\"text\" name=\"data_tel\" value=\"" . $row["data_tel_id"] . "\"></td></tr>";
          echo "<tr><td>Public:</td><td> ";

          echo "<select name=\"public\" id=\"public\">
                <option ";
                         if($row["public"] == '1'){echo("selected=\"selected\" ");}
                        echo "value=\"1\">Yes
                </option>
                <option ";
                         if($row["public"] == '0'){echo("selected=\"selected\" ");}
                        echo "value=\"0\">No
                </option></select></td></tr>";
	  
	  echo "<tr><td>Website: </th><td><input type=\"text\" name=\"site\" value=\"" .  $row["website"]  . "\"></td></tr>" .
	  "<tr><td>Mail Label: </th><td><input type=\"text\" name=\"mail_label\" value=\"" .  $row["mail_label"]  . "\"></td></tr>";
          $address=$row["address_id"];

              }
          } else {
              echo "0 results";
          }



$sql = "SELECT * FROM address where address_id = $address";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
             while($row = $result->fetch_assoc()) {
                  echo "<tr><td>Address:</td><td><input type=\"text\" name=\"addr\" value=\"" . $row["street"].
          "\"><input type=\"text\" name=\"city\" value=\" " . $row["city"] . "\">,
          <input type=\"text\" name=\"state\" value=\"" . $row["state"] . "\"></td></tr>" .
          "<tr><td>Zip:</td><td><input type=\"text\" name=\"zip\" value=\"" . $row["zip"]. "\"></td></tr>" .
          "<tr><td>Country: </td><td><input type=\"text\" name=\"country\" value=\"" .  $row["country"]  . "\"></td></tr>";

              }
          } else {
              echo "0 results";
          }

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          echo "<tr><td>Boarding school:</td><td> ";

	  echo "<select name=\"boarding\" id=\"boarding_school\">
  		<option ";
			 if($row["boarding_school"] == '1'){echo("selected=\"selected\" ");}
			echo "value=\"1\">Yes
		</option>
		<option ";
			 if($row["boarding_school"] == '0'){echo("selected=\"selected\" ");}
			echo "value=\"0\">No
		</option></select></td></tr>";

	  echo
	  "<tr><td>Phone:</td><td><input type=\"text\" name=\"phone\" value=\"" . $row["phone"]. "\"></td></tr>" .
          "<tr><td>Fax:</td><td><input type=\"text\" name=\"fax\" value=\"" . $row["fax"]. "\"></td></tr>" .
          "<tr><td>Email: </td><td><input type=\"text\" name=\"email\" value=\"" .  $row["email"]  . "\"></td></tr>";

              }
          } else {
              echo "0 results";
          }




//details

          $sql = "SELECT * FROM schools where school_id = $school_id";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {


	  echo
          "<tr><td>Founded:</td><td><input type=\"text\" name=\"founded\" value=\"" . $row["founded"]. "\"></td></tr>" .
          "<tr><td>Accreditation</td><td><input type=\"text\" name=\"accr\" value=\"" . $row["accred"]. "\"></td></tr>";
	  $aff=$row[affiliation];

              }
          } else {
              echo "0 results";
          }


$sql = "SELECT * FROM affil where affil_id = $aff";
$result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $currentaff = $row["code"];
            }
          }

          $affilQuery = "SELECT * FROM affil ORDER BY code";
          $affilResult = $conn->query($affilQuery);

        echo "<tr><td>Affiliation:</td><td>
        <select name=\"affil\" value=$currentaff>
        <option value = \"\"></option>";
            while($affilRow = mysqli_fetch_array($affilResult)) {
                    echo "<option ";
                    if($currentaff == $affilRow['code']){echo("selected=\"selected\" ");}
                    echo " value = ".$affilRow['affil_id'].">"
                    . $affilRow['description'] . " (" . $affilRow['code'] . ") </option>";
                }
        echo "</select>
        </td></tr>";

$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

	echo
          "<tr><td>Member Tuition:</td><td><input type=\"text\" name=\"mem_tut\" value=\"" . $row["member_tut"]. "\"></td></tr>" .
          "<tr><td>Non-Member Tuition:</td><td><input type=\"text\" name=\"nonmem_tut\" value=\"" . $row["nonmember_tut"]. "\"></td></tr>" .
          "<tr><td>Comments:</td><td><input type=\"text\" name=\"comments\" value=\"" .  $row["other"]  . "\"></td></tr>";

            }
        } else {
            echo "0 results";
        }

//close database connection
$conn->close();


echo "<input id=\"submit\" onclick=\"update_general($school_id)\" name= \"submit\" type=\"button\" value=\"Submit\">";
?>
</form>
