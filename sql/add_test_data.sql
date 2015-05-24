INSERT INTO Kayttaja (Nimi, Salasana)
VALUES ('Juri','Salasana');

INSERT INTO Askare (Nimi, Kayttaja_id)
SELECT 'Siivoa', id FROM Kayttaja
WHERE Nimi = 'Juri';

INSERT INTO Luokka (Nimi, Kayttaja_id)
SELECT 'Pakollinen Paha', id FROM Kayttaja
WHERE Nimi = 'Juri';

INSERT INTO Tarkeysaste (Nimi, Aste, Kayttaja_id)
SELECT 'Joskus ensivuonna', 10, id FROM Kayttaja
WHERE Nimi = 'Juri';