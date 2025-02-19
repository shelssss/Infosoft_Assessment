<?php
session_start();
include_once("../functions/functions.php");

$update = new Crud();

if (isset($_POST['submit'])) {
    $id = $_GET['id']; // Ensure 'id' is passed from the form
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phoneNumber = $_POST['phoneNumber'];

    $user = $update->updateClient($name, $age, $phoneNumber, $id);

    if ($user) {
        $_SESSION['name'] = $name;
        $_SESSION['age'] = $age;
        $_SESSION['phoneNumber'] = $phoneNumber;

        header('location: viewAllClients.php');
        exit(); // Prevents further script execution
    } else {
        echo "Error updating client";
    }
}
?>