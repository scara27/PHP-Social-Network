CREATE DATABASE baza;
USE baza;

CREATE TABLE Korisnik (
	ID int NOT NULL AUTO_INCREMENT,
	KorisnickoIme varchar(30),
	Sifra varchar(80),
	Ime varchar(30),
    Prezime varchar(30),
    Pol varchar(1),
    Adresa varchar(100),
    DatumRodjenja varchar(30),
    ProfilnaSlika varchar(200),
	PRIMARY KEY(ID)
) CHARACTER SET utf8 COLLATE utf8_bin;