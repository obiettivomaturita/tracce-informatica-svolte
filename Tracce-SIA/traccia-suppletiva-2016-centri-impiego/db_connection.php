<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "CPI_2016";

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_error) {
    die("Connessione fallita: " . $connection->connect_error);
}
?>

