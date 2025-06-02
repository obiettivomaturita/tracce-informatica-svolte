INSERT INTO PALESTRA (Denominazione, Città, Indirizzo, Latitudine, Longitudine, Username, Password) VALUES
('Palestra Alpha', 'Pisa', 'Via Roma 1', '43.7167', '10.4000', 'alpha', 'passalpha'),
('Palestra Beta', 'Firenze', 'Via Dante 10', '43.7700', '11.2500', 'beta', 'passbeta'),
('Palestra Gamma', 'Pisa', 'Via Garibaldi 5', '43.7200', '10.4100', 'gamma', 'passgamma'),
('Palestra Delta', 'Milano', 'Corso Buenos Aires 20', '45.4654', '9.1859', 'delta', 'passdelta'),
('Palestra Epsilon', 'Napoli', 'Via Toledo 100', '40.8522', '14.2681', 'epsilon', 'passepsilon');

INSERT INTO ATTIVITA (IDP, Nome, Posti_disponibili, Prezzo, Provincia, Regione) VALUES
(1, 'Yoga', 20, 10.00, 'Pisa', 'Toscana'),
(1, 'Pilates', 15, 12.00, 'Pisa', 'Toscana'),
(2, 'Zumba', 25, 8.00, 'Firenze', 'Toscana'),
(3, 'Boxe', 10, 15.00, 'Pisa', 'Toscana'),
(4, 'Spinning', 30, 9.50, 'Milano', 'Lombardia');

INSERT INTO GIORNO_E_ORA (IDP, IDA, Giorno, Orario_inizio, Orario_fine) VALUES
(1, 1, 2, '09:00:00', '10:00:00'),
(1, 2, 2, '10:00:00', '11:00:00'),
(2, 3, 2, '17:00:00', '18:00:00'),
(3, 4, 3, '18:00:00', '19:00:00'),
(4, 5, 2, '08:00:00', '09:00:00');

INSERT INTO ABBONATO (CF, Nome, Cognome, Username, Password) VALUES
('RSSMRA90A01H501Z', 'Mario', 'Rossi', 'mrossi', 'rossipass'),
('BNCLRA85B60H501P', 'Chiara', 'Bianchi', 'cbianchi', 'bianchipass'),
('VRDLGI92C10F205K', 'Luigi', 'Verdi', 'lverdi', 'verdipass'),
('FNTFBA93H60D612A', 'Fabio', 'Fontana', 'ffontana', 'fontanapass'),
('SRNGPP88B77E123V', 'Giuseppe', 'Sereni', 'gsereni', 'serenipass');

INSERT INTO PRENOTARE (CF, IDP, IDA, Data_prenotazione) VALUES
('RSSMRA90A01H501Z', 1, 1, '2024-04-02'),
('BNCLRA85B60H501P', 1, 2, '2024-04-02'),
('VRDLGI92C10F205K', 2, 3, '2024-04-03'),
('FNTFBA93H60D612A', 3, 4, '2024-04-04'),
('SRNGPP88B77E123V', 4, 5, '2024-04-02');
