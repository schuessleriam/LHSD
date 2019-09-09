<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
	require_once("../resources/css/style.css");
?>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {

        $('#add_affil').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: './add_new/add_affil_action.php',
            data: $('#add_affil').serialize(),
            success: function () {
              alert('New affiliation added.');
		$("#add_affil")[0].reset();
            }
          });

        });

      });
    </script>

<form id="add_affil" align = "left"  name="destination">
Add new affiliation: <input type="text" name="description" ><br>
Add code: <input type="text" name="code" ><br>
</br>
<input id="submit" type="submit" value="Submit">

</form>
