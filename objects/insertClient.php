<?php
session_start();
include_once("../functions/functions.php");

$insertEabab = new Crud();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phoneNumber = $_POST['phoneNumber'];
    

    $sql = $insertEabab->insertClient($name, $age, $phoneNumber);
    if ($sql) {
        echo "<script>alert('Data inserted');</script>";
    } else {
        echo "<script>alert('Data not inserted');</script>";
    }
    header('location: viewAllClients.php');
}
