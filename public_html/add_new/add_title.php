<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
	require_once("../resources/css/style.css");

// connect to the database
require_once("../resources/config/config.php");

// Create connection
$conn1 = mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn1) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM title ORDER BY title";
$result = $conn1->query($query);
?>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {

        $('#add_title').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: './add_new/add_title_action.php',
            data: $('#add_title').serialize(),
            success: function () {
              alert('New Title added.');
		$("#add_title")[0].reset();
            }
          });

        });

      });

//delete title ajax call
$(function () {

        $('#remove_title').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: './add_new/remove_title_action.php',
            data: $('#remove_title').serialize(),
            success: function () {
              alert('Title removed');
                $("#remove_title")[0].reset();
            }
          });

        });

      });
    </script>

<form id="add_title" name="destination">
Add new title: <input type="text" name="title"><br>
<input id="submit" type="submit" value="Add">
</form>
<br><br><br>

<form id="remove_title" name="destination2">
Remove title:
<select name="title_id">
<!--safety blank buffer-->
<option value=""></option>
<?php
        while($row = mysqli_fetch_array($result)) {
                echo '<option value = "'.$row['title_id'].'">'.$row['title'].'</option>';
        }
     ?>
</select>
<br>
<br>
<input id="submit" type="submit" value="Delete">
</form>
