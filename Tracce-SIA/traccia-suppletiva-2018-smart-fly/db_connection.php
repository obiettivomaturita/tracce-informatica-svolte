<?php
$connection = new mysqli("localhost", "root", "", "smartfly");

if ($connection->connect_error) {
    die("Connessione fallita: " . $connection->connect_error);
}
?>

