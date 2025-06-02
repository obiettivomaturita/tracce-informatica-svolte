<?php

$connection=new mysqli("localhost","root","nuova_password","ManifestazionePubblica_2015");
if($connection->connect_error){
    die("Errore di connessione". $connection->connect_error);
}
?>

