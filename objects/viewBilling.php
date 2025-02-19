<?php
session_start();
include_once("../functions/functions.php");

$display = new Crud();

$result = $display->viewPayments();

if ($result->num_rows > 0) {
    $payments = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
