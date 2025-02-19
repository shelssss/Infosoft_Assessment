<?php

include_once("../functions/functions.php");

$display = new Crud();

$result = $display->viewServices();

if ($result->num_rows > 0) {
    $services = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
