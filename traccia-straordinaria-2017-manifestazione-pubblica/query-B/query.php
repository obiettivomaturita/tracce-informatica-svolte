<?php
require "db_connection.php";

$categoria = $_POST["categoria"];

if ($categoria == "Tutte") {
    $query = "
        SELECT E.Cognome, E.Nome, C.Titolo, A.Nome as AREA
        FROM AREA A
        INNER JOIN ESPOSITORE E ON E.IDA = A.IDA
        INNER JOIN CANDIDATURA C ON C.CF = E.CF
        INNER JOIN APPARTENERE AP ON AP.IDC = C.IDC
        INNER JOIN CATEGORIA CA ON AP.IDCA = CA.IDCA
        WHERE C.StatoCandidatura = 'Accettato'
    ";
    $stmt = $connection->prepare($query);
} else {
    $query = "
        SELECT E.Cognome, E.Nome, C.Titolo, A.Nome AS AREA
        FROM AREA A
        INNER JOIN ESPOSITORE E ON E.IDA = A.IDA
        INNER JOIN CANDIDATURA C ON C.CF = E.CF
        INNER JOIN APPARTENERE AP ON AP.IDC = C.IDC
        INNER JOIN CATEGORIA CA ON AP.IDCA = CA.IDCA
        WHERE C.StatoCandidatura = 'Accettato' AND CA.Nome = ?
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $categoria);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Esposizioni per Categoria</title>
</head>
<body>
    <h1>Esposizioni per Categoria: <?php echo $categoria; ?></h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Cognome</th><th>Nome</th><th>Titolo</th><th>Area</th></th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Cognome"] . "</td>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Titolo"] . "</td>";
            echo "<td>" . $row["Area"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuna esposizione trovata per questa categoria.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>