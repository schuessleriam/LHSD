
<form>
<label for="schoolsearch">Search: </label>
<input type="text" id="schoolsearch" size="40" placeholder="School Name" onkeyup="showResult(this.value)"><br>
<div id="livesearch">

<?php
require_once("list_school_action.php");
require_once("../../resources/css/public_style.css");
?>

</div>
</form>
