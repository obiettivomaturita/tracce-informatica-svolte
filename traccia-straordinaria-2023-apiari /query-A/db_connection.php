<?php

$connection=new mysqli("localhost","root","nuova_password","Miele_italiano_2023");
if($connection->connect_error){
    die("Errore di connessione". $connection->connect_error);
}
?>

