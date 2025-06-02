<?php

$connection=new mysqli("localhost","root","nuova_password","RegistroElettronico_2017");
if($connection->connect_error){
    die("Errore di connessione". $connection->connect_error);
}
?>

