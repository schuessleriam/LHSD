<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
	require_once("../../resources/css/style.css");
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<body style="margin:0px; padding:0px;" onload="initialize()">
<?php
// connect to the database
require_once("../../resources/config/config.php");

// Create connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<section class=\"infoaside\">";

//select update submission to be outputted
$temp_data_id = $_REQUEST["temp_data_id"];
?>

<div class="subtab" style="overflow:hidden;">
<button class="subtablinks" onclick="return_to_list()">Back</button>
</div>

<?php
$sql = "SELECT * FROM temp_data where temp_data_id = $temp_data_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {

	  echo "<br><h3>Update to " . $row["school_name"] . "</h3>
<button id='appdis' onclick=\"approve('" . $row["temp_data_id"]  . "')\">Approve Changes</button>
<button id='appdis' onclick=\"discard('" . $row["temp_data_id"]  . "')\">Discard Changes</button><br>
<h4>Recent updated information:</h4><br>";

          echo "<table id='update_tbl'>
          <tr><td>Website: </th><td>" .  $row["website"]  . "</td></tr>
          <tr><td>Address:</td><td>" . $row["street"].
          " " . $row["city"] . ", " . $row["state"] . "</td></tr>" .
          "<tr><td>Zip:</td><td>" . $row["zip"]. "</td></tr>" .
          "<tr><td>Country: </td><td>" .  $row["country"]  . "</td></tr>";
              }
          } else {
              echo "There are currently no updates to process.";
          }

$sql = "SELECT * FROM temp_data where temp_data_id = $temp_data_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          echo "<tr><td>Boarding school:</td><td> ";
            if($row["boarding_school"]){
              echo "Yes</td></tr>";
            }

            else{
               echo "No</td></tr>";
            }

          echo "<tr><td>Phone:</th><td> " . $row["phone"]. "</td></tr>" .
          "<tr><td>Fax:</th><td> " . $row["fax"]. "</td></tr>" .
          "<tr><td>Email:</th><td> " .  $row["email"]  . "</td></tr>";
 	  $affil = $row["affil"];
              }
          } else {
              echo "There are currently no updates to process.";
          }



//Get affiliation info to desplay description and code values in affiliation box
$sql = "SELECT * FROM affil where affil_id = $affil";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
$description = $row["description"];
$code = $row["code"];

              }
          }


//details

        $sql = "SELECT * FROM temp_data where temp_data_id = $temp_data_id";
	$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {

           echo
          "<tr><td>Founded:</td><td> " . $row["founded"]. "</td></tr>" .
          "<tr><td>Accreditation:</td><td> " . $row["accred"]. "</td></tr>
          <tr><td>Affiliation:</td><td> $description ($code) </td></tr>
          <tr><td>Member Tuition:</td><td> " . $row["member_tut"]. "</td></tr>" .
        "<tr><td>Non-Member Tuition: </td><td>" . $row["nonmember_tut" ]. "</td></tr>" .
        "<tr><td>Comments: </td><td>" . $row["other"]. "</td></tr>
        <tr><th>Faculty</th><td></td></tr>" .
        "<tr><td>Full Time:</th><td>" . $row["full_time_staff"]. "</th></td>" .
        "<tr><td>Part Time: </th><td>" . $row["part_time_staff"]. "</th></td>
        <tr><th>Current Enrollment</th><td></td></tr>" .
        "<tr><td>9th: </th><td>" . $row["freshmen"]. "</th></td>" .
        "<tr><td>10th: </th><td>" . $row["sophomore"]. "</th></td>" .
        "<tr><td>11th: </th><td>" . $row["junior"]. "</th></td>" .
        "<tr><td>12th: </th><td>" . $row["senior"]. "</th></td>
        <tr><th>Estimated Ethnicity Percentages</th><td></td></tr>" .
        "<tr><td>Asian: </th><td>" . $row["percent_asian"]. "</td></tr>" .
        "<tr><td>Black: </th><td>" . $row["percent_black"]. "</td></tr>" .
        "<tr><td>Hispanic: </th><td>" . $row["percent_hispanic"]. "</td></tr>" .
        "<tr><td>White: </th><td>" . $row["percent_white"]. "</td></tr>" .
        "<tr><td>Other: </th><td>" . $row["percent_other"]. "</td></tr>" .
        "<tr><td>Lutheran: </th><td>" . $row["percent_lutheran"]. "</td></tr>" .
	"<tr><th>Graduation Statistics</th><td></td></tr>" .
	"<tr><td>Graduates: </td><td>" . $row["grad_num"]. "</td></tr>" .
        "<tr><td>Lutheran Graduates: </td><td>" . $row["luth_grad_num"]. "</td></tr>" .
        "<tr><td>Total Percent to College: </td><td>" . $row["percent_to_clg"]. "</td></tr>" .
        "<tr><th>Graduates </th><td></td></tr>" .
        "<tr><td>Lutheran College/University: </td><td>" . $row["grads_at_luth"]. "</tr></tr>" .
        "<tr><td>Non-Lutheran College/University: </td><td>" . $row["grads_at_nonluth"]. "</td></tr>" .
        "<tr><td>Public College/University: </td><td>" . $row["grads_at_public"]. "</td></tr>" .
        "<tr><th>Lutheran Graduates</th><td></td></tr>" .
        "<tr><td>Lutheran College/University: </td><td>" . $row["luth_grads_at_luth"]. "</td></tr>" .
        "<tr><td>Private College/University: </td><td>" . $row["luth_grads_at_priv"]. "</td></tr>" .
        "<tr><td>Public College/University: </td><td>" . $row["luth_grads_at_public"]. "</td></tr>" ;

      }
  } else {
      echo "There are currently no updates to process.";
  }

// Display School's director info
        $sql = "SELECT temp_positions.title_id, temp_positions.name, temp_positions.email, title.title_id,
        title.title
        FROM title
        INNER JOIN temp_positions ON title.title_id=temp_positions.title_id
        where temp_data_id = $temp_data_id";
        $result = $conn->query($sql);

echo "<tr><th>Directors</th><td></td><td></td></tr>";

        if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "<tr><td>" . $row["title"] . "</td><td> " . $row["name"]
                      . "</td><td> " . $row["email"] . "</td></tr></section>";

                  }
              } else {
                  echo "There are currently no updates to process.";
              }




        $conn->close();
        ?>
