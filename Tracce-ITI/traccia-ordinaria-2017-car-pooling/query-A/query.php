<?php
require "db_connection.php";

$partenza = $_POST["partenza"];
$destinazione = $_POST["destinazione"];
$data = $_POST["data"];

$query = "
    SELECT U.Nome, U.Cognome, A.NumeroPatente, VE.Marca, VE.Modello, VE.Targa, VE.NumeroPosti, V.Costo
    FROM VIAGGIO V
    INNER JOIN AUTISTA A ON A.NumeroDocumentoID = V.NumeroDocumentoID
    INNER JOIN UTENTE U ON U.NumeroDocumentoID = A.NumeroDocumentoID
    INNER JOIN VEICOLO VE ON VE.NumeroDocumentoID = A.NumeroDocumentoID
    WHERE V.PrenotazioniChiuse = 0 
      AND V.CittaPartenza = ? 
      AND V.CittaDestinazione = ? 
      AND V.DataPartenza = ?
    ORDER BY V.OraPartenza
";

$stmt = $connection->prepare($query);
$stmt->bind_param("sss", $partenza, $destinazione, $data);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Risultati Ricerca Viaggi</title>
</head>
<body>
    <h1>Viaggi Disponibili</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr>
            <th>Nome</th><th>Cognome</th><th>Patente</th>
            <th>Marca</th><th>Modello</th><th>Targa</th><th>Posti</th><th>Costo</th>
        </tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['Nome']}</td>
                <td>{$row['Cognome']}</td>
                <td>{$row['NumeroPatente']}</td>
                <td>{$row['Marca']}</td>
                <td>{$row['Modello']}</td>
                <td>{$row['Targa']}</td>
                <td>{$row['NumeroPosti']}</td>
                <td>{$row['Costo']}</td>
            </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessun viaggio trovato.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>