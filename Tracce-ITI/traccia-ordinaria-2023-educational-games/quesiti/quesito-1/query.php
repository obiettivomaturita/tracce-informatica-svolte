<!DOCTYPE html>
<html lang="it">
<head> 
    <meta charset="UTF-8">
    <title>Seleziona Classe Virtuale</title>
</head>
<body>
    <h1>Seleziona Classe Virtuale</h1>
    <form action="query.php" method="POST">
        <label for="nome">Nome Classe Virtuale:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="materia">Materia della Classe Virtuale:</label>
        <input type="text" id="materia" name="materia" required><br><br>

        <input type="submit" value="Visualizza Classifica">
    </form>
</body>
</html>



<?php


require "db_connection.php";
$nome=$_POST["nome"];
$materia=$_POST["materia"];

$query = "
    SELECT S.Nome,S.Cognome,SUM(G.Monete_raccolte) as TotMonete
    FROM STUDENTE S INNER JOIN ISCRIVERE I ON S.IDS=I.IDS 
    INNER JOIN CLASSE_VIRTUALE CV ON I.NOME=CV.Nome AND I.Materia=CV.Materia
    INNER JOIN APPARIRE A ON A.Nome=CV.Nome AND A.Materia=CV.Materia 
    INNER JOIN VIDEOGIOCO V ON V.IDV=A.IDV
    INNER JOIN GIOCARE G ON G.IDV=V.IDV
    WHERE CV.Nome=? AND CV.Materia=?
    GROUP BY S.IDS,S.Nome,S.Cognome 
    ORDER BY TotMonete DESC
";
$stmt=$connection->prepare($query);
$stmt->bind_param('ss',$nome,$materia);
$stmt->execute();
$result=$stmt->get_result();

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Classifica Studenti</title>
</head>
<body>
    <h1>Classifica Studenti</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead><tr><th>Nome</th><th>Cognome</th><th>Monete Raccolte</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Nome"] . "</td>";
            echo "<td>" . $row["Cognome"] . "</td>";
            echo "<td>" . $row["TotMonete"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>Nessuno studente trovato per questa classe virtuale.</p>";
    }
    $stmt->close();
    $connection->close();
    ?>
</body>
</html>



