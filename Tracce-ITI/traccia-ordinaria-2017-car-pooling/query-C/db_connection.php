<?php

$connection=new mysqli("localhost","root","nuova_password","CarPooling_2017");
if($connection->connect_error){
    die("Errore di connessione". $connection->connect_error);
}
?>

