<?php

$connection=new mysqli("localhost","root","nuova_password","Consorzio_2015");
if($connection->connect_error){
    die("Errore di connessione". $connection->connect_error);
}
?>

