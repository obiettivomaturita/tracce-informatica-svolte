INSERT INTO CASEIFICIO (Nome) VALUES
('Caseificio A'),
('Caseificio B'),
('Caseificio C'),
('Caseificio D'),
('Caseificio E');

INSERT INTO FORMA (IDC, Nome, Stagionatura, TipoAcquirente, Scelta, MeseProd, AnnoProd) VALUES
(1, 'Forma A1', '6 mesi', 'Privato', 1, 3, 2025),
(2, 'Forma B1', '12 mesi', 'Rivenditore', 1, 4, 2025),
(3, 'Forma C1', '6 mesi', 'Privato', 1, 5, 2025),
(4, 'Forma D1', '12 mesi', 'Privato', 1, 3, 2025),
(5, 'Forma E1', '6 mesi', 'Rivenditore', 1, 4, 2025);

INSERT INTO PRODUZIONE (IDC, LatteLavorato, LatteImpiegato, FormeVendute, Data) VALUES
(1, 100.00, 80.00, 50, '2025-03-15'),
(2, 120.00, 90.00, 30, '2025-04-10'),
(3, 110.00, 85.00, 70, '2025-05-20'),  
(4, 130.00, 95.00, 40, '2025-06-25'),
(5, 115.00, 88.00, 60, '2025-07-30');


INSERT INTO SEDE (Nome, Città, Indirizzo, Latitudine, Longitudine, Nome_titolare, IDC) VALUES
('Sede A', 'Pisa', 'Via A 1', '43.7200', '10.4000', 'Mario', 1),
('Sede B', 'Pisa', 'Via B 2', '43.7300', '10.4100', 'Luigi', 2),
('Sede C', 'Firenze', 'Via C 3', '43.7700', '11.2500', 'Marco', 3),
('Sede D', 'Milano', 'Via D 4', '45.4600', '9.1900', 'Sara', 4),
('Sede E', 'Pisa', 'Via E 5', '43.7400', '10.4200', 'Anna', 5);


INSERT INTO FOTO (Nome, Descrizione, IDS) VALUES
('Foto 1', 'Descrizione 1', 1),
('Foto 2', 'Descrizione 2', 2),
('Foto 3', 'Descrizione 3', 3),
('Foto 4', 'Descrizione 4', 4),
('Foto 5', 'Descrizione 5', 5);
