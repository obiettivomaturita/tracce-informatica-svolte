INSERT INTO AREA (IDA, Nome, CapienzaMassima) VALUES
(1, 'Padiglione A', 100),
(2, 'Padiglione B', 80),
(3, 'Area Esterna Nord', 150),
(4, 'Sala Conferenze', 60),
(5, 'Spazio Creativo', 50);

INSERT INTO ESPOSITORE (CF, Nome, Cognome, RecapitoTelefonico, Email, Username, PasswordE, Qualifica, CurriculumPDF, IDA) VALUES
('RSSMRA80A01H501U', 'Mario', 'Rossi', '3331234567', 'mario.rossi@example.com', 'mariorossi', 'pw123', 'professionista del settore', 'cv_mario.pdf', 1),
('BNCLRA75C12F205X', 'Laura', 'Bianchi', '3337654321', 'laura.bianchi@example.com', 'laurab', 'pw456', 'esperto non professionista', 'cv_laura.pdf', 2),
('VRDGPP90D41Z404Q', 'Giuseppe', 'Verdi', '3331122334', 'giuseppe.verdi@example.com', 'verdig', 'pw789', 'amatore', 'cv_giuseppe.pdf', 3),
('FLLFNC60E12L219B', 'Francesca', 'Folli', '3339988776', 'francesca.folli@example.com', 'follifra', 'pw321', 'professionista del settore', 'cv_francesca.pdf', 1),
('PLLMRA85B52Z404H', 'Marco', 'Pellegrini', '3335566778', 'marco.pellegrini@example.com', 'pellmarco', 'pw654', 'esperto non professionista', 'cv_marco.pdf', 4);

INSERT INTO CANDIDATURA (IDC, Titolo, Descrizione, Immagine, URLApprofondimento, StatoCandidatura, CF) VALUES
(1, 'Robotica educativa', 'Progetto didattico su robotica', 'img1.jpg', 'http://robotica.edu', 'Accettato', 'RSSMRA80A01H501U'),
(2, 'Arte digitale', 'Mostra interattiva su arte digitale', 'img2.jpg', 'http://arte.it', 'In attesa', 'BNCLRA75C12F205X'),
(3, 'Giardino sensoriale', 'Installazione per stimolare i sensi', 'img3.jpg', 'http://giardino.org', 'Accettato', 'VRDGPP90D41Z404Q'),
(4, 'Stampa 3D e design', 'Dimostrazione dal vivo di stampa 3D', 'img4.jpg', 'http://stampa3d.net', 'Rifiutato', 'FLLFNC60E12L219B'),
(5, 'Musica e tecnologia', 'Laboratorio su strumenti digitali', 'img5.jpg', 'http://musictech.org', 'Accettato', 'PLLMRA85B52Z404H');


INSERT INTO CATEGORIA (IDCA, Nome) VALUES
(1, 'Tecnologia'),
(2, 'Arte'),
(3, 'Educazione'),
(4, 'Ambiente'),
(5, 'Design');

INSERT INTO APPARTENERE (IDC, IDCA) VALUES
(1, 1),  
(1, 3),  
(2, 2),  
(3, 4),  
(4, 5);  



