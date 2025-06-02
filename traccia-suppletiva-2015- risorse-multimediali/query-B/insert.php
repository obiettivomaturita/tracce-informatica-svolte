<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];

    if (empty($nome)) {
        die("Il campo Nome è obbligatorio.");
    }

    $query = "INSERT INTO CATEGORIA (Nome) VALUES (?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("s", $nome);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Categoria inserita con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

