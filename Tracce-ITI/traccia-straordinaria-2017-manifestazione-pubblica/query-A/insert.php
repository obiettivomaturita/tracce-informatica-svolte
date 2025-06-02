<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $cf = $_POST["CF"];
            $nome = $_POST["Nome"];
            $cognome = $_POST["Cognome"];
            $telefono = $_POST["RecapitoTelefonico"];
            $email = $_POST["Email"];
            $username = $_POST["Username"];
            $password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
            $qualifica = $_POST["Qualifica"];
            $cv = $_POST["CurriculumPDF"];
            $ida = $_POST["IDA"];

            $query = "INSERT INTO ESPOSITORE (CF, Nome, Cognome, RecapitoTelefonico, Email, Username, PasswordE, Qualifica, CurriculumPDF, IDA)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("sssssssssi", $cf, $nome, $cognome, $telefono, $email, $username, $password, $qualifica, $cv, $ida);
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Espositore inserito con successo!</p>";
            } else {
                echo "<p style='color: red;'>Errore: " . $stmt->error . "</p>";
            }
            $stmt->close();
            $connection->close();
        }


