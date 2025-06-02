INSERT INTO UTENTE (NumeroDocumentoID, Nome, Cognome, Recapito, Email, PasswordU, Giudizio, VotoMedio) VALUES
('A1', 'Luca', 'Rossi', '3331234567', 'luca@email.it', 'pass123', 'Molto preciso', 8.5),
('A2', 'Maria', 'Bianchi', '3337654321', 'maria@email.it', 'pass456', 'Affidabile', 9.2),
('A3', 'Giulio', 'Verdi', '3339876543', 'giulio@email.it', 'pass789', 'Disponibile', 8.0),
('A4', 'Chiara', 'Gialli', '3335556666', 'chiara@email.it', 'passabc', 'In ritardo', 6.7),
('A5', 'Elisa', 'Neri', '3334445555', 'elisa@email.it', 'passdef', 'Sempre puntuale', 9.8);

INSERT INTO AUTISTA (NumeroDocumentoID, NumeroPatente, ScadenzaPatente, Targa) VALUES
('A1', 'PA123456', '2026-05-30', 'AB123CD'),
('A2', 'PA654321', '2025-12-15', 'CD456EF'),
('A3', 'PA112233', '2027-03-10', 'GH789IJ'),
('A5', 'PA998877', '2024-08-25', 'OP345QR'),
('A4', 'PA445566', '2026-01-01', 'KL012MN');

INSERT INTO PASSEGGERO (NumeroDocumentoID) VALUES
('A1'),
('A2'),
('A3'),
('A4'),
('A5');

INSERT INTO VALUTARE (IDValutatore, IDValutato, DataValutazione, Voto, Giudizio) VALUES
('A1', 'A2', '2024-11-01 10:00:00', 9, 'Cordiale e puntuale'),
('A3', 'A1', '2024-12-10 12:00:00', 8, 'Ha guidato bene'),
('A5', 'A2', '2025-01-20 08:45:00', 10, 'Molto gentile'),
('A2', 'A3', '2025-02-15 09:30:00', 7, 'In ritardo'),
('A4', 'A5', '2025-03-01 11:00:00', 9, 'Esperienza positiva');

INSERT INTO VEICOLO (Targa, Marca, Modello, Anno, NumeroPosti) VALUES
('AB123CD', 'Fiat', 'Panda', 2018, 4),
('CD456EF', 'Volkswagen', 'Golf', 2016, 5),
('GH789IJ', 'Toyota', 'Yaris', 2020, 4),
('KL012MN', 'Renault', 'Clio', 2019, 5),
('OP345QR', 'Ford', 'Focus', 2021, 5);

INSERT INTO VIAGGIO (IDV, DataPartenza, OraPartenza, CittaPartenza, CittaDestinazione, Costo, Durata, Soste, Bagaglio, Animali, PrenotazioniChiuse, NumeroDocumentoID) VALUES
(1, '2025-04-10', '08:00:00', 'Milano', 'Roma', 35.00, '06:00:00', '2 soste previste', 1, 0, 0, 'A1'),
(2, '2025-04-12', '09:30:00', 'Napoli', 'Firenze', 28.00, '05:30:00', '1 sosta carburante', 1, 1, 0, 'A2'),
(3, '2025-04-15', '14:00:00', 'Bologna', 'Torino', 22.00, '04:30:00', 'nessuna', 0, 0, 0, 'A3'),
(4, '2025-04-18', '07:15:00', 'Genova', 'Milano', 18.00, '02:00:00', '1 sosta', 1, 0, 0, 'A4'),
(5, '2025-04-20', '10:00:00', 'Verona', 'Venezia', 20.00, '01:45:00', 'nessuna', 0, 1, 0, 'A5');

INSERT INTO PRENOTARE (NumeroDocumentoID, IDV, Stato) VALUES
('A2', 1, 'In attesa'),
('A3', 1, 'Accettata'),
('A4', 2, 'Rifiutata'),
('A5', 3, 'Accettata'),
('A1', 4, 'In attesa');


