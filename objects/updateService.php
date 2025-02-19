
<?php
session_start();
include_once("../functions/functions.php");

$update = new Crud();

if (isset($_POST['submit'])) {
    $id = $_GET['id']; // Ensure 'id' is passed from the form
    $hourlyRate = $_POST['hourlyRate'];
   

    $user = $update->updateServices($hourlyRate, $id);

    if ($user) {
        $_SESSION['hourlyRate'] = $hourlyRate;
        
        header('location: displayServices.php');
        exit(); // Prevents further script execution
    } else {
        echo "Error updating service";
    }
}
?>