<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
        require_once("../resources/css/style.css");
?>


<p>Choose the information and format you would like to export:<p>
<form method="post" action="export/export_action.php">
<select name="export">
	<option value="excel_schools_us">Microsoft Excel - School Info Domestic</option>
	<option value="excel_schools_intl">Microsoft Excel - School Info International</option>
	<option value="excel_schools_demo">Microsoft Excel - Demographics</option>
	<option value="excel_schools_enr">Microsoft Excel - Enrollment Statistics</option>
	<option value="excel_schools_grad">Microsoft Excel - Graduation Statistics</option>
	<option value="excel_directors">Microsoft Excel - Directors</option>
	<option value="excel_assocs">Microsoft Excel - Associations</option>
        <option value="indesign_schools">CSV Export (for inDesign Merge) - School Info</option>
	<option value="indesign_dir">XML Export (for inDesign XML Import) - Directors</option>
</select>
<br>
<br>
<input id="export_button" type="submit" name="Export">
</form>
