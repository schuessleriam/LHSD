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
$conn=mysqli_connect($dbhost, $dbusername, $dbpass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//update table -------------------------------------------------------------------------------------
$update="UPDATE grad_stats SET
year='$_POST[year]',
grad_num='$_POST[grad_num]',
luth_grad_num='$_POST[luth_grad_num]',
percent_to_clg='$_POST[percent_to_clg]',
grads_at_luth='$_POST[grads_at_luth]',
grads_at_nonluth='$_POST[grads_at_nonluth]',
grads_at_public='$_POST[grads_at_public]',
luth_grads_at_luth='$_POST[luth_grads_at_luth]',
luth_grads_at_priv='$_POST[luth_grads_at_priv]',
luth_grads_at_public='$_POST[luth_grads_at_public]'
WHERE school_id='$_POST[school_id]'";

        if ($conn->query($update) === TRUE) {
            echo "Successful submission";
        } else {
            echo "Error: " . $update . "<br>" . $conn->error;
        }

mysqli_close($conn);

        ?>
