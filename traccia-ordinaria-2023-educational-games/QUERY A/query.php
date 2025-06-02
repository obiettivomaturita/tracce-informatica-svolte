<?php
require 'db_connection.php';

$city =$_POST['Città'];



if ($city === "Tutti" || empty($city)) {

    $query = "
    SELECT P.Denominazione, A.Nome, G.Orario_inizio, G.Orario_fine, A.Posti_disponibili, A.Prezzo
    FROM PALESTRA P
    INNER JOIN ATTIVITA A ON P.IDP = A.IDP
    INNER JOIN GIORNO_E_ORA G ON A.IDP = G.IDP AND A.IDA = G.IDA
    WHERE G.Giorno = 2
    ORDER BY P.Denominazione;
    ";
    $stmt = $connection->prepare($query);
} else { 
    $query = "
    SELECT P.Denominazione, A.Nome, G.Orario_inizio, G.Orario_fine, A.Posti_disponibili, A.Prezzo
    FROM PALESTRA P
    INNER JOIN ATTIVITA A ON P.IDP = A.IDP
    INNER JOIN GIORNO_E_ORA G ON A.IDP = G.IDP AND A.IDA = G.IDA
    WHERE P.Città = ? AND G.Giorno = 2
    ORDER BY P.Denominazione;
    ";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $city);
}

if (!$stmt) {
    die("Errore nella preparazione della query: " . $connection->error);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Attività Disponibili in <?php echo $city; ?></title>
</head>
<body>
    <h1>Attività Disponibili in <?php echo $city; ?> (Mercoledì)</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Palestra</th>";
        echo "<th>Attività</th>";
        echo "<th>Orario Inizio</th>";
        echo "<th>Orario Fine</th>";
        echo "<th>Posti Disponibili</th>";
        echo "<th>Prezzo</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Denominazione"] . "</td>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Orario_inizio"] . "</td>";
            echo "<td>" . $row["Orario_fine"] . "</td>";
            echo "<td>" . $row["Posti_disponibili"] . "</td>";
            echo "<td>" . $row["Prezzo"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>Nessuna attività disponibile.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>

