-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2016 at 12:14 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citaonica`
--
CREATE DATABASE IF NOT EXISTS `citaonica` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `citaonica`;

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

DROP TABLE IF EXISTS `dnevnik`;
CREATE TABLE `dnevnik` (
  `id_dne` int(11) NOT NULL,
  `rb_godina` varchar(8) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme_ul` varchar(5) NOT NULL,
  `vrijeme_izl` varchar(5) NOT NULL,
  `napomena` varchar(128) DEFAULT NULL,
  `addedby` varchar(64) NOT NULL,
  `id_kor` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`id_dne`, `rb_godina`, `datum`, `vrijeme_ul`, `vrijeme_izl`, `napomena`, `addedby`, `id_kor`) VALUES
(1, '001/2016', '2016-01-02', '11:20', '18:30', 'Proba', 'Sebastijan Legović, 16.11.2016.', 3),
(2, '002/2016', '2016-01-03', '11:20', '14:55', '', 'Sebastijan Legović, 16.11.2016.', 2),
(3, '003/2016', '2016-01-04', '12:00', '13:35', '', 'Sebastijan Legović, 16.11.2016.', 3),
(4, '004/2016', '2016-01-04', '12:01', '13:38', 'Proba', 'Sebastijan Legović, 01.12.2016.', 1),
(5, '005/2016', '2016-01-07', '10:20', '14:55', '', 'Sebastijan Legović, 16.11.2016.', 5),
(6, '006/2016', '2016-01-08', '09:30', '11:00', '', 'Sebastijan Legović, 16.11.2016.', 8),
(7, '007/2016', '2016-01-08', '10:10', '14:55', '', 'Sebastijan Legović, 16.11.2016.', 9),
(8, '008/2016', '2016-01-09', '12:35', '14:55', '', 'Sebastijan Legović, 01.12.2016.', 7),
(9, '009/2016', '2016-01-09', '08:30', '14:15', '', 'Sebastijan Legović, 16.11.2016.', 10),
(10, '010/2016', '2016-01-09', '08:30', '14:15', '', 'Sebastijan Legović, 01.12.2016.', 11),
(11, '011/2016', '2016-01-10', '09:00', '18:00', '', 'Sebastijan Legović, 01.12.2016.', 6);

-- --------------------------------------------------------

--
-- Table structure for table `drzave`
--

