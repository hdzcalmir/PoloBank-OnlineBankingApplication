-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2022 at 12:48 AM
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
-- Table structure for table `analitika`
--

CREATE TABLE `analitika` (
  `id_korisnika` int(11) NOT NULL,
  `januar_prihod` float NOT NULL DEFAULT 0,
  `februar_prihod` float NOT NULL DEFAULT 0,
  `mart_prihod` float NOT NULL DEFAULT 0,
  `april_prihod` float NOT NULL DEFAULT 0,
  `maj_prihod` float NOT NULL DEFAULT 0,
  `juni_prihod` float NOT NULL DEFAULT 0,
  `juli_prihod` float NOT NULL DEFAULT 0,
  `august_prihod` float NOT NULL DEFAULT 0,
  `septembar_prihod` float NOT NULL DEFAULT 0,
  `oktobar_prihod` float NOT NULL DEFAULT 0,
  `novembar_prihod` float NOT NULL DEFAULT 0,
  `decembar_prihod` float NOT NULL DEFAULT 0,
  `januar_rashod` float NOT NULL DEFAULT 0,
  `februar_rashod` float NOT NULL DEFAULT 0,
  `mart_rashod` float NOT NULL DEFAULT 0,
  `april_rashod` float NOT NULL DEFAULT 0,
  `maj_rashod` float NOT NULL DEFAULT 0,
  `juni_rashod` float NOT NULL DEFAULT 0,
  `juli_rashod` float NOT NULL DEFAULT 0,
  `august_rashod` float NOT NULL DEFAULT 0,
  `septembar_rashod` float NOT NULL DEFAULT 0,
  `oktobar_rashod` float NOT NULL DEFAULT 0,
  `novembar_rashod` float NOT NULL DEFAULT 0,
  `decembar_rashod` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analitika`
--

INSERT INTO `analitika` (`id_korisnika`, `januar_prihod`, `februar_prihod`, `mart_prihod`, `april_prihod`, `maj_prihod`, `juni_prihod`, `juli_prihod`, `august_prihod`, `septembar_prihod`, `oktobar_prihod`, `novembar_prihod`, `decembar_prihod`, `januar_rashod`, `februar_rashod`, `mart_rashod`, `april_rashod`, `maj_rashod`, `juni_rashod`, `juli_rashod`, `august_rashod`, `septembar_rashod`, `oktobar_rashod`, `novembar_rashod`, `decembar_rashod`) VALUES
(1, 0, 0, 0, 0, 0, 0, 41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 587.5, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0, 586.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 43, 0, 0, 0, 0, 0);

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
(1, 'hdzcalmir@gmail.com', '$2y$10$2WX0rZBBOboD8BgHZs6LaealQ6GG1pW0b4uChQzWpvQ0o/ZAnkwXa', 'Ibrahim Okic', '2000-06-06', 'Srebrenik', 'Gornji Moranjci', 0),
(2, 'admin@gmail.com', '$2y$10$tu3DaGWTGMUVzPhRVk9nBuUnRSYx2ZZN9TsoiLmz0PmlYH006IZTy', 'Almir Hodzic', '2000-01-01', 'Živinice', 'Gornji Moranjci', 0);

-- --------------------------------------------------------

--
-- Table structure for table `racuni`
--

CREATE TABLE `racuni` (
  `id_kartice` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `tip_kartice` varchar(64) CHARACTER SET utf8 NOT NULL,
  `iban` varchar(16) NOT NULL,
  `broj_kartice` varchar(16) NOT NULL,
  `datum_isteka` varchar(14) NOT NULL DEFAULT '10-10-2003',
  `pin` varchar(4) NOT NULL,
  `balans_kartice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `racuni`
--

INSERT INTO `racuni` (`id_kartice`, `id_korisnika`, `tip_kartice`, `iban`, `broj_kartice`, `datum_isteka`, `pin`, `balans_kartice`) VALUES
(1, 1, 'Visa', '1613535599936499', '4255105503613013', '07/2026', '0000', 1511.7),
(2, 2, 'Master Card', '1613284651664817', '5351950888220187', '07/2026', '1111', 743.7);

-- --------------------------------------------------------

--
-- Table structure for table `transakcije`
--

CREATE TABLE `transakcije` (
  `id_transakcije` int(11) NOT NULL,
  `tip_transakcije` varchar(64) CHARACTER SET utf8 NOT NULL,
  `suma` float NOT NULL,
  `datum_transakcije` varchar(12) NOT NULL,
  `id_korisnika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transakcije`
--

INSERT INTO `transakcije` (`id_transakcije`, `tip_transakcije`, `suma`, `datum_transakcije`, `id_korisnika`) VALUES
(1, 'Isplata', 20.5, '18.07.2022', 2),
(2, 'Uplata', 20.5, '18.07.2022', 1),
(3, 'Isplata', 20.5, '18.07.2022', 2),
(4, 'Uplata', 20.5, '18.07.2022', 1),
(5, 'Isplata', 586.5, '22.07.2022', 1),
(6, 'Uplata', 586.5, '22.07.2022', 2);

-- --------------------------------------------------------

--
-- Table structure for table `uzorci`
--

CREATE TABLE `uzorci` (
  `id_uzorka` int(11) NOT NULL,
  `ime_uzorka` varchar(128) CHARACTER SET utf8 NOT NULL,
  `ime_prezime` varchar(128) CHARACTER SET utf8 NOT NULL,
  `broj_racuna` varchar(16) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `suma` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uzorci`
--

INSERT INTO `uzorci` (`id_uzorka`, `ime_uzorka`, `ime_prezime`, `broj_racuna`, `id_korisnika`, `suma`) VALUES
(1, 'rodzo', 'Ibrahim Okic', '1613535599936499', 2, 20.5),
(2, 'rodzo', 'Almir Hodzic', '1613284651664817', 1, 586.5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analitika`
--
ALTER TABLE `analitika`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `racuni`
--
ALTER TABLE `racuni`
  ADD PRIMARY KEY (`id_kartice`);

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
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `racuni`
--
ALTER TABLE `racuni`
  MODIFY `id_kartice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transakcije`
--
ALTER TABLE `transakcije`
  MODIFY `id_transakcije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `uzorci`
--
ALTER TABLE `uzorci`
  MODIFY `id_uzorka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
