<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<form>
<label for="schoolsearch">Search: </label>
<input type="text" id="schoolsearch" size="40" placeholder="School Name" onkeyup="showResult(this.value)"><br>
<div id="livesearch">
<?php
require_once("school_by_state.php");
?>
</div>
</form>
