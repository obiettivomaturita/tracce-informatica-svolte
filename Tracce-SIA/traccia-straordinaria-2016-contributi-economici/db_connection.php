<?php
$host = "localhost";
$user = "root";
$password = "";  
$dbname = "contributi_2016";

$connection = new mysqli($host, $user, $password, $dbname);

if ($connection->connect_error) {
    die("Connessione fallita: " . $connection->connect_error);
}
?>

