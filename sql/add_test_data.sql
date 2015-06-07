INSERT INTO Kayttaja (nimi, salasana)
VALUES ('Juri','Salasana');

INSERT INTO Askare (nimi, kayttaja_id)
SELECT 'Siivoa', id FROM Kayttaja
WHERE nimi = 'Juri';

INSERT INTO Askare (nimi, kayttaja_id)
SELECT 'häslää', id FROM Kayttaja
WHERE nimi = 'Juri';

INSERT INTO Luokka (nimi, kayttaja_id)
SELECT 'Pakollinen Paha', id FROM Kayttaja
WHERE nimi = 'Juri';

INSERT INTO Tarkeysaste (Nimi, Aste, Kayttaja_id)
SELECT 'Joskus ensivuonna', 10, id FROM Kayttaja
WHERE nimi = 'Juri';