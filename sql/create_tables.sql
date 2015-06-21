CREATE TABLE Kayttaja(
    id SERIAL PRIMARY KEY,
    nimi varchar(255) NOT NULL,
    salasana varchar(255) NOT NULL
);

CREATE TABLE Luokka(
    id SERIAL PRIMARY KEY,
    nimi varchar(255) NOT NULL,
    kayttaja_id INTEGER REFERENCES Kayttaja(id)  ON DELETE cascade ON UPDATE cascade
);

CREATE TABLE Tarkeysaste(
    id SERIAL PRIMARY KEY,
    nimi varchar(255) NOT NULL,
    aste integer,
    kayttaja_id INTEGER REFERENCES Kayttaja(id) ON DELETE cascade ON UPDATE cascade
);

CREATE TABLE Askare(
    id SERIAL PRIMARY KEY,
    nimi varchar(255) NOT NULL,
    lisayspaiva DATE,
    tehty boolean NOT NULL DEFAULT false,
    kuvaus varchar(255),
    kayttaja_id INTEGER REFERENCES Kayttaja(id) ON DELETE cascade ON UPDATE cascade,
    tarkeysaste_id INTEGER REFERENCES Tarkeysaste(id) ON DELETE SET NULL ON UPDATE cascade
);


CREATE TABLE Askareenluokka(
    askare_id INTEGER REFERENCES Askare(id) ON DELETE cascade ON UPDATE cascade,
    luokka_id INTEGER REFERENCES Luokka(id) ON DELETE cascade ON UPDATE cascade,
    PRIMARY KEY (Askare_id,Luokka_id)
);