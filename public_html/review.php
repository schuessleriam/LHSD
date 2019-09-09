<?php 
        ob_start();
        session_start();

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] ==false){
                header("Location:security.php");
        } 
?>

<body>
<div style="float: left; width: 50%" id="update">
<?php require_once("list_reviews.php");?></div>
<div style="float: right; width: 50%" id="orig"></div>
</body>
