INSERT INTO UTENTE (CF, Nome, Cognome, Provincia, Email, Nickname, PasswordU) VALUES
('RSSMRA80A01H501Z', 'Mario', 'Rossi', 'Milano', 'mario.rossi@example.com', 'marior', 'pw1'),
('BNCLRA85B02F205Y', 'Laura', 'Bianchi', 'Roma', 'laura.bianchi@example.com', 'laurab', 'pw2'),
('VRDLGI90C03D612X', 'Giulia', 'Verdi', 'Napoli', 'giulia.verdi@example.com', 'giuliav', 'pw3'),
('FBRGPP75D04H703W', 'Giuseppe', 'Fabri', 'Torino', 'giuseppe.fabri@example.com', 'giusep', 'pw4'),
('LCNMRC95E05C351J', 'Marco', 'Luciani', 'Genova', 'marco.luciani@example.com', 'marcol', 'pw5'); 

INSERT INTO EVENTO (Titolo, Luogo, DataE, Provincia, CF) VALUES
('Concerto Rock', 'Palazzetto dello Sport', '2024-06-15', 'Milano', 'RSSMRA80A01H501Z'),
('Spettacolo Teatrale', 'Teatro Antico', '2024-07-10', 'Roma', 'BNCLRA85B02F205Y'),
('Balletto Classico', 'Teatro San Carlo', '2024-05-20', 'Napoli', 'VRDLGI90C03D612X'),
('Jazz Night', 'Jazz Club Torino', '2024-08-25', 'Torino', 'FBRGPP75D04H703W'),
('Festival Indie', 'Piazza De Ferrari', '2024-09-05', 'Genova', 'LCNMRC95E05C351J');
INSERT INTO COMMENTARE (CF, IDE, DataCommento, Voto, Commento) VALUES
('RSSMRA80A01H501Z', 2, '2024-07-11 10:00:00', '5', 'Spettacolo bellissimo!'),
('BNCLRA85B02F205Y', 1, '2024-06-16 11:30:00', '4', 'Molto coinvolgente.'),
('VRDLGI90C03D612X', 4, '2024-08-26 20:00:00', '5', 'Musica incredibile!'),
('FBRGPP75D04H703W', 3, '2024-05-21 18:00:00', '3', 'Bella coreografia.'),
('LCNMRC95E05C351J', 5, '2024-09-06 09:45:00', '4', 'Atmosfera fantastica.');

INSERT INTO ARTISTA (Nome, Nazionalita) VALUES
('Band Rock', 'Italia'),
('Compagnia Teatrale Roma', 'Italia'),
('Corpo di Ballo', 'Russia'),
('Quartetto Jazz', 'USA'),
('Gruppo Indie', 'UK');


INSERT INTO COINVOLGERE (IDE, IDA) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

INSERT INTO CATEGORIA (Nome) VALUES
('Concerto'),
('Teatro'),
('Danza'),
('Jazz'),
('Festival');


INSERT INTO APPARTENERE (IDE, IDCA) VALUES
(1, 1),  
(2, 2),  
(3, 3),  
(4, 4),  
(1, 5);  




