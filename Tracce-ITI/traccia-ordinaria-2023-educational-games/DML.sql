INSERT INTO DOCENTE (Nome, Cognome, Username, Password) VALUES
('Mario', 'Rossi', 'mrossi', 'password1'),
('Luca', 'Bianchi', 'lbianchi', 'password2'),
('Anna', 'Verdi', 'averdi', 'password3'),
('Giulia', 'Gialli', 'ggialli', 'password4'),
('Paolo', 'Neri', 'pneri', 'password5');

INSERT INTO CLASSE_VIRTUALE (Nome, Materia, Link, IDD) VALUES
('3A', 'Matematica', 'link1.com', 1),
('4B', 'Italiano', 'link2.com', 2),
('2C', 'Fisica', 'link3.com', 3),
('5A', 'Informatica', 'link4.com', 4),
('1B', 'Storia', 'link5.com', 5);

INSERT INTO STUDENTE (Nome, Cognome, Username, Password) VALUES
('Marco', 'Polo', 'mpolo', 'studente1'),
('Elisa', 'Marini', 'emarini', 'studente2'),
('Roberto', 'Carli', 'rcarli', 'studente3'),
('Sara', 'Moretti', 'smoretti', 'studente4'),
('Federico', 'Ricci', 'fricci', 'studente5');

INSERT INTO ISCRIVERE (Nome, Materia, IDS) VALUES
('3A', 'Matematica', 1),
('4B', 'Italiano', 2),
('2C', 'Fisica', 3),
('5A', 'Informatica', 4),
('1B', 'Storia', 5);

INSERT INTO VIDEOGIOCO (Titolo, Descrizione_breve, Descrizione_estesa, Img1, Img2, Img3, Monete) VALUES
('Math Quest', 'Gioco di matematica', 'Impara matematica risolvendo problemi divertenti.', 'img_math1.png', 'img_math2.png', 'img_math3.png', 50),
('Letter Land', 'Gioco di grammatica', 'Esplora la grammatica divertendoti.', 'img_ita1.png', 'img_ita2.png', 'img_ita3.png', 40),
('Physics Lab', 'Simulatore fisica', 'Scopri la fisica attraverso esperimenti virtuali.', 'img_phy1.png', 'img_phy2.png', 'img_phy3.png', 60),
('Code Masters', 'Gioco di programmazione', 'Programma il tuo robot e supera gli ostacoli.', 'img_inf1.png', 'img_inf2.png', 'img_inf3.png', 70),
('History Quest', 'Gioco storico', 'Viaggia nel tempo e impara la storia.', 'img_sto1.png', 'img_sto2.png', 'img_sto3.png', 30);

INSERT INTO APPARIRE (Nome, Materia, IDV) VALUES
('3A', 'Matematica', 1),
('4B', 'Italiano', 2),
('2C', 'Fisica', 3),
('5A', 'Informatica', 4),
('1B', 'Storia', 5);

INSERT INTO GIOCARE (IDV, IDS, DataPartita, Monete_Raccolte) VALUES
(1, 1, '2024-03-10 10:00:00', 20),
(2, 2, '2024-03-11 11:00:00', 15),
(3, 3, '2024-03-12 12:00:00', 25),
(4, 4, '2024-03-13 13:00:00', 30),
(5, 5, '2024-03-14 14:00:00', 10);

INSERT INTO ARGOMENTO (Nome) VALUES
('Algebra'),
('Grammatica'),
('Cinematica'),
('Programmazione'),
('Antica Roma');

INSERT INTO TRATTARE (IDV, IDA) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

