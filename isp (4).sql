-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 m. Grd 22 d. 14:59
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isp`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `abonementai`
--

CREATE TABLE `abonementai` (
  `id` int(11) NOT NULL,
  `data_nuo` date NOT NULL,
  `data_iki` date NOT NULL,
  `kaina` double NOT NULL,
  `tipas` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rusis` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fk_pardavimas` int(11) DEFAULT NULL,
  `fk_nuolaida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `abonementai`
--

INSERT INTO `abonementai` (`id`, `data_nuo`, `data_iki`, `kaina`, `tipas`, `rusis`, `fk_pardavimas`, `fk_nuolaida`) VALUES
(2, '2016-12-01', '2017-12-01', 150, 'Sezoninis', 'Pagrindinis', NULL, NULL),
(20, '2016-12-03', '2016-12-18', 300, 'Metinis', 'Studento', NULL, NULL),
(60, '2016-12-25', '2016-12-28', 20, 'MÄ—nesio', 'Senjoro', NULL, NULL),
(61, '0064-04-05', '0646-04-05', 12, 'qwe', 'qwe', NULL, NULL),
(62, '0123-12-02', '0013-12-13', 120, 'PusÄ—s metÅ³', 'Moksleivio', NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `administratoriai`
--

CREATE TABLE `administratoriai` (
  `elektroninis_pastas1` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `administratoriai`
--

INSERT INTO `administratoriai` (`elektroninis_pastas1`, `password`) VALUES
('admin@a.a', 'a8f5f167f44f4964e6c998dee827110c');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `buhalteriai`
--

CREATE TABLE `buhalteriai` (
  `tabelio_numeris` int(11) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `asmens_kodas` varchar(11) NOT NULL,
  `elektroninis_pastas` varchar(60) NOT NULL,
  `darbo_sutartis_nuo` date NOT NULL,
  `darbo_sutartis_iki` date NOT NULL,
  `atlyginimas` double NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `buhalteriai`
--

INSERT INTO `buhalteriai` (`tabelio_numeris`, `vardas`, `pavarde`, `asmens_kodas`, `elektroninis_pastas`, `darbo_sutartis_nuo`, `darbo_sutartis_iki`, `atlyginimas`, `password`) VALUES
(1, 'Jonas', 'Jonaitis', '81656526526', 'jonas.jonaitis@gmail.com', '2016-12-01', '2018-06-01', 700, ''),
(2, 'Buhalteris', 'Buhalteroidas', '12345678912', 'buhalteris@b.b.', '2016-12-01', '2016-12-05', 200, 'a8f5f167f44f4964e6c998dee827110c');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `imones`
--

CREATE TABLE `imones` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(60) NOT NULL,
  `adresas` varchar(200) NOT NULL,
  `pasto_kodas` varchar(11) NOT NULL,
  `telefonas` varchar(20) NOT NULL,
  `elektroninis_pastas` varchar(60) NOT NULL,
  `faksas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `imones`
--

INSERT INTO `imones` (`id`, `pavadinimas`, `adresas`, `pasto_kodas`, `telefonas`, `elektroninis_pastas`, `faksas`) VALUES
(1, 'Lietuvos sporto Ä¯ranga', 'Plento g. 6, Kaunas', 'LT-52055', '86301256', 'iranga@sportas.lt', '5415165'),
(2, 'Sportlita', 'GandrÅ³ g. 16', 'LT-51315', '+37063043453', 'sportlita@sportas.lt', '5165162');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `inventorius`
--

CREATE TABLE `inventorius` (
  `tabelio_numeris` varchar(20) NOT NULL,
  `svoris` int(11) DEFAULT NULL,
  `uzimamas_plotas` int(11) DEFAULT NULL,
  `inventoriaus_tipas` varchar(200) NOT NULL,
  `gamintojas` varchar(60) NOT NULL,
  `pagaminimo_data` date NOT NULL,
  `fk_pirkimas` int(11) NOT NULL,
  `fk_patalpa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `inventorius`
--

INSERT INTO `inventorius` (`tabelio_numeris`, `svoris`, `uzimamas_plotas`, `inventoriaus_tipas`, `gamintojas`, `pagaminimo_data`, `fk_pirkimas`, `fk_patalpa`) VALUES
('BEG00001', 0, 3, 'BÄ—gimo takelis', 'Hummel', '2016-12-06', 7, 311),
('BEG00002', 0, 4, 'BÄ—gimo takelis', 'Lok', '2016-12-15', 5, 541),
('JK0001', 0, 3, 'Jogos kilimÄ—lis', 'Reebok', '2016-11-28', 7, 213),
('OS0001', 3, 0, 'Olimpiniai svarmenys', 'Mall', '2016-12-13', 4, 101),
('TR003', 0, 5, 'JÄ—gos treniruoklis', 'Sportlive', '2016-12-12', 6, 203),
('Å 001', 0, 0, 'Å okdynÄ—', 'Gymbit', '2016-12-07', 1, 203);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `klientai`
--

CREATE TABLE `klientai` (
  `asmens_kodas` varchar(11) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `gimimo_data` date NOT NULL,
  `telefonas` varchar(20) NOT NULL,
  `elektroninis_pastas` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gatve` varchar(20) NOT NULL,
  `miestas` varchar(20) NOT NULL,
  `fk_komanda` int(11) DEFAULT NULL,
  `username` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `klientai`
--

INSERT INTO `klientai` (`asmens_kodas`, `vardas`, `pavarde`, `gimimo_data`, `telefonas`, `elektroninis_pastas`, `password`, `gatve`, `miestas`, `fk_komanda`, `username`) VALUES
('123456789', 'Paulius', 'Zaleckis', '1995-08-10', '86123456', 'p@z.lt', 'a8f5f167f44f4964e6c998dee827110c', 'Studentu', 'Kaunas', NULL, ''),
('15643341346', 'demo', 'demo', '2010-10-12', '85632358', 'demo@demo.lt', '62cc2d8b4bf2d8728120d052163a77df', 'demo', 'demo', NULL, ''),
('4958555555', 'klientas', 'klientas', '2016-12-17', '5555555555', 'klientas@a.a', '62cc2d8b4bf2d8728120d052163a77df', 'dsf', 'fff', NULL, ''),
('49855555555', 'Demop', 'Demop', '2016-12-02', '86258888888', 'demo@a.a', '62cc2d8b4bf2d8728120d052163a77df', 'dmeo', 'demo', NULL, ''),
('8888888856', 'rimante', 'grumadaite', '2016-12-14', '856323555', 'rimanate@rimante.lt', 'e10adc3949ba59abbe56e057f20f883e', 'studentu', 'kaunas', NULL, '');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `komandos`
--

CREATE TABLE `komandos` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(20) NOT NULL,
  `sporto_saka` enum('krepsinis','tenisas','plaukimas') NOT NULL,
  `fk_treneris` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `korteles`
--

CREATE TABLE `korteles` (
  `korteles_numeris` int(11) NOT NULL,
  `isduota` date NOT NULL,
  `galioja_iki` date NOT NULL,
  `fk_klientas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `mokejimai`
--

CREATE TABLE `mokejimai` (
  `numeris` int(11) NOT NULL,
  `data` date NOT NULL,
  `suma` double NOT NULL,
  `korteles_numeris` varchar(24) NOT NULL,
  `budas` enum('grynais','banko pavedimu','banko kortele') NOT NULL,
  `bankas` enum('Swedbank','SEB','DNB') NOT NULL,
  `fk_saskaita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `nuolaidos`
--

CREATE TABLE `nuolaidos` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(50) NOT NULL,
  `dydis` double NOT NULL,
  `galioja_nuo` date NOT NULL,
  `galioja_iki` date NOT NULL,
  `tipas` enum('fiksuota','procentine') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `padaliniai`
--

CREATE TABLE `padaliniai` (
  `numeris` int(11) NOT NULL,
  `pavadinimas` varchar(60) NOT NULL,
  `adresas` varchar(200) NOT NULL,
  `telefonas` varchar(20) NOT NULL,
  `elektroninis_pastas` varchar(60) NOT NULL,
  `faksas` varchar(30) NOT NULL,
  `pasto_kodas` varchar(20) NOT NULL,
  `miestas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `padaliniai`
--

INSERT INTO `padaliniai` (`numeris`, `pavadinimas`, `adresas`, `telefonas`, `elektroninis_pastas`, `faksas`, `pasto_kodas`, `miestas`) VALUES
(1, 'Kauno padalinys', 'Lietaus g. 53', '863043453', 'kaunas@sportas.lt', '56231564', 'LT05162', 'Kaunas'),
(2, 'Vilniaus padalinys', 'LiepÅ³ g. 6', '86301256', 'vilnius@sportas.lt', '4965156', 'LT02156', 'Vilnius'),
(3, 'KÄ—dainiÅ³ padalinys', 'Dangaus g. 59', '8457852469', 'kedainiai@sportas.lt', '89156122', 'LT21623', 'KÄ—dainiai'),
(4, 'Palangos padalinys', 'RoÅ¾iÅ³ g. 6', '+37063012566', 'palanga@sportas.lt', '9165165', 'LT-51315', 'Palanga'),
(5, 'Utenos padalinys', 'Rajono g. 6', '+3701651652', 'utena@sportas.lt', '895165126', 'LT-13258', 'Utena');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pardavimai`
--

CREATE TABLE `pardavimai` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `tipas` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fk_saskaita` int(11) DEFAULT NULL,
  `fk_buhalteris` int(11) DEFAULT NULL,
  `fk_klientas` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `pardavimai`
--

INSERT INTO `pardavimai` (`id`, `data`, `tipas`, `fk_saskaita`, `fk_buhalteris`, `fk_klientas`) VALUES
(1, '2016-12-28', 'Prekės', NULL, NULL, NULL),
(2, '2016-12-27', 'Paslaugos', NULL, NULL, NULL),
(3, '2016-12-22', 'Prekė', NULL, NULL, NULL),
(4, '2016-12-22', 'Paslauga', NULL, NULL, NULL),
(5, '2016-12-22', 'PrekÄ—', NULL, NULL, NULL),
(6, '2016-12-22', 'PrekÄ—', NULL, NULL, NULL),
(7, '2016-12-22', 'Paslauga', NULL, NULL, NULL),
(8, '2016-12-22', 'Paslauga', NULL, NULL, NULL),
(9, '2016-12-22', 'Programa', NULL, NULL, NULL),
(10, '2016-12-22', 'Abonementas', NULL, NULL, NULL),
(11, '2016-12-22', 'PrekÄ—', NULL, NULL, NULL),
(12, '2016-12-22', 'PrekÄ—', NULL, NULL, NULL),
(13, '2016-12-22', 'PrekÄ—', NULL, NULL, NULL),
(14, '2016-12-22', 'Paslauga', NULL, NULL, NULL),
(15, '2016-12-22', 'Programa', NULL, NULL, NULL),
(16, '2016-12-22', 'Abonementas', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pasiekimai`
--

CREATE TABLE `pasiekimai` (
  `id` int(11) NOT NULL,
  `ivykis` varchar(20) NOT NULL,
  `pasiekimas` varchar(20) NOT NULL,
  `fk_komanda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `paslaugos`
--

CREATE TABLE `paslaugos` (
  `id` int(11) NOT NULL,
  `kaina` double NOT NULL,
  `isigijama_nuo` date NOT NULL,
  `isigijama_iki` date NOT NULL,
  `tipas` varchar(255) NOT NULL,
  `fk_nuolaida` int(11) DEFAULT NULL,
  `fk_pardavimas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `paslaugos`
--

INSERT INTO `paslaugos` (`id`, `kaina`, `isigijama_nuo`, `isigijama_iki`, `tipas`, `fk_nuolaida`, `fk_pardavimas`) VALUES
(10, 30, '2016-12-11', '2016-12-18', 'Baseinas', NULL, NULL),
(21, 50, '2016-12-18', '2016-12-25', 'Pirtis', NULL, NULL),
(26, 80, '2016-12-11', '2016-12-11', 'KrepÅ¡inis', NULL, NULL),
(50, 30, '2016-12-04', '2015-12-18', 'asdfasdf', NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `patalpos`
--

CREATE TABLE `patalpos` (
  `numeris` int(11) NOT NULL,
  `aukstas` int(11) NOT NULL,
  `ilgis` int(11) NOT NULL,
  `plotis` int(11) NOT NULL,
  `grindu_danga` varchar(20) DEFAULT NULL,
  `tipas` varchar(20) DEFAULT NULL,
  `fk_padalinys` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `patalpos`
--

INSERT INTO `patalpos` (`numeris`, `aukstas`, `ilgis`, `plotis`, `grindu_danga`, `tipas`, `fk_padalinys`) VALUES
(101, 1, 10, 6, 'parketas', 'aerobikos sale', 1),
(203, 2, 6, 0, 'parketas', 'aerobikos sale', 3),
(213, 2, 3, 6, 'Parketas', 'Biuras', 3),
(311, 3, 5, 5, 'KiliminÄ— danga', 'Aerobikos salÄ—', 1),
(541, 5, 5, 6, 'Parketas', 'Å okiÅ³ salÄ—', 4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pirkimai`
--

CREATE TABLE `pirkimai` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `suma` double NOT NULL,
  `fk_imone` int(11) NOT NULL,
  `fk_buhalteris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `pirkimai`
--

INSERT INTO `pirkimai` (`id`, `data`, `suma`, `fk_imone`, `fk_buhalteris`) VALUES
(1, '2016-12-01', 30, 1, 1),
(2, '2016-12-22', 30, 2, 2),
(3, '2016-12-07', 30, 2, 2),
(4, '2016-12-06', 300, 1, 1),
(5, '2016-11-30', 200, 1, 2),
(6, '2016-12-12', 10, 2, 1),
(7, '2016-11-27', 30, 2, 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `prekes`
--

CREATE TABLE `prekes` (
  `id` int(11) NOT NULL,
  `rusis` varchar(30) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `pavadinimas` varchar(30) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `gamintojas` varchar(30) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci NOT NULL,
  `pagaminta` date NOT NULL,
  `galioja_iki` date NOT NULL,
  `pristatyta` date NOT NULL,
  `kiekis` int(11) NOT NULL,
  `kaina` double NOT NULL,
  `tipas` varchar(255) NOT NULL,
  `fk_nuolaida` int(11) DEFAULT NULL,
  `fk_pardavimas` int(11) DEFAULT NULL,
  `pav` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `prekes`
--

INSERT INTO `prekes` (`id`, `rusis`, `pavadinimas`, `gamintojas`, `pagaminta`, `galioja_iki`, `pristatyta`, `kiekis`, `kaina`, `tipas`, `fk_nuolaida`, `fk_pardavimas`, `pav`) VALUES
(2, 'Baltymai', 'Proteinas', 'Whey', '2016-12-01', '2016-12-03', '2016-12-02', 100, 20, 'Sporto papildai', NULL, NULL, 'pardavimupav/2.jpg'),
(6, 'Angliavandeniai', 'RyÅ¾iai', 'KinieÄiai', '2016-12-01', '2016-12-03', '2016-12-02', 50, 10, 'Maistas', NULL, NULL, 'pardavimupav/4.jpg'),
(15, 'Baltymai', 'KiauÅ¡inis', 'ViÅ¡ta', '2016-12-01', '2016-12-04', '0122-12-12', 50, 48, 'Sporto papildai', NULL, NULL, 'pardavimupav/3.jpg');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `programos`
--

CREATE TABLE `programos` (
  `id` int(11) NOT NULL,
  `vyksta_nuo` date NOT NULL,
  `kaina` double NOT NULL,
  `trukme` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tipas` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lytis` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `rusis` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fk_pardavimas` int(11) DEFAULT NULL,
  `fk_nuolaida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `programos`
--

INSERT INTO `programos` (`id`, `vyksta_nuo`, `kaina`, `trukme`, `tipas`, `lytis`, `rusis`, `fk_pardavimas`, `fk_nuolaida`) VALUES
(7, '2016-12-18', 20, '3 dienÅ³', 'Svorio metimo', 'Moteris', 'Individuali', NULL, NULL),
(8, '2016-12-11', 20, '4 dienÅ³', 'MasÄ—s auginimo', 'Vyras', 'BazinÄ—', NULL, NULL),
(10, '2016-12-25', 30, '3 dienÅ³', 'Svorio metimo', 'Moteris', 'Individuali', NULL, NULL);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `saskaitos`
--

CREATE TABLE `saskaitos` (
  `numeris` int(11) NOT NULL,
  `data` date NOT NULL,
  `suma` int(11) NOT NULL,
  `busena` enum('nepatvirtinta','patvirtinta','vykdoma','ivykdyta') NOT NULL,
  `fk_buhalteris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `sutartys`
--

CREATE TABLE `sutartys` (
  `numeris` int(11) NOT NULL,
  `sudarymo_data` date NOT NULL,
  `sutarties_busena` varchar(20) NOT NULL,
  `suma` double NOT NULL,
  `galioja_iki` date NOT NULL,
  `fk_imone` int(11) NOT NULL,
  `fk_buhalteris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `treneriai`
--

CREATE TABLE `treneriai` (
  `asmens_kodas` varchar(11) NOT NULL,
  `vardas` varchar(20) NOT NULL,
  `pavarde` varchar(20) NOT NULL,
  `telefono_numeris` varchar(20) NOT NULL,
  `elektroninis_pastas` varchar(20) NOT NULL,
  `tabelio_nr` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `treneriai`
--

INSERT INTO `treneriai` (`asmens_kodas`, `vardas`, `pavarde`, `telefono_numeris`, `elektroninis_pastas`, `tabelio_nr`) VALUES
('1', 'Deividas', 'edd', '9856566556', 't@t.t', '5666'),
('48564723346', 'Antanas', 'Antanaitis', '860321175', 'kazkas@kazkas.lt', 'tab');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `uzsiemimai`
--

CREATE TABLE `uzsiemimai` (
  `id` int(11) NOT NULL,
  `pradzios_laikas` time NOT NULL,
  `pabaigos_laikas` time NOT NULL,
  `uzsiemimo_tipas` enum('joga','pilatesas','kuno dizainas','kalanetika','aerobika','plaukimas') DEFAULT NULL,
  `fk_patalpa` int(11) NOT NULL,
  `fk_treneris` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Sukurta duomenų kopija lentelei `uzsiemimai`
--

INSERT INTO `uzsiemimai` (`id`, `pradzios_laikas`, `pabaigos_laikas`, `uzsiemimo_tipas`, `fk_patalpa`, `fk_treneris`) VALUES
(1, '00:00:00', '00:00:00', 'pilatesas', 203, '48564723346'),
(2, '16:34:00', '17:34:00', 'joga', 101, '48564723346'),
(48, '00:15:00', '00:50:00', 'joga', 101, '48564723346'),
(50, '02:00:00', '03:00:00', 'pilatesas', 203, '48564723346'),
(156, '00:00:00', '00:00:00', '', 101, '48564723346');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonementai`
--
ALTER TABLE `abonementai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pardavimas` (`fk_pardavimas`),
  ADD KEY `fk_nuolaida` (`fk_nuolaida`),
  ADD KEY `fk_pardavimas_2` (`fk_pardavimas`);

--
-- Indexes for table `administratoriai`
--
ALTER TABLE `administratoriai`
  ADD UNIQUE KEY `elektroninis_pastas` (`elektroninis_pastas1`);

--
-- Indexes for table `buhalteriai`
--
ALTER TABLE `buhalteriai`
  ADD PRIMARY KEY (`tabelio_numeris`);

--
-- Indexes for table `imones`
--
ALTER TABLE `imones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventorius`
--
ALTER TABLE `inventorius`
  ADD PRIMARY KEY (`tabelio_numeris`),
  ADD KEY `fk_pirkimas` (`fk_pirkimas`),
  ADD KEY `fk_patalpa` (`fk_patalpa`);

--
-- Indexes for table `klientai`
--
ALTER TABLE `klientai`
  ADD PRIMARY KEY (`asmens_kodas`),
  ADD KEY `fk_komanda` (`fk_komanda`);

--
-- Indexes for table `komandos`
--
ALTER TABLE `komandos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_treneris` (`fk_treneris`);

--
-- Indexes for table `korteles`
--
ALTER TABLE `korteles`
  ADD PRIMARY KEY (`korteles_numeris`),
  ADD KEY `fk_klientas` (`fk_klientas`);

--
-- Indexes for table `mokejimai`
--
ALTER TABLE `mokejimai`
  ADD PRIMARY KEY (`numeris`),
  ADD KEY `fk_saskaita` (`fk_saskaita`);

--
-- Indexes for table `nuolaidos`
--
ALTER TABLE `nuolaidos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `padaliniai`
--
ALTER TABLE `padaliniai`
  ADD PRIMARY KEY (`numeris`);

--
-- Indexes for table `pardavimai`
--
ALTER TABLE `pardavimai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_saskaita` (`fk_saskaita`),
  ADD KEY `fk_buhalteris` (`fk_buhalteris`),
  ADD KEY `fk_klientas` (`fk_klientas`);

--
-- Indexes for table `pasiekimai`
--
ALTER TABLE `pasiekimai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_komanda` (`fk_komanda`);

--
-- Indexes for table `paslaugos`
--
ALTER TABLE `paslaugos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nuolaida` (`fk_nuolaida`),
  ADD KEY `fk_pardavimas` (`fk_pardavimas`);

--
-- Indexes for table `patalpos`
--
ALTER TABLE `patalpos`
  ADD PRIMARY KEY (`numeris`),
  ADD KEY `fk_padalinys` (`fk_padalinys`);

--
-- Indexes for table `pirkimai`
--
ALTER TABLE `pirkimai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imone` (`fk_imone`),
  ADD KEY `fk_buhalteris` (`fk_buhalteris`);

--
-- Indexes for table `prekes`
--
ALTER TABLE `prekes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nuolaida` (`fk_nuolaida`),
  ADD KEY `fk_pardavimas` (`fk_pardavimas`);

--
-- Indexes for table `programos`
--
ALTER TABLE `programos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pardavimas` (`fk_pardavimas`),
  ADD KEY `fk_nuolaida` (`fk_nuolaida`);

--
-- Indexes for table `saskaitos`
--
ALTER TABLE `saskaitos`
  ADD PRIMARY KEY (`numeris`),
  ADD KEY `fk_buhalteris` (`fk_buhalteris`);

--
-- Indexes for table `sutartys`
--
ALTER TABLE `sutartys`
  ADD PRIMARY KEY (`numeris`),
  ADD KEY `fk_imone` (`fk_imone`),
  ADD KEY `fk_buhalteris` (`fk_buhalteris`);

--
-- Indexes for table `treneriai`
--
ALTER TABLE `treneriai`
  ADD PRIMARY KEY (`asmens_kodas`);

--
-- Indexes for table `uzsiemimai`
--
ALTER TABLE `uzsiemimai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patalpa` (`fk_patalpa`),
  ADD KEY `fk_treneris` (`fk_treneris`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonementai`
--
ALTER TABLE `abonementai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `imones`
--
ALTER TABLE `imones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `padaliniai`
--
ALTER TABLE `padaliniai`
  MODIFY `numeris` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `paslaugos`
--
ALTER TABLE `paslaugos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `pirkimai`
--
ALTER TABLE `pirkimai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `prekes`
--
ALTER TABLE `prekes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `programos`
--
ALTER TABLE `programos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `abonementai`
--
ALTER TABLE `abonementai`
  ADD CONSTRAINT `sudarytas1` FOREIGN KEY (`fk_pardavimas`) REFERENCES `pardavimai` (`id`),
  ADD CONSTRAINT `taikoma1` FOREIGN KEY (`fk_nuolaida`) REFERENCES `nuolaidos` (`id`);

--
-- Apribojimai lentelei `inventorius`
--
ALTER TABLE `inventorius`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`fk_patalpa`) REFERENCES `patalpos` (`numeris`),
  ADD CONSTRAINT `fk_pirkimas` FOREIGN KEY (`fk_pirkimas`) REFERENCES `pirkimai` (`id`) ON DELETE CASCADE;

--
-- Apribojimai lentelei `klientai`
--
ALTER TABLE `klientai`
  ADD CONSTRAINT `fk6` FOREIGN KEY (`fk_komanda`) REFERENCES `komandos` (`id`);

--
-- Apribojimai lentelei `komandos`
--
ALTER TABLE `komandos`
  ADD CONSTRAINT `fk7` FOREIGN KEY (`fk_treneris`) REFERENCES `treneriai` (`asmens_kodas`);

--
-- Apribojimai lentelei `korteles`
--
ALTER TABLE `korteles`
  ADD CONSTRAINT `fk8` FOREIGN KEY (`fk_klientas`) REFERENCES `klientai` (`asmens_kodas`);

--
-- Apribojimai lentelei `mokejimai`
--
ALTER TABLE `mokejimai`
  ADD CONSTRAINT `fk9` FOREIGN KEY (`fk_saskaita`) REFERENCES `saskaitos` (`numeris`);

--
-- Apribojimai lentelei `pardavimai`
--
ALTER TABLE `pardavimai`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`fk_saskaita`) REFERENCES `saskaitos` (`numeris`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`fk_buhalteris`) REFERENCES `buhalteriai` (`tabelio_numeris`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`fk_klientas`) REFERENCES `klientai` (`asmens_kodas`);

--
-- Apribojimai lentelei `pasiekimai`
--
ALTER TABLE `pasiekimai`
  ADD CONSTRAINT `fk10` FOREIGN KEY (`fk_komanda`) REFERENCES `komandos` (`id`);

--
-- Apribojimai lentelei `paslaugos`
--
ALTER TABLE `paslaugos`
  ADD CONSTRAINT `sudarytas2` FOREIGN KEY (`fk_pardavimas`) REFERENCES `pardavimai` (`id`),
  ADD CONSTRAINT `taikoma2` FOREIGN KEY (`fk_nuolaida`) REFERENCES `nuolaidos` (`id`);

--
-- Apribojimai lentelei `patalpos`
--
ALTER TABLE `patalpos`
  ADD CONSTRAINT `fk_padalinys` FOREIGN KEY (`fk_padalinys`) REFERENCES `padaliniai` (`numeris`) ON DELETE CASCADE;

--
-- Apribojimai lentelei `pirkimai`
--
ALTER TABLE `pirkimai`
  ADD CONSTRAINT `fk13` FOREIGN KEY (`fk_buhalteris`) REFERENCES `buhalteriai` (`tabelio_numeris`);

--
-- Apribojimai lentelei `prekes`
--
ALTER TABLE `prekes`
  ADD CONSTRAINT `sudarytas4` FOREIGN KEY (`fk_pardavimas`) REFERENCES `pardavimai` (`id`),
  ADD CONSTRAINT `taikoma4` FOREIGN KEY (`fk_nuolaida`) REFERENCES `nuolaidos` (`id`);

--
-- Apribojimai lentelei `programos`
--
ALTER TABLE `programos`
  ADD CONSTRAINT `sudarytas3` FOREIGN KEY (`fk_pardavimas`) REFERENCES `pardavimai` (`id`),
  ADD CONSTRAINT `taikoma3` FOREIGN KEY (`fk_nuolaida`) REFERENCES `nuolaidos` (`id`);

--
-- Apribojimai lentelei `saskaitos`
--
ALTER TABLE `saskaitos`
  ADD CONSTRAINT `fk14` FOREIGN KEY (`fk_buhalteris`) REFERENCES `buhalteriai` (`tabelio_numeris`);

--
-- Apribojimai lentelei `sutartys`
--
ALTER TABLE `sutartys`
  ADD CONSTRAINT `fk16` FOREIGN KEY (`fk_buhalteris`) REFERENCES `buhalteriai` (`tabelio_numeris`);

--
-- Apribojimai lentelei `uzsiemimai`
--
ALTER TABLE `uzsiemimai`
  ADD CONSTRAINT `fk17` FOREIGN KEY (`fk_patalpa`) REFERENCES `patalpos` (`numeris`),
  ADD CONSTRAINT `fk18` FOREIGN KEY (`fk_treneris`) REFERENCES `treneriai` (`asmens_kodas`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
