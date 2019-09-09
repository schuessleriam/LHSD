<?php 
	ob_start();
	session_start();

	if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
		header("Location:security.php");
	} 
?>

<html>

<head>

<meta name="google-signin-scope" content="profile email">
<meta name="google-signin-client_id" content="133501016740-fu7gq89sutqauqaos95h4fvjv0k9phsb.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="js/scripts.js" ></script>
 <script>
  window.onload = function() {
	setTimeout(function(){
	document.body.style.opacity="100";},500);
	openMainTab(event, 'ViewSchools');
};
 </script>

<?php
// Format doc
   require_once("../resources/css/style.css");
?>
<title>VULHSD</title>
</head>

<img src="img/logo.png" align="middle" width="15%" height=auto  alt="Valparaiso University" style="margin: 4px 0px">
<h2 style="margin: 0px 4px">Valparaiso University Lutheran High School Database</h2></a>

<body>
<style> body  {opacity:0;}</style>

<div class="maintab" style="overflow:hidden;">
  <button class="maintablinks" onclick="openMainTab(event, 'Add')">New</button>
  <button class="maintablinks" onclick="openMainTab(event, 'ViewSchools')">Schools</button>
  <button class="maintablinks" onclick="openMainTab(event, 'Associations')">Associations</button>
  <button class="maintablinks" onclick="openMainTab(event, 'Affiliations')">Affiliations</button>
  <button class="maintablinks" onclick="openMainTab(event, 'Review')">Review</button>
  <button class="maintablinks" onclick="openMainTab(event, 'Export')">Export</button>
  <button class="maintablinks" onclick="openMainTab(event, 'System')">System</button>
  <form method="post" action="Logout.php"><input class="maintablinks" id="logout" type="submit" value="Logout" style="float: right"></form>
</div>


<div id="Add" class="maintabcontent">
<div class="subtab" style="overflow:hidden;">
  <button class="subtablinks" onclick="openSubTab(event, 'AddSchool')">Add School</button>
  <button class="subtablinks" onclick="openSubTab(event, 'Titles')">Add Title</button>
  <button class="subtablinks" onclick="openSubTab(event, 'AddAffiliation')">Add Affiliation</button>
  <button class="subtablinks" onclick="openSubTab(event, 'AddAssociation')">Add Association</button>
</div>

<div id="AddSchool" class = "subtabcontent">
  <?php
  require_once("add_new/add_school.php");
  ?>
</div>

<div id="Titles" class="subtabcontent">
 <?php
  require_once("add_new/add_title.php");
  ?>
</div>

<div id="AddAffiliation" class="subtabcontent">
 <?php
  require_once("add_new/add_affil.php");
  ?>
</div>

<div id="AddAssociation" class="subtabcontent">
 <?php
  require_once("add_new/add_assoc.php");
 ?>
</div>
</div>
<!-- End of Main Tab "Add"-->


<div id="ViewSchools" class="maintabcontent">
<?php require_once("school_list.php");?>
</div>
<!-- End of Main Tab "ViewSchools"-->

<div id="Associations" class="maintabcontent">
<?php require_once("list_assocs.php");?>
</div>
<!-- End of Main Tab "Associations"-->

<div id="Review" class="maintabcontent">
<?php require_once("review.php");?>
</div>
<!-- End of Main Tab "Review"-->

<div id="Export" class="maintabcontent">
<?php require_once("export/export.php");?>
</div>
<!-- End of Main Tab "Export"-->

<div id="System" class="maintabcontent">
<?php require_once("system.php");?>
</div>
<!-- End of Main Tab "System"-->

<div id="Affiliations" class="maintabcontent">
<?php require_once("affiliations.php");?>
</div>

</body>

</html>
