INSERT INTO CENTRO (Nome, Città, Provincia, Email, PasswordC) VALUES 
('Centro Nord', 'Milano', 'MI', 'nord@centri.it', SHA2('pwdn', 256)),
('Centro Sud', 'Napoli', 'NA', 'sud@centri.it', SHA2('pwds', 256)),
('Centro Ovest', 'Torino', 'TO', 'ovest@centri.it', SHA2('pwdo', 256)),
('Centro Est', 'Udine', 'UD', 'est@centri.it', SHA2('pwde', 256)),
('Centro C', 'Roma', 'RM', 'centro@centri.it', SHA2('pwdc', 256));


INSERT INTO UTENTE (Email, PasswordU) VALUES 
('alice@email.it', 'pwdalice'),
('bob@email.it', 'pwdbob'),
('carla@email.it', 'pwdcarla'),
('daniele@email.it', 'pwddani'),
('elisa@email.it', 'pwdeli');


INSERT INTO CATEGORIA (Nome) VALUES 
('Tablet'),
('Videogioco'),
('Software Didattico'),
('Ebook'),
('Notebook');


INSERT INTO RISORSA (NumeroInventario, IDC, Nome, Tipologia, Disponibile, Provincia) VALUES 
(1, 1, 'iPad Air', 'Tablet', TRUE, 'MI'),
(2, 2, 'PlayStation 5', 'Videogioco', TRUE, 'NA'),
(3, 3, 'GeoSoft', 'Software Didattico', FALSE, 'TO'),
(4, 4, 'Kindle Paperwhite', 'Ebook', TRUE, 'UD'),
(5, 5, 'HP EliteBook', 'Notebook', TRUE, 'RM');




INSERT INTO PRENOTARE (IDU, NumeroInventario, IDC, DataPrenotazione) VALUES 
(1, 2, 2, '2025-03-20'),
(2, 3, 3, '2025-03-18'),
(3, 1, 1, '2025-03-22'),
(4, 4, 4, '2025-03-25'),
(5, 5, 5, '2025-03-26');


INSERT INTO PRESTITO (DataInizio, DataFine, NumeroInventario, IDC, IDU) VALUES 
('2025-03-01', '2025-03-07', 1, 1, 1),
('2025-03-03', '2025-03-08', 2, 2, 2),
('2025-03-10', '2025-03-15', 3, 3, 3),
('2025-03-12', '2025-03-19', 4, 4, 4),
('2025-03-15', '2025-03-20', 5, 5, 5);




