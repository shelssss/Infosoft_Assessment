<?php
include_once("../functions/functions.php");
if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $amount = floatval($_POST['amount']); // Convert amount to a number
    $payment_method = $_POST['payment_method'];

    $update = new Crud();
    $success = $update->processPayment($amount, $payment_method, $id);

    if ($success) {
        $_SESSION['amount'] = $amount;
        $_SESSION['payment_method'] = $payment_method;
        header('location: bookings.php');
        exit();
    } else {
        echo "Error updating billing.";
    }
}

