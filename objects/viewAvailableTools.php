<?php
session_start();
include_once("../functions/functions.php");

$display = new Crud();

$result = $display->viewAvailableTools();

if ($result->num_rows > 0) {
    $tools = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
