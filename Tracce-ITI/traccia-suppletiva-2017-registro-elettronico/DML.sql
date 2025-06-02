INSERT INTO CLASSE VALUES (1, 'Informatica e Telecomunicazioni - Informatica', 'Tecnico');
INSERT INTO CLASSE VALUES (2, 'Servizi per l’Enogastronomia - Enogastronomia', 'Professionale');
INSERT INTO CLASSE VALUES (3, 'Liceo Scientifico', 'Liceo');
INSERT INTO CLASSE VALUES (4, 'Tecnico Economico', 'Tecnico');
INSERT INTO CLASSE VALUES (5, 'Liceo Classico', 'Liceo');

INSERT INTO STUDENTE VALUES ('RSSMRA99A01H501X', 'Maria', 'Rossi', '2005-04-12', 3, 'maria.rossi@example.com', 'pass1', 1);
INSERT INTO STUDENTE VALUES ('VRDLGI04B12F205Q', 'Giorgio', 'Verdi', '2006-09-20', 1, 'giorgio.verdi@example.com', 'pass2', 1);
INSERT INTO STUDENTE VALUES ('BNCLRA06C23H703U', 'Laura', 'Bianchi', '2006-03-18', 0, 'laura.bianchi@example.com', 'pass3', 2);
INSERT INTO STUDENTE VALUES ('FRNLCU05D14G702R', 'Luca', 'Ferrari', '2005-11-30', 2, 'luca.ferrari@example.com', 'pass4', 3);
INSERT INTO STUDENTE VALUES ('MNTPLA06E25H501S', 'Paola', 'Monti', '2006-01-05', 4, 'paola.monti@example.com', 'pass5', 4);

INSERT INTO DOCENTE VALUES ('BNCPTR80A01H501V', 'Pietro', 'Bianchi', 'Teorico', 'pietro.bianchi', 'doc1');
INSERT INTO DOCENTE VALUES ('VRDPLA75B12F205W', 'Paola', 'Verdi', 'Laboratorio', 'paola.verdi', 'doc2');
INSERT INTO DOCENTE VALUES ('RSSGNN65C23H703X', 'Gianni', 'Rossi', 'Sostegno', 'gianni.rossi', 'doc3');
INSERT INTO DOCENTE VALUES ('FRNFRN70D14G702Y', 'Franco', 'Ferrari', 'Teorico', 'franco.ferrari', 'doc4');
INSERT INTO DOCENTE VALUES ('MNTPOL80E25H501Z', 'Luisa', 'Monti', 'Laboratorio', 'luisa.monti', 'doc5');

INSERT INTO ORE_LEZIONE (DataLezione, OraLezione, Materia, Argomento, CF, IDC) VALUES 
('2025-04-10', '08:00:00', 'Matematica', 'Equazioni di secondo grado', 'BNCPTR80A01H501V', 1),
('2025-04-11', '09:00:00', 'Informatica', 'Array e cicli', 'VRDPLA75B12F205W', 1),
('2025-04-12', '10:00:00', 'Italiano', 'Analisi del testo', 'FRNFRN70D14G702Y', 3),
('2025-04-13', '11:00:00', 'Fisica', 'Forze e vettori', 'BNCPTR80A01H501V', 1),
('2025-04-14', '12:00:00', 'Chimica', 'Composti organici', 'MNTPOL80E25H501Z', 2);

INSERT INTO ASSENZA (DataASS, OraInizio, MinutoInizio, OraFine, MinutoFine, CF, CF_D) VALUES 
('2025-04-10', '08:00:00', 0, '12:00:00', 0, 'RSSMRA99A01H501X', 'BNCPTR80A01H501V'),
('2025-04-11', NULL, NULL, NULL, NULL, 'VRDLGI04B12F205Q', 'VRDPLA75B12F205W'),
('2025-04-12', '09:00:00', 15, NULL, NULL, 'BNCLRA06C23H703U', 'FRNFRN70D14G702Y'),
('2025-04-13', NULL, NULL, '11:00:00', 45, 'FRNLCU05D14G702R', 'FRNFRN70D14G702Y'),
('2025-04-14', '08:00:00', 0, '10:00:00', 30, 'MNTPLA06E25H501S', 'MNTPOL80E25H501Z');

INSERT INTO GIORNO_INTERO VALUES (2);

INSERT INTO ENTRATA_POSTICIPATA VALUES (3, 09, 15);

INSERT INTO USCITA_ANTICIPATA VALUES (4, 11, 45);




