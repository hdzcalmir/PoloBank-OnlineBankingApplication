-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 07:36 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polobank`
--

-- --------------------------------------------------------

--
-- Table structure for table `kartice`
--

CREATE TABLE `kartice` (
  `id_kartice` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `tip_kartice` varchar(64) CHARACTER SET utf8 NOT NULL,
  `iban` varchar(16) NOT NULL,
  `broj_kartice` varchar(16) NOT NULL,
  `datum_isteka` varchar(14) NOT NULL DEFAULT '10-10-2003',
  `pin` int(4) NOT NULL,
  `balans_kartice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartice`
--

INSERT INTO `kartice` (`id_kartice`, `id_korisnika`, `tip_kartice`, `iban`, `broj_kartice`, `datum_isteka`, `pin`, `balans_kartice`) VALUES
(31, 31, 'Visa', '1613896984960352', '4255275909695842', '06/2026', 1234, 0),
(32, 32, 'Visa', '1613552325705071', '4255097796139398', '06/2026', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnika` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT 'polobank@info.ba',
  `sifra` varchar(72) NOT NULL DEFAULT '',
  `ime_prezime` varchar(128) CHARACTER SET utf8 NOT NULL,
  `datum_rodjenja` varchar(12) NOT NULL DEFAULT '01/01/1999',
  `grad` varchar(128) CHARACTER SET utf8 NOT NULL,
  `adresa` varchar(128) NOT NULL DEFAULT 'Nema adresu',
  `stanje_racuna` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnika`, `email`, `sifra`, `ime_prezime`, `datum_rodjenja`, `grad`, `adresa`, `stanje_racuna`) VALUES
(31, 'admin@gmail.com', '$2y$10$SufzqbCR7D22PBJzQpqKm.C75JpvOIefU.Z9tVkG3x7nYaes7E58e', 'Ibrahim Okic', '2003-06-05', 'Višegrad', 'Gornji Moranjci', 0),
(32, 'hdzcalmir@gmail.com', '$2y$10$PG.CIzUGh56C7Z7C1zTqA.7vJaRZwWmDa4gxMvcdk3iGVALBQvVie', 'Almir Hodzic', '2000-06-05', 'Novi Sad', 'Gornji Moranjci', 0);

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

CREATE TABLE `racun` (
  `id_racuna` int(11) NOT NULL,
  `id_kartice` int(11) NOT NULL,
  `id_transakcije` int(11) NOT NULL,
  `id_uzorka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transakcije`
--

CREATE TABLE `transakcije` (
  `id_transakcije` int(11) NOT NULL,
  `tip_transakcije` varchar(64) CHARACTER SET utf8 NOT NULL,
  `suma` int(255) NOT NULL,
  `datum_transakcije` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uzorci`
--

CREATE TABLE `uzorci` (
  `id_uzorka` int(11) NOT NULL,
  `ime_uzorka` varchar(128) CHARACTER SET utf8 NOT NULL,
  `ime_prezime` varchar(128) CHARACTER SET utf8 NOT NULL,
  `broj_racuna` varchar(16) NOT NULL,
  `id_korisnika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kartice`
--
ALTER TABLE `kartice`
  ADD PRIMARY KEY (`id_kartice`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `racun`
--
ALTER TABLE `racun`
  ADD PRIMARY KEY (`id_racuna`);

--
-- Indexes for table `transakcije`
--
ALTER TABLE `transakcije`
  ADD PRIMARY KEY (`id_transakcije`);

--
-- Indexes for table `uzorci`
--
ALTER TABLE `uzorci`
  ADD PRIMARY KEY (`id_uzorka`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kartice`
--
ALTER TABLE `kartice`
  MODIFY `id_kartice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `racun`
--
ALTER TABLE `racun`
  MODIFY `id_racuna` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transakcije`
--
ALTER TABLE `transakcije`
  MODIFY `id_transakcije` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzorci`
--
ALTER TABLE `uzorci`
  MODIFY `id_uzorka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
