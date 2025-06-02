<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_categoria = $_POST["Nome"];

    if (empty($nome_categoria)) {
        die("Il campo Nome è obbligatorio.");
    }

    $query = "INSERT INTO CATEGORIA (Nome) VALUES (?)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }

    $stmt->bind_param("s", $nome_categoria);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Categoria inserita con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $connection->close();
}
?>

