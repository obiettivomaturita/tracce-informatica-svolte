<?php
require "db_connection.php";

$soglia = $_POST["soglia"];

$query = "
SELECT S.Nome, S.Cognome, C.IDC
FROM STUDENTE S
INNER JOIN CLASSE C ON S.IDC = C.IDC
WHERE S.TotAssenze > ?
";

$stmt = $connection->prepare($query);
$stmt->bind_param("i", $soglia);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Studenti con Assenze Eccessive</title>
</head>
<body>
    <h1>Studenti con più di <?php echo $soglia; ?> ore di assenza</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'><thead><tr>
              <th>Nome</th><th>Cognome</th><th>Classe</th>
              </tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                  <td>{$row['Nome']}</td>
                  <td>{$row['Cognome']}</td>
                  <td>{$row['IDC']}</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuno studente ha superato la soglia indicata.</p>";
    }

    $stmt->close();
    $connection->close();
    ?>
</body>
</html>