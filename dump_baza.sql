-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 06, 2023 at 04:02 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KorisnickoIme` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Sifra` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `Ime` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Prezime` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Pol` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `Adresa` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `DatumRodjenja` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `ProfilnaSlika` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID`, `KorisnickoIme`, `Sifra`, `Ime`, `Prezime`, `Pol`, `Adresa`, `DatumRodjenja`, `ProfilnaSlika`) VALUES
(14, 'roki23', 'dsT/.HbJnhM1c', 'Roki', 'Balboa', 'm', 'Kosovska 13', '2022-07-04', 'photos/rocky.jpg'),
(15, 'mica18', 'dsSurNZUkvm.2', 'Milica', 'JociÄ‡', 'z', 'Dositeja Obradovica 19', '2023-01-02', 'photos/cat_2.jpg'),
(16, 'peki22', 'dsJbgF30Kxtk6', 'Pera', 'PeriÄ‡', 'm', 'Kosovska 9', '2023-01-05', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
