<?php
include_once("../functions/functions.php");

$display = new Crud();

$result = $display->viewClients();

if ($result->num_rows > 0) {
    $clients = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
