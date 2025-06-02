INSERT INTO MIELE (Tipologia, Denominazione) VALUES
('Identità nazionale', 'Miele Millefiori'),
('Identità regionale', 'Miele Erica'),
('Identità territoriale', 'Miele di Castagno'),
('D.O.P.', 'Miele delle Dolomiti'),
('Identità nazionale', 'Miele di Ulivo');

INSERT INTO APIARIO (N_Arnie, Localita, Comune, Provincia, Regione, IDM) VALUES
(10, 'Localita1', 'Comune1', 'Provincia1', 'Regione1', 1),
(8, 'Localita2', 'Comune2', 'Provincia2', 'Regione2', 2),
(12, 'Localita3', 'Comune3', 'Provincia3', 'Regione3', 3),
(7, 'Localita4', 'Comune4', 'Provincia4', 'Regione4', 4),
(15, 'Localita5', 'Comune5', 'Provincia5', 'Regione1', 5);

INSERT INTO APICOLTORE (CF, Nome, Cognome, Email, Username, Password_, Sito_web) VALUES
('APIC000000000001', 'Mario', 'Rossi', 'mario@example.com', 'mariorossi', 'password1', 'www.mariorossi.it'),
('APIC000000000002', 'Luigi', 'Verdi', 'luigi@example.com', 'luigiverdi', 'password2', 'www.luigiverdi.it'),
('APIC000000000003', 'Anna', 'Bianchi', 'anna@example.com', 'annabianchi', 'password3', 'www.annabianchi.it'),
('APIC000000000004', 'Sara', 'Neri', 'sara@example.com', 'saraneri', 'password4', 'www.saraneri.it'),
('APIC000000000005', 'Paolo', 'Gialli', 'paolo@example.com', 'paologialli', 'password5', 'www.paologialli.it');

INSERT INTO RACCOGLIERE (IDM, CF, Data) VALUES
(1, 'APIC000000000001', '2023-03-10'),
(2, 'APIC000000000002', '2023-03-12'),
(3, 'APIC000000000003', '2023-03-14'),
(4, 'APIC000000000004', '2023-03-16'),
(5, 'APIC000000000005', '2023-03-18');

INSERT INTO LAVORARE (CF, IDA, Data_inizio, Data_fine) VALUES
('APIC000000000001', 1, '2022-01-01', '2022-12-31'),
('APIC000000000002', 2, '2022-02-01', '2022-12-31'),
('APIC000000000003', 3, '2022-03-01', '2022-12-31'),
('APIC000000000004', 4, '2022-04-01', '2022-12-31'),
('APIC000000000005', 5, '2022-05-01', '2022-12-31');

INSERT INTO PRODUZIONE (Anno, Quantità, IDA) VALUES
(2022, 150.50, 1),
(2022, 200.00, 2),
(2022, 175.75, 3),
(2022, 220.00, 4),
(2022, 180.25, 5);