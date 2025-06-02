<?php
require "db_connection.php";

$idv = $_POST["IDV"];
$soglia = $_POST["Soglia"];

$query = "
    SELECT U.NumeroDocumentoID, U.Nome, U.Cognome, U.Email, U.Recapito, U.VotoMedio
    FROM PRENOTARE P
    INNER JOIN UTENTE U ON U.NumeroDocumentoID = P.NumeroDocumentoID
    WHERE P.IDV = ? AND P.Stato = 'In attesa' AND U.VotoMedio > ?
";

$stmt = $connection->prepare($query);
$stmt->bind_param("id", $idv, $soglia);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Passeggeri con voto medio alto</title>
</head>
<body>
    <h1>Elenco Passeggeri con voto medio &gt; <?php echo $soglia; ?></h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Documento</th><th>Nome</th><th>Cognome</th><th>Email</th><th>Recapito</th><th>Voto Medio</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['NumeroDocumentoID']}</td>
                    <td>{$row['Nome']}</td>
                    <td>{$row['Cognome']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Recapito']}</td>
                    <td>{$row['VotoMedio']}</td>
                 </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun passeggero trovato con questi criteri.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>