DROP TABLE IF EXISTS `drzave`;
CREATE TABLE `drzave` (
  `id_drz` int(5) NOT NULL,
  `naziv` varchar(128) NOT NULL,
  `skr_oznaka` varchar(3) NOT NULL,
  `addedby` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drzave`
--

INSERT INTO `drzave` (`id_drz`, `naziv`, `skr_oznaka`, `addedby`) VALUES
(1, 'Hrvatska', 'HR', 'Sebastijan Legović, 16.11.2016.'),
(2, 'Italija', 'ITA', 'Sebastijan Legović, 16.11.2016.'),
(3, 'Njemačka', 'DEU', 'Sebastijan Legović, 16.11.2016.');

-- --------------------------------------------------------

--
-- Table structure for table `evidenticar`
--

DROP TABLE IF EXISTS `evidenticar`;
CREATE TABLE `evidenticar` (
  `id` int(2) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `privilege` varchar(5) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `odjel` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='pass je spremljen kao md5';

--
-- Dumping data for table `evidenticar`
--

INSERT INTO `evidenticar` (`id`, `username`, `password`, `privilege`, `ime`, `prezime`, `odjel`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Sebastijan', 'Legović', 'INDOK'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'Jakov', 'Kmet', 'Digitalizacija');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE `korisnik` (
  `id_kor` int(5) NOT NULL,
  `broj_kor` int(11) NOT NULL,
  `god_prijave` int(4) NOT NULL,
  `prezime` varchar(32) NOT NULL,
  `ime` varchar(32) NOT NULL,
  `oib` varchar(11) DEFAULT NULL,
  `oib_ust` varchar(11) DEFAULT NULL,
  `jmbg` varchar(13) DEFAULT NULL,
  `vrsta_osd` varchar(24) DEFAULT NULL,
  `broj_osd` varchar(24) DEFAULT NULL,
  `datum_rod` date NOT NULL,
  `adresa_stalna` varchar(48) NOT NULL,
  `adresa_priv` varchar(48) DEFAULT NULL,
  `telefon` varchar(24) DEFAULT NULL,
  `gsm` varchar(24) DEFAULT NULL,
  `fax` varchar(24) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `zvanje` varchar(128) DEFAULT NULL,
  `zanimanje` varchar(128) DEFAULT NULL,
  `ustanova` varchar(128) DEFAULT NULL,
  `addedby` varchar(64) NOT NULL,
  `id_grad` int(11) NOT NULL,
  `mjesto_izdavanja` int(11) DEFAULT NULL,
  `mjesto_rodenja` int(11) NOT NULL,
  `mjesto_priv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_kor`, `broj_kor`, `god_prijave`, `prezime`, `ime`, `oib`, `oib_ust`, `jmbg`, `vrsta_osd`, `broj_osd`, `datum_rod`, `adresa_stalna`, `adresa_priv`, `telefon`, `gsm`, `fax`, `email`, `zvanje`, `zanimanje`, `ustanova`, `addedby`, `id_grad`, `mjesto_izdavanja`, `mjesto_rodenja`, `mjesto_priv`) VALUES
(1, 1, 2013, 'Maras', 'Mara', '', '', '', 'Vozačka dozvola', '8174605', '1968-11-26', 'Nova cesta 22', '', '3478389847', '', '', 'VXC142@psu.edu', 'Doktorant', '/', 'Fossalta di Portoguaro (ITA)', 'Sebastijan Legović, 03.12.2016.', 41, NULL, 36, NULL),
(2, 2, 2016, 'Jelinčić', 'Jela', '', '', '', 'Osobna iskaznica', '12345678', '1938-11-04', 'Pazinska 22', '', '052/622-000', '098/9671-111', '052/622-101', 'jela.jelinčić@optinet.hr', 'Arhivski savjetnik', 'Umirovljenik', '/', 'Sebastijan Legović, 20.11.2016.', 1, 1, 1, NULL),
(3, 3, 2016, 'Sandalj', 'Sandi', '', '', '', '', '1429374222', '1970-01-01', 'Mure 12', 'Kukci bb', '052/456-111', '098/5775-111', '', '', '/', 'Profesor likovne kulture', 'OŠ Vladimira Nazora Pazi2', 'Sebastijan Legović, 09.11.2016.', 1, 1, 1, 1),
(4, 4, 2014, 'Duraković', 'Marko', '123', '123333', '1111111111111', 'Osobna iskaznica', '', '1988-09-19', 'Rižanske skupštine bb', 'Proba', '01/222-3333', '091/110-111', '01/222-3333', 'dury@yahoo.com', 'Proba', 'Muzikolog', 'Proba', 'Sebastijan Legović, 03.12.2016.', 1, 41, 8, 60),
(5, 5, 2016, 'Bilić', 'Klaudio', '', '', '', 'Osobna iskaznica', '101335457', '1972-02-04', 'Vodnjanska 1', '', '', '098/276-814', '', '', 'Arhitektonski tehničar', 'Umirovljenik', '/', 'Sebastijan Legović, 20.11.2016.', 2, NULL, 2, NULL),
(6, 6, 2016, 'Visintin', 'Livija', '', '', '', 'Osobna iskaznica', '103563407', '1977-05-18', 'Garibaldijeva 8', 'B. Milanovića 1', '052/454-778', '099/2685-049', '052/625-111', '', '/', 'Profesor povijesti', 'Muzej grada Pazina', 'Sebastijan Legović, 20.11.2016.', 1, NULL, 1, 1),
(7, 7, 2016, 'Biciacci', 'Mauro', '', '', '', 'Vozačka dozvola', 'SP21073333', '1952-10-05', 'Via Fontevivo 7', '', '', '', '', 'maurobiciacci@virgillo.it', '/', 'Zdravstveni operator', '/', 'Sebastijan Legović, 03.12.2016.', 69, NULL, 2, NULL),
(8, 8, 2016, 'Biaso', 'Luca', '', '', '', 'Osobna iskaznica', '003bb86AA', '1973-06-11', 'Via Napoli 1', '', '', '', '', 'biaso@tim.it', '/', 'Bankovni službenik', 'Banca Montepaschi Siena', 'Sebastijan Legović, 03.12.2016.', 69, NULL, 1, NULL),
(9, 9, 2015, 'Marić', 'Josef', '', '', '', 'Osobna iskaznica', 'A0657888', '1952-12-28', 'Klosterr 4', '', '', '', '', 'josef.maric@aaa.at', '/', 'Činovnik', '/', 'Sebastijan Legović, 03.12.2016.', 2, NULL, 2, NULL),
(10, 10, 2015, 'Kliman', 'Petar', '', '', '', '', '10166665m', '1946-04-04', 'B. Ilićeva 2', '', '052/841-000', '098/890-600', '', 'kliman@optinet.com', 'Mag. pov., VSS', 'Povjesničar', 'Centro di ricerche storiche', 'Sebastijan Legović, 03.12.2016.', 1, 2, 3, NULL),
(11, 11, 2016, 'Petrić', 'Petar', '', '', '', 'Osobna iskaznica', '10067889', '1968-04-23', 'Muntriljska 1', '', '', '098/150-000', '', '', '/', 'Profesor', '/', 'Sebastijan Legović, 09.11.2016.', 2, 41, 8, 60);

-- --------------------------------------------------------

--
-- Table structure for table `mjesto`
--

DROP TABLE IF EXISTS `mjesto`;
CREATE TABLE `mjesto` (
  `id_grad` int(11) NOT NULL,
  `ptt` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `posta` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `addedby` varchar(64) NOT NULL,
  `id_drz` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mjesto`
--

INSERT INTO `mjesto` (`id_grad`, `ptt`, `grad`, `posta`, `addedby`, `id_drz`) VALUES
(1, '10000', 'Zagreb', 'Zagreb', 'Sebastijan Legović, 20.11.2016.', 1),
(2, '10010', 'Zagreb (Sloboština)', 'Zagreb (Sloboština)', 'Sebastijan Legović, 20.11.2016.', 1),
(3, '10020', 'Zagreb (Novi Zagreb)', 'Zagreb (Novi Zagreb)', 'Sebastijan Legović, 20.11.2016.', 1),
(4, '10040', 'Zagreb (Dubrava)', 'Zagreb (Dubrava)', 'Sebastijan Legović, 20.11.2016.', 1),
(5, '10090', 'Zagreb (Susedgrad)', 'Zagreb (Susedgrad)', 'Sebastijan Legović, 20.11.2016.', 1),
(6, '10250', 'Lučko', 'Lučko', 'Sebastijan Legović, 20.11.2016.', 1),
(7, '10251', 'Hrvatski Leskovac', 'Hrvatski Leskovac', 'Sebastijan Legović, 20.11.2016.', 1),
(8, '10253', 'Donji Dragonožec', 'Donji Dragonožec', 'Sebastijan Legović, 20.11.2016.', 1),
(9, '10255', 'Gornji Stupnik', 'Gornji Stupnik', 'Sebastijan Legović, 20.11.2016.', 1),
(10, '10257', 'Brezovica', 'Brezovica', 'Sebastijan Legović, 20.11.2016.', 1),
(11, '10290', 'Zaprešić', 'Zaprešić', 'Sebastijan Legović, 20.11.2016.', 1),
(12, '10291', 'Prigorje Brdovečko', 'Prigorje Brdovečko', 'Sebastijan Legović, 20.11.2016.', 1),
(13, '10292', 'Šenkovec', 'Šenkovec', 'Sebastijan Legović, 20.11.2016.', 1),
(14, '10293', 'Dubravica', 'Dubravica', 'Sebastijan Legović, 20.11.2016.', 1),
(15, '10294', 'Donja Pušća', 'Donja Pušća', 'Sebastijan Legović, 20.11.2016.', 1),
(16, '10295', 'Kupljenovo', 'Kupljenovo', 'Sebastijan Legović, 20.11.2016.', 1),
(17, '10296', 'Luka', 'Luka', 'Sebastijan Legović, 20.11.2016.', 1),
(18, '10297', 'Jakovlje', 'Jakovlje', 'Sebastijan Legović, 20.11.2016.', 1),
(19, '10298', 'Donja Bistra', 'Donja Bistra', 'Sebastijan Legović, 20.11.2016.', 1),
(20, '10299', 'Marija Gorica', 'Marija Gorica', 'Sebastijan Legović, 20.11.2016.', 1),
(21, '10310', 'Ivanić-Grad', 'Ivanić-Grad', 'Sebastijan Legović, 20.11.2016.', 1),
(22, '10312', 'Kloštar Ivanić', 'Kloštar Ivanić', 'Sebastijan Legović, 20.11.2016.', 1),
(23, '10314', 'Križ', 'Križ', 'Sebastijan Legović, 20.11.2016.', 1),
(24, '10315', 'Novoselec', 'Novoselec', 'Sebastijan Legović, 20.11.2016.', 1),
(25, '10340', 'Vrbovec', 'Vrbovec', 'Sebastijan Legović, 20.11.2016.', 1),
(26, '10341', 'Lonjica', 'Lonjica', 'Sebastijan Legović, 20.11.2016.', 1),
(27, '10342', 'Dubrava', 'Dubrava', 'Sebastijan Legović, 20.11.2016.', 1),
(28, '10343', 'Nova Kapela', 'Nova Kapela', 'Sebastijan Legović, 20.11.2016.', 1),
(29, '10344', 'Farkaševac', 'Farkaševac', 'Sebastijan Legović, 20.11.2016.', 1),
(30, '10345', 'Gradec', 'Gradec', 'Sebastijan Legović, 20.11.2016.', 1),
(31, '10346', 'Preseka', 'Preseka', 'Sebastijan Legović, 20.11.2016.', 1),
(32, '10347', 'Rakovec', 'Rakovec', 'Sebastijan Legović, 20.11.2016.', 1),
(33, '10360', 'Sesvete', 'Sesvete', 'Sebastijan Legović, 20.11.2016.', 1),
(34, '10361', 'Sesvete (Kraljevec)', 'Sesvete (Kraljevec)', 'Sebastijan Legović, 20.11.2016.', 1),
(35, '10362', 'Kašina', 'Kašina', 'Sebastijan Legović, 20.11.2016.', 1),
(36, '10363', 'Belovar', 'Belovar', 'Sebastijan Legović, 20.11.2016.', 1),
(37, '10370', 'Dugo Selo', 'Dugo Selo', 'Sebastijan Legović, 20.11.2016.', 1),
(38, '10372', 'Oborovo', 'Oborovo', 'Sebastijan Legović, 20.11.2016.', 1),
(39, '10373', 'Ivanja Reka', 'Ivanja Reka', 'Sebastijan Legović, 20.11.2016.', 1),
(40, '10380', 'Sveti Ivan Zelina', 'Sveti Ivan Zelina', 'Sebastijan Legović, 20.11.2016.', 1),
(41, '10389', 'Bedenica', 'Bedenica', 'Sebastijan Legović, 16.11.2016.', 1),
(42, '10382', 'Donja Zelina', 'Donja Zelina', 'Sebastijan Legović, 20.11.2016.', 1),
(43, '10383', 'Komin', 'Komin', 'Sebastijan Legović, 20.11.2016.', 1),
(44, '10408', 'Velika Mlaka', 'Velika Mlaka', 'Sebastijan Legović, 20.11.2016.', 1),
(45, '10410', 'Velika Gorica', 'Velika Gorica', 'Sebastijan Legović, 20.11.2016.', 1),
(46, '10411', 'Orle', 'Orle', 'Sebastijan Legović, 20.11.2016.', 1),
(47, '10412', 'Donja Lomnica', 'Donja Lomnica', 'Sebastijan Legović, 20.11.2016.', 1),
(48, '10413', 'Kravarsko', 'Kravarsko', 'Sebastijan Legović, 20.11.2016.', 1),
(49, '10414', 'Pokupsko', 'Pokupsko', 'Sebastijan Legović, 20.11.2016.', 1),
(50, '10415', 'Novo Čiče', 'Novo Čiče', 'Sebastijan Legović, 20.11.2016.', 1),
(51, '10417', 'Buševec', 'Buševec', 'Sebastijan Legović, 20.11.2016.', 1),
(52, '10418', 'Dubranec	', 'Dubranec	', 'Sebastijan Legović, 20.11.2016.', 1),
(53, '10419', 'Vukovina', 'Vukovina', 'Sebastijan Legović, 20.11.2016.', 1),
(54, '10430', 'Samobor', 'Samobor', 'Sebastijan Legović, 20.11.2016.', 1),
(55, '10431', 'Sveta Nedjelja', 'Sveta Nedjelja', 'Sebastijan Legović, 20.11.2016.', 1),
(56, '10432', 'Bregana', 'Bregana', 'Sebastijan Legović, 20.11.2016.', 1),
(57, '10434', 'Strmec Samoborski', 'Strmec Samoborski', 'Sebastijan Legović, 20.11.2016.', 1),
(58, '10435', 'Sveti Martin pod Okić', 'Sveti Martin pod Okić', 'Sebastijan Legović, 20.11.2016.', 1),
(59, '10436', 'Rakov Potok', 'Rakov Potok', 'Sebastijan Legović, 20.11.2016.', 1),
(60, '10437', 'Bestovje', 'Bestovje', 'Sebastijan Legović, 20.11.2016.', 1),
(61, '10450', 'Jastrebarsko', 'Jastrebarsko', 'Sebastijan Legović, 20.11.2016.', 1),
(62, '10451', 'Pisarovina', 'Pisarovina', 'Sebastijan Legović, 20.11.2016.', 1),
(63, '10453', 'Gorica Svetojanska', 'Gorica Svetojanska', 'Sebastijan Legović, 20.11.2016.', 1),
(64, '10454', 'Krašić', 'Krašić', 'Sebastijan Legović, 20.11.2016.', 1),
(65, '10455', 'Kostanjevac', 'Kostanjevac', 'Sebastijan Legović, 20.11.2016.', 1),
(66, '52000', 'Pazin', 'Pazin', 'Sebastijan Legović, 20.11.2016.', 1),
(67, '52100', 'Pula', 'Pula', 'Sebastijan Legović, 20.11.2016.', 1),
(68, '1112', 'Proba', 'Proba', 'Sebastijan Legović, 16.11.2016.', 2),
(69, 'A1222', 'Trst', 'Trst', 'Sebastijan Legović, 03.12.2016.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `prijavnica`
--

DROP TABLE IF EXISTS `prijavnica`;
CREATE TABLE `prijavnica` (
  `id_prijave` int(9) NOT NULL,
  `rb_prijave` varchar(8) NOT NULL,
  `datum_prijave` date NOT NULL,
  `tema_pod` longtext NOT NULL,
  `odobrenje` varchar(64) NOT NULL,
  `datum_odb` date NOT NULL,
  `id_kor` int(5) NOT NULL,
  `sif_svrhe` int(2) NOT NULL,
  `napomena` longtext,
  `addedby` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prijavnica`
--

INSERT INTO `prijavnica` (`id_prijave`, `rb_prijave`, `datum_prijave`, `tema_pod`, `odobrenje`, `datum_odb`, `id_kor`, `sif_svrhe`, `napomena`, `addedby`) VALUES
(1, '001/2016', '2016-01-02', 'Razne teme', 'Sebastijan Legović', '2016-11-18', 3, 11, 'Napomena', 'Sebastijan Legović, 18.11.2016.'),
(2, '002/2016', '2016-01-03', 'Fašizam u Istri (1935-1936)', 'Sebastijan Legović', '2016-11-18', 2, 5, '', 'Sebastijan Legović, 01.12.2016.'),
(3, '003/2016', '2016-01-04', 'Manjadvorci, Barbaština, zanimanja', 'Sebastijan Legović', '2016-01-08', 1, 10, '', 'Sebastijan Legović, 01.12.2016.'),
(4, '004/2016', '2016-01-07', 'Obiteljsko stablo', 'Sebastijan Legović', '2016-01-08', 5, 2, '', 'Sebastijan Legović, 01.12.2016.'),
(5, '005/2016', '2016-01-08', 'Obiteljsko stablo', 'Sebastijan Legović', '2016-01-09', 8, 2, '', 'Sebastijan Legović, 01.12.2016.'),
(6, '006/2016', '2016-01-08', 'Artigianato a Dignano - calzolai', 'Sebastijan Legović', '2016-01-09', 9, 10, 'Službeno, Centro di ricerche storiche di Rovigno', 'Sebastijan Legović, 01.12.2016.'),
(7, '007/2016', '2016-01-09', 'Arhitektura - Labin i Raša za projekt "Atriuti"', 'Sebastijan Legović', '2016-01-09', 7, 10, 'Digitalizacija arh. građe naselja Raše i Podlabina', 'Sebastijan Legović, 30.11.2016.'),
(8, '008/2016', '2016-01-09', 'Prosvjeta u Istri', 'Sebastijan Legović', '2016-01-09', 10, 11, '', 'Sebastijan Legović, 01.12.2016.'),
(9, '009/2016', '2016-01-09', 'Povijest Buzet, Sovinjaka, povijest obitelji', 'Sebastijan Legović', '2016-01-09', 11, 11, '', 'Sebastijan Legović, 01.12.2016.');

-- --------------------------------------------------------

--
-- Table structure for table `prijavnica_fond`
--

DROP TABLE IF EXISTS `prijavnica_fond`;
CREATE TABLE `prijavnica_fond` (
  `id_prifon` int(11) NOT NULL,
  `signatura` varchar(12) NOT NULL,
  `naziv_fonda` varchar(64) NOT NULL,
  `addedby` varchar(64) NOT NULL,
  `id_prijave` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prijavnica_fond`
--

INSERT INTO `prijavnica_fond` (`id_prifon`, `signatura`, `naziv_fonda`, `addedby`, `id_prijave`) VALUES
(2, 'HR-DAPA-852', 'Bilježnici Rovinja', 'Sebastijan Legović, 30.11.2016.', 1),
(6, 'HR-DAPA-1', 'Općina Novigrad', 'Sebastijan Legović, 30.11.2016.', 2),
(7, 'HR-DAPA-3', 'Općina Poreč', 'Sebastijan Legović, 30.11.2016.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `svrha_ist`
--

DROP TABLE IF EXISTS `svrha_ist`;
CREATE TABLE `svrha_ist` (
  `sif_svrhe` int(2) NOT NULL,
  `naziv` varchar(24) NOT NULL,
  `addedby` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `svrha_ist`
--

INSERT INTO `svrha_ist` (`sif_svrhe`, `naziv`, `addedby`) VALUES
(1, 'Genealogija', 'Sebastijan Legović, 20.11.2016.'),
(2, 'Privatna', 'Sebastijan Legović, 20.11.2016.'),
(3, 'Knjiga', 'Sebastijan Legović, 20.11.2016.'),
(4, 'Seminarski', 'Sebastijan Legović, 20.11.2016.'),
(5, 'Diplomski', 'Sebastijan Legović, 20.11.2016.'),
(6, 'Magistarski', 'Sebastijan Legović, 20.11.2016.'),
(7, 'Doktorat', 'Sebastijan Legović, 20.11.2016.'),
(8, 'Članak', 'Sebastijan Legović, 20.11.2016.'),
(9, 'Izložba', 'Sebastijan Legović, 20.11.2016.'),
(10, 'Ostalo', 'Sebastijan Legović, 20.11.2016.'),
(11, 'Znanstveni rad', 'Sebastijan Legović, 20.11.2016.'),
(12, 'Završni rad', 'Sebastijan Legović, 20.11.2016.'),
(13, 'Stručni rad', 'Sebastijan Legović, 20.11.2016.');

-- --------------------------------------------------------

--
-- Table structure for table `zahtjevnica`
--

DROP TABLE IF EXISTS `zahtjevnica`;
CREATE TABLE `zahtjevnica` (
  `id_zahtjeva` int(9) NOT NULL,
  `rb_zahtjeva` varchar(8) NOT NULL,
  `datum_zahtjeva` date DEFAULT NULL,
  `preslici` int(4) DEFAULT NULL,
  `addedby` varchar(64) NOT NULL,
  `id_kor` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zahtjevnica`
--

INSERT INTO `zahtjevnica` (`id_zahtjeva`, `rb_zahtjeva`, `datum_zahtjeva`, `preslici`, `addedby`, `id_kor`) VALUES
(1, '001/2016', '2016-01-02', 0, 'Sebastijan Legović, 01.12.2016.', 3),
(2, '002/2016', '2016-01-03', 0, 'Sebastijan Legović, 01.12.2016.', 2),
(3, '003/2016', '2016-01-04', 4, 'Sebastijan Legović, 01.12.2016.', 3),
(4, '004/2016', '2016-01-04', 12, 'Sebastijan Legović, 01.12.2016.', 1),
(5, '005/2016', '2016-01-07', 0, 'Sebastijan Legović, 01.12.2016.', 5),
(6, '006/2016', '2016-01-08', 0, 'Sebastijan Legović, 01.12.2016.', 8),
(7, '007/2016', '2016-01-08', 3, 'Sebastijan Legović, 01.12.2016.', 9),
(8, '008/2016', '2016-01-09', 0, 'Sebastijan Legović, 01.12.2016.', 7),
(9, '009/2016', '2016-01-09', 0, 'Sebastijan Legović, 01.12.2016.', 10),
(10, '010/2016', '2016-01-09', 0, 'Sebastijan Legović, 01.12.2016.', 11),
(11, '011/2016', '2016-01-10', 0, 'Sebastijan Legović, 01.12.2016.', 6);

-- --------------------------------------------------------

--
-- Table structure for table `zahtjevnica_arhjed`
--

DROP TABLE IF EXISTS `zahtjevnica_arhjed`;
CREATE TABLE `zahtjevnica_arhjed` (
  `id_zaharh` int(9) NOT NULL,
  `signatura` varchar(12) NOT NULL,
  `oznaka` varchar(32) DEFAULT NULL,
  `naziv` longtext,
  `tehjed` varchar(32) NOT NULL,
  `oblik_kor` varchar(32) NOT NULL,
  `addedby` varchar(64) NOT NULL,
  `id_zahtjeva` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zahtjevnica_arhjed`
--

INSERT INTO `zahtjevnica_arhjed` (`id_zaharh`, `signatura`, `oznaka`, `naziv`, `tehjed`, `oblik_kor`, `addedby`, `id_zahtjeva`) VALUES
(2, 'HR-DAPA-4', '138', 'Novigrad, spisi, 1730-1732', '1', '2 - korištenje izvornika', 'Sebastijan Legović, 10.12.2016.', 1),
(3, 'HR-DAPA-424', '6', 'Novigradski statut 14-16 st.', '6', '2 - korištenje izvornika', 'Sebastijan Legović, 30.11.2016.', 3),
(4, 'HR-DAPA-424', '6', 'Novigradski statut 14-16 st.', '2', '2 - korištenje izvornika', 'Sebastijan Legović, 10.12.2016.', 2),
(5, 'HR-DAPA-4', '138', 'Novigrad, spisi, 1730-1732', '2', '2 - korištenje izvornika', 'Sebastijan Legović, 10.12.2016.', 3),
(6, 'HR-DAPA-429', '34', 'MKU Barban 1717-1751', '2', '2 - korištenje izvornika', 'Sebastijan Legović, 10.12.2016.', 3),
(8, 'HR-DAPA-4', '138', 'Novigrad, spisi, 1730-1732', '5', '2 - korištenje izvornika', 'Sebastijan Legović, 10.12.2016.', 4),
(9, 'HR-DAPA-429', '34', 'MKU Barban 1717-1751', '5', '3 - korištenje preslika', 'Sebastijan Legović, 10.12.2016.', 4),
(10, 'HR-DAPA-55', 'XVII', 'Ministarstvo rata 1936.', '6', '1 - korištenje ObP', 'Sebastijan Legović, 10.12.2016.', 4),
(11, 'HR-DAPA-4', '138.', 'Novigrad, spisi, 1730-1732', '6', '1 - korištenje ObP', 'Sebastijan Legović, 02.12.2016.', 5),
(12, 'HR-DAPA-9', '2', 'Novigrad, spisi, 1730-1732', '4', '1 - korištenje ObP', 'Sebastijan Legović, 02.12.2016.', 6),
(13, 'HR-DAPA-99', '5', 'Novigrad, spisi, 1730-1732', '6', '1 - korištenje ObP', 'Sebastijan Legović, 02.12.2016.', 7),
(14, 'HR-DAPA-54', '2', 'Novigrad, spisi, 1730-1732', '36', '1 - korištenje ObP', 'Sebastijan Legović, 02.12.2016.', 8),
(15, 'HR-DAPA-862', '4', 'Novigrad, spisi, 1730-1732', '4', '1 - korištenje ObP', 'Sebastijan Legović, 02.12.2016.', 9),
(16, 'HR-DAPA-333', '5', 'Novigrad, spisi, 1730-1732', '36', '1 - korištenje ObP', 'Sebastijan Legović, 02.12.2016.', 10),
(17, 'HR-DAPA-8', '3', 'Novigrad, spisi, 1730-1732', '6', '1 - korištenje ObP', 'Sebastijan Legović, 02.12.2016.', 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`id_dne`),
  ADD UNIQUE KEY `rb_godina` (`rb_godina`),
  ADD KEY `korisnik_fk` (`id_kor`) USING BTREE;

--
-- Indexes for table `drzave`
--
ALTER TABLE `drzave`
  ADD PRIMARY KEY (`id_drz`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `evidenticar`
--
ALTER TABLE `evidenticar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_kor`),
  ADD UNIQUE KEY `broj_kor` (`broj_kor`),
  ADD KEY `korisnik_mjesto_stalno_fk` (`id_grad`),
  ADD KEY `korisnik_mjesto_rodenja_fk` (`mjesto_rodenja`),
  ADD KEY `korisnik_mjesto_privatno_fk` (`mjesto_priv`),
  ADD KEY `korisnik_mjesto_izdavanja_fk` (`mjesto_izdavanja`);

--
-- Indexes for table `mjesto`
--
ALTER TABLE `mjesto`
  ADD PRIMARY KEY (`id_grad`),
  ADD UNIQUE KEY `ptt` (`ptt`),
  ADD KEY `mjesto_drzava_fk` (`id_drz`) USING BTREE;

--
-- Indexes for table `prijavnica`
--
ALTER TABLE `prijavnica`
  ADD PRIMARY KEY (`id_prijave`),
  ADD UNIQUE KEY `rb_prijave` (`rb_prijave`),
  ADD KEY `prijavnica_svrha_ist_fk` (`sif_svrhe`),
  ADD KEY `prijavnica_korisnik_fk` (`id_kor`);

--
-- Indexes for table `prijavnica_fond`
--
ALTER TABLE `prijavnica_fond`
  ADD PRIMARY KEY (`id_prifon`),
  ADD KEY `id_prijave` (`id_prijave`);

--
-- Indexes for table `svrha_ist`
--
ALTER TABLE `svrha_ist`
  ADD PRIMARY KEY (`sif_svrhe`),
  ADD UNIQUE KEY `naziv` (`naziv`) USING BTREE;

--
-- Indexes for table `zahtjevnica`
--
ALTER TABLE `zahtjevnica`
  ADD PRIMARY KEY (`id_zahtjeva`),
  ADD KEY `id_kor` (`id_kor`);

--
-- Indexes for table `zahtjevnica_arhjed`
--
ALTER TABLE `zahtjevnica_arhjed`
  ADD PRIMARY KEY (`id_zaharh`),
  ADD UNIQUE KEY `id_zaharh` (`id_zaharh`),
  ADD KEY `ID_ZAHTJEVA` (`id_zahtjeva`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `id_dne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `drzave`
--
ALTER TABLE `drzave`
  MODIFY `id_drz` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `evidenticar`
--
ALTER TABLE `evidenticar`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_kor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mjesto`
--
ALTER TABLE `mjesto`
  MODIFY `id_grad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `prijavnica`
--
ALTER TABLE `prijavnica`
  MODIFY `id_prijave` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `prijavnica_fond`
--
ALTER TABLE `prijavnica_fond`
  MODIFY `id_prifon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `svrha_ist`
--
ALTER TABLE `svrha_ist`
  MODIFY `sif_svrhe` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `zahtjevnica`
--
ALTER TABLE `zahtjevnica`
  MODIFY `id_zahtjeva` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `zahtjevnica_arhjed`
--
ALTER TABLE `zahtjevnica_arhjed`
  MODIFY `id_zaharh` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `dnevnik_korisnik_fk` FOREIGN KEY (`id_kor`) REFERENCES `korisnik` (`id_kor`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_mjesto_izdavanja_fk` FOREIGN KEY (`mjesto_izdavanja`) REFERENCES `mjesto` (`id_grad`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnik_mjesto_privatno_fk` FOREIGN KEY (`mjesto_priv`) REFERENCES `mjesto` (`id_grad`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnik_mjesto_rodenja_fk` FOREIGN KEY (`mjesto_rodenja`) REFERENCES `mjesto` (`id_grad`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `korisnik_mjesto_stalno_fk` FOREIGN KEY (`id_grad`) REFERENCES `mjesto` (`id_grad`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `mjesto`
--
ALTER TABLE `mjesto`
  ADD CONSTRAINT `mjesto_drzava_fk` FOREIGN KEY (`id_drz`) REFERENCES `drzave` (`id_drz`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `prijavnica`
--
ALTER TABLE `prijavnica`
  ADD CONSTRAINT `prijavnica_korisnik_fk` FOREIGN KEY (`id_kor`) REFERENCES `korisnik` (`id_kor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `prijavnica_svrha_fk` FOREIGN KEY (`sif_svrhe`) REFERENCES `svrha_ist` (`sif_svrhe`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `prijavnica_fond`
--
ALTER TABLE `prijavnica_fond`
  ADD CONSTRAINT `prijavnica_fond_fk` FOREIGN KEY (`id_prijave`) REFERENCES `prijavnica` (`id_prijave`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `zahtjevnica`
--
ALTER TABLE `zahtjevnica`
  ADD CONSTRAINT `zahtjevnica_korisnik_fk` FOREIGN KEY (`id_kor`) REFERENCES `korisnik` (`id_kor`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `zahtjevnica_arhjed`
--
ALTER TABLE `zahtjevnica_arhjed`
  ADD CONSTRAINT `zahtjevnica_arhjed_fk` FOREIGN KEY (`id_zahtjeva`) REFERENCES `zahtjevnica` (`id_zahtjeva`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
