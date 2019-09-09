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
$conn = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<section class=\"infoaside\">";

//select school to be outputted
$school_id = $_REQUEST["school_id"];

//Display School Name
$sql = "SELECT * FROM schools where school_id = $school_id";
$result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
		echo "<h3>" . $row["school_name"]."</h3>" .

		"<button id='edit' onclick=\"loadTab('Directors', 'schools/school_directors_update.php?school_id=', $school_id)\">Edit</button>";
}
}

//Display School's director info
$sql = "SELECT positions.title_id, positions.name, positions.email, title.title_id,
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
              . "</td><td> " . $row["email"] . "</td></tr></section>";

          }
      } else {
          echo "0 results";
      }

//close database connection
$conn->close();
?>
