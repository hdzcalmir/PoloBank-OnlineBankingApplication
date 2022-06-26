-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 03:21 PM
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
  `pin` varchar(4) NOT NULL,
  `balans_kartice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kartice`
--

INSERT INTO `kartice` (`id_kartice`, `id_korisnika`, `tip_kartice`, `iban`, `broj_kartice`, `datum_isteka`, `pin`, `balans_kartice`) VALUES
(61, 60, 'Master Card', '1613017838676320', '5351330356539883', '06/2026', '0000', '3000'),
(62, 61, 'Visa', '1613646945812278', '4255443682441600', '06/2026', '0000', '2437.71'),
(63, 62, 'Visa', '1613583064488712', '4255179797348296', '06/2026', '0000', '2045.29'),
(64, 63, 'Master Card', '1613713249778007', '5351811404756625', '06/2026', '0000', '0'),
(65, 64, 'Master Card', '1613124686776441', '5351644106452721', '06/2026', '0000', '0'),
(66, 65, 'Visa', '1613154858597113', '4255248139355112', '06/2026', '0000', '0');

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
(60, 'hdzcalmir@gmail.com', '$2y$10$MqXKtCgiiLBG8F4GRpoVNOIF76/ebDaiA55hqIJZAJTB/iWaFva/W', 'Ibrahim Okic', '2003-07-20', 'Novi Sad', 'Luka bb', 0),
(61, 'admin@gmail.com', '$2y$10$Kl.7tCP35LRle7d4Q0.tQeTfgJ68jEFaxjFWRYlCmrPQTjI1TvAOu', 'Almir Hodzic', '2000-05-06', 'Novi Sad', 'Luka bb', 0),
(62, 'almir.hodzicc10@gmail.com', '$2y$10$bhk5J9ghvqhz9S/RacaoWuPptdWV81aL8Lv9e.qCQEcQk3Yn2jTxC', 'Mesa Zukic', '2004-02-22', 'Novi Sad', 'Gornji Moranjci', 0),
(63, 'adishodzic@gmail.com', '$2y$10$lfX28CrjDgRBXHaNUSqNnu6hayoII32i0sGAOoeO34BmkncZx7nge', 'Adis Hodzic', '2003-12-24', 'Srebrenik', 'Luka bb', 0),
(64, 'hdzcalmaaair@gmail.com', '$2y$10$ZSrNJ88LLDE7Ywk3HeyUV.B.HAC/xwh1DwBIl/FT8PlSzofvFLi4.', 'Ibrahim Okic', '2022-06-14', 'Višegrad', 'Gornji Moranjci', 0),
(65, 'esadasdin@gmail.com', '$2y$10$Q/wdA5gfT6FFukL7EDo8QuRgUMs6Pnq6CJusmzZPnB61Ia5vYFFeG', 'Ibrahim Okic', '2000-01-01', 'Novi Sad', 'Gornji Moranjci', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transakcije`
--

CREATE TABLE `transakcije` (
  `id_transakcije` int(11) NOT NULL,
  `tip_transakcije` varchar(64) CHARACTER SET utf8 NOT NULL,
  `suma` varchar(255) NOT NULL,
  `datum_transakcije` varchar(12) NOT NULL,
  `id_korisnika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transakcije`
--

INSERT INTO `transakcije` (`id_transakcije`, `tip_transakcije`, `suma`, `datum_transakcije`, `id_korisnika`) VALUES
(128, 'Isplata', '23.20', '25.06.2022', 62),
(129, 'Uplata', '23.20', '25.06.2022', 61),
(130, 'Isplata', '21.35', '25.06.2022', 62),
(131, 'Uplata', '21.35', '25.06.2022', 61),
(132, 'Isplata', '23.5', '25.06.2022', 62),
(133, 'Uplata', '23.5', '25.06.2022', 61),
(134, 'Isplata', '23', '25.06.2022', 62),
(135, 'Uplata', '23', '25.06.2022', 61),
(136, 'Isplata', '24.5', '25.06.2022', 62),
(137, 'Uplata', '24.5', '25.06.2022', 61),
(138, 'Isplata', '24.5', '25.06.2022', 62),
(139, 'Uplata', '24.5', '25.06.2022', 61),
(140, 'Isplata', '23.5', '25.06.2022', 62),
(141, 'Uplata', '23.5', '25.06.2022', 61),
(142, 'Isplata', '23.6', '25.06.2022', 62),
(143, 'Uplata', '23.6', '25.06.2022', 61),
(144, 'Isplata', '23.6', '25.06.2022', 62),
(145, 'Uplata', '23.6', '25.06.2022', 61),
(146, 'Isplata', '23.4', '25.06.2022', 62),
(147, 'Uplata', '23.4', '25.06.2022', 61),
(148, 'Isplata', '28.9', '25.06.2022', 62),
(149, 'Uplata', '28.9', '25.06.2022', 61),
(150, 'Isplata', '23.2', '25.06.2022', 62),
(151, 'Uplata', '23.2', '25.06.2022', 61),
(152, 'Isplata', '23.46', '25.06.2022', 62),
(153, 'Uplata', '23.46', '25.06.2022', 61),
(154, 'Isplata', '23.2', '25.06.2022', 62),
(155, 'Uplata', '23.2', '25.06.2022', 61),
(156, 'Isplata', '23.8', '25.06.2022', 62),
(157, 'Uplata', '23.8', '25.06.2022', 61),
(158, 'Isplata', '23', '25.06.2022', 62),
(159, 'Uplata', '23', '25.06.2022', 61),
(160, 'Isplata', '58', '25.06.2022', 62),
(161, 'Uplata', '58', '25.06.2022', 61);

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
  `suma` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uzorci`
--

INSERT INTO `uzorci` (`id_uzorka`, `ime_uzorka`, `ime_prezime`, `broj_racuna`, `id_korisnika`, `suma`) VALUES
(73, 'poklon', 'Almir Hodzic', '1613646945812278', 62, '23.2'),
(74, 'rodzo', 'Almir Hodzic', '1613646945812278', 62, '23.8'),
(75, 'ibrahim', 'Almir Hodzic', '1613646945812278', 62, '58');

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
  MODIFY `id_kartice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `transakcije`
--
ALTER TABLE `transakcije`
  MODIFY `id_transakcije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `uzorci`
--
ALTER TABLE `uzorci`
  MODIFY `id_uzorka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
