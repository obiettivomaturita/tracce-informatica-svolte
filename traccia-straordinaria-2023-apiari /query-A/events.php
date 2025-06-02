<?php
require "db_connection.php";

$regione_selezionata = $_POST["Regione"];

if ($regione_selezionata === "Tutti") {
    $query = "
        SELECT DISTINCT APIC.CF, APIC.Nominativo 
        FROM Apicoltori APIC INNER JOIN Raccogliere R ON R.CF=APIC.CF  
        INNER JOIN Mieli M ON M.Denominazione=R.Denominazione
        INNER JOIN Apiari AP ON M.Denominazione=AP.Denominazione
        WHERE Tipologia = 'DOP'
    ";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Errore nell'esecuzione della query: " . $stmt->error);
    }
} else {
    $query = "
        SELECT DISTINCT APIC.CF, APIC.Nominativo 
        FROM Apicoltori APIC INNER JOIN Raccogliere R ON R.CF=APIC.CF  
        INNER JOIN Mieli M ON M.Denominazione=R.Denominazione
        INNER JOIN Apiari AP ON M.Denominazione=AP.Denominazione
        WHERE Tipologia = 'DOP' AND AP.Regione = ? 
    ";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        die("Errore nella preparazione della query: " . $connection->error);
    }
    $stmt->bind_param("s", $regione_selezionata);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Errore nell'esecuzione della query: " . $stmt->error);
    }
}
?>


<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Elenco Apicoltori</title>
    </head>
    <body>
        <h1>Elenco Apicoltori</h1>
        <?php
            if($result->num_rows>0){
        ?>
            <table border="1">
                <thead>
                    <tr>
                        <th>Id Apicoltore</th>
                        <th>Nominativo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row=$result->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row["CF"]?></td>
                            <td><?php echo $row["Nominativo"]?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            }
            $stmt->close();
            $connection->close();
            ?>
       
    </body>
</html>