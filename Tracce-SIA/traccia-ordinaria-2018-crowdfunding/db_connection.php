<?php

$connection=new mysqli("localhost","root","nuova_password","CrowdFunding_2018");
if($connection->connect_error){
    die("Errore di connessione". $connection->connect_error);
}
?>

