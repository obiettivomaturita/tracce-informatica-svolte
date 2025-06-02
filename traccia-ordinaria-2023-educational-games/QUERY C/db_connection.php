<?php

$connection=new mysqli("localhost","root","nuova_password","SportOvunque_2023");
if($connection->connect_error){
    die("Errore di connessione". $connection->connect_error);
}
else{
    echo "Connesso con successo";
}
?>

