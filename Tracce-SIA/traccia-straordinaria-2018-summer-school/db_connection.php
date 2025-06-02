<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "summer_school";

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_error) {
    die("Connessione al database fallita: " . $connection->connect_error);
}
?>

