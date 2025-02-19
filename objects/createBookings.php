<?php
session_start();
include_once("../functions/functions.php");

$insert = new Crud();

if (isset($_POST['submit'])) {
    // Sanitize user input
    $bookingName = htmlspecialchars($_POST['bookingName']);
    $clientName = htmlspecialchars($_POST['clientName']);
    $date = htmlspecialchars($_POST['date']);

    // Ensure 'service' and 'hours' are arrays
    if (!isset($_POST['service']) || !isset($_POST['hours'])) {
        echo "<script>alert('Error: Please select at least one service and enter hours.');</script>";
        exit();
    }

    $services = $_POST['service']; // Array of selected service IDs
    $hours = $_POST['hours']; // Array of hours corresponding to services

    // Call function to insert booking
    $sql = $insert->createBookings($bookingName, $clientName, $date, $services, $hours);

    if ($sql) {
        echo "<script>alert('Booking successfully added!'); window.location.href = 'bookings.php';</script>";
    } else {
        echo "<script>alert('Error: Booking could not be added.'); window.history.back();</script>";
    }
}
