-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2019 at 12:56 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m12`
--

CREATE DATABASE IF NOT EXISTS `m12` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `m12`;

-- --------------------------------------------------------

--
-- Table structure for table `carro`
--

CREATE TABLE `carro` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telf` varchar(13) NOT NULL,
  `type` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `name`, `user`, `email`, `telf`, `type`, `password`) VALUES
(1, 'Andrei', 'andreivg595', 'cf17andrei.gindac@iesjoandaustria.org', '656909949', 'Particular', '$2y$10$P3c2evZmUnDf6QWKLq7epeLbXvw8azxVgU8oV3zWtOKgE5oZecX4e'),
(2, 'David', 'cobas123', 'david.cobas@iesjoandaustria.org', '652209949', 'Particular', '$2y$10$X1LGS7DZ7gvgTJ39lt6.Zec.G5pUDNBg8l/H/M/cRTJkZEINt5v/i'),
(3, 'Carlos', 'yuste007', 'carlos.yuste@iesjoandaustria.org', '633209949', 'Particular', '$2y$10$vsraoHYskJgFwvqyFYcc/eE7i/Q.t40Y7YOS1Ltxb6bJQJq4w8bnm'),
(4, 'Pau', 'dawpau', 'cf17pau.duran@iesjoandaustria.org', '665493949', 'Empresa', '$2y$10$RL3RHHbzJCLOqh0PQWN.SOmdKiJl7.bjC4U16Zkt0JOiWOpvB1VcC');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `precio` float NOT NULL,
  `tipo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`, `tipo`) VALUES
(1, 'Camiseta manga corta', 2, 1),
(2, 'Camiseta manga larga', 2, 1),
(3, 'Pantalón tejano', 2, 2),
(4, 'Camisa', 2, 1),
(5, 'Americana', 2, 1),
(6, 'Pantalón', 2, 2),
(7, 'Jersey', 2, 1),
(8, 'Sudadera', 2, 1),
(9, 'Pantalón chandal', 2, 2),
(10, 'Abrigo', 2, 1),
(11, 'Vestido', 2, 1),
(12, 'Falda', 2, 2),
(13, 'Chaqueta', 2, 1),
(14, 'Chaleco', 2, 1),
(15, 'Polo', 2, 1),
(16, 'Pantalón bermudas', 2, 2),
(17, 'Pantalón shorts', 2, 2),
(18, 'Pantalón chandal corto', 2, 2),
(19, 'Camiseta tirantes', 2, 1),
(20, 'Top', 2, 1),
(21, 'Leggins', 2, 2),
(22, 'Corbata', 2, 3),
(23, 'Calcetines', 2, 3),
(24, 'Guantes', 2, 3),
(25, 'Gorro', 2, 3),
(26, 'Bufanda', 2, 3),
(27, 'Bata', 2, 3),
(28, 'Toalla mediana', 2, 4),
(29, 'Toalla grande', 2, 4),
(30, 'Manta', 2, 4),
(31, 'Sabana', 2, 4),
(32, 'Funda almohada', 2, 4),
(33, 'Edredón', 2, 4),
(34, 'Cortina', 2, 4),
(35, 'Mantel', 2, 4),
(36, 'Servilleta', 2, 4),
(37, 'Pack5', 2, 5),
(38, 'Pack10', 2, 5),
(39, 'Pack15', 2, 5),
(40, 'Pack20', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `trabajador`
--

CREATE TABLE `trabajador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `user` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `telf` varchar(13) COLLATE latin1_spanish_ci NOT NULL,
  `dni` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `ss` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `trabajador`
--

INSERT INTO `trabajador` (`id`, `nombre`, `user`, `password`, `telf`, `dni`, `ss`) VALUES
(1, 'Pepe', 'pepe_washapp@washapp.com', '$2y$10$AF/I./m6DSN1j218a7gfG.KLt/VGF3rTPIuP1EhAq/2E2aKmrTKvm', '656909949', '23532345A', '654123112123'),
(2, 'Pepa', 'pepa_washapp@washapp.com', '$2y$10$WmYEmnrw0f4I9nb7zDJx.ONeguxuCTCrMPiN49ENWOcg2EC7jz4AS', '633309949', '33322345A', '7867564352412');

-- --------------------------------------------------------

--
-- Table structure for table `washapp`
--

CREATE TABLE `washapp` (
  `id` int(11) NOT NULL,
  `user` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Dumping data for table `washapp`
--

INSERT INTO `washapp` (`id`, `user`, `password`) VALUES
(1, 'admin@washapp.com', '$2y$10$lZn/bFzWH0ILm9HPGztKfeIYMfSeQaBgyGneps/Os5jrgSEIiSpfi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`,`email`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `dni` (`dni`,`ss`);

--
-- Indexes for table `washapp`
--
ALTER TABLE `washapp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `washapp`
--
ALTER TABLE `washapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
