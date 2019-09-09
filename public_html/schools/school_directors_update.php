<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script src="scripts.js"></script>
<?php
// connect to the database
require_once("../../resources/config/config.php");
// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//select school to be outputted
$school_id = $_REQUEST["school_id"];

//Display School Name
$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo "<h3>" . $row["school_name"]."</h3>" .

                "<button id='back' onclick=\"loadTab('Directors', 'schools/school_directors.php?school_id=', $school_id)\">Back</button><br><br>";
}
}
?>

<!-- Dynamic input table for faculty members -->

<p>
<input id="addrem" type="button" value="Add" onclick="addRowToTable_update();" />
<input id="addrem" type="button" value="Remove" onclick="removeRowFromTable_update();" />

<form id="update_directors"  name="destination">
<input type="hidden" name="schoolid" value="<?php echo $school_id; ?>">
</p>
<p>
</p>
<table border="1" id="tbl_update">
  <tr>
    <th colspan="3">Add Faculty Members</th>
  </tr>
  <tr>
    <td>1</td>
    <td><input type="text" name="textRow1"
     id="textRow1" size="40" onkeypress="keyPressTest_update(event, this);" /></td>
     <td>Email  <input type="text" name="emailRow1"
     id="emailRow1" size="40" onkeypress="keyPressTest_update(event, this);" /></td>
    <td>Title
    <select id = "selectRow1" name="selectRow1" style="width: 200px;">
    <?php
        $query = "SELECT title FROM title ORDER BY title";
	$result = $conn->query($query);
	while($row = mysqli_fetch_array($result)) {
                echo '<option value = "'.$row['title'].'">'.$row['title'].'</option>';
        }
     ?>
    </select>
    </td>
  </tr>
</table>

</br>

<?php
echo "<input id=\"submit\" onclick=\"update_directors($school_id)\" name= \"submit\" type=\"button\" value=\"Submit\">";
?>
<br>

</form>
<!--end of add faculty form---------------------------------------------------->

<?php
//show existing positions with edit capabilities-------------------------------
echo "<section class=\"infoaside\">";


//Display School's director info
$sql = "SELECT positions.position_id, positions.title_id, positions.name, positions.email, title.title_id,
title.title
FROM title
INNER JOIN positions ON title.title_id=positions.title_id
where school_id = $school_id";
$result = $conn->query($sql);

echo " <table><tr>
<th>Title</th>
<th>Name</th>
<th>Email</th>
</tr>";

if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row["title"] . "</td><td> " . $row["name"]
              . "</td><td> " . $row["email"] . "</td><td>
		<button onclick=\"
		delete_title(" . $row['position_id']  . ", $school_id)\">
		Delete</button></td></tr></section>";

          }
      } else {
          echo "0 results";
      }


//close database connection
$conn->close();
?>
