<?php
include_once("../functions/functions.php");
$fetch = new Crud();

$bookings = $fetch->fetchBookings(); // Get bookings data
