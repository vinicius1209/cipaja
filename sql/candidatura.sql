-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2017 at 12:16 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cipaja`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidatura`
--

CREATE TABLE `candidatura` (
  `id` int(11) NOT NULL COMMENT 'Chave primária das candidaturas',
  `status` varchar(1) DEFAULT NULL COMMENT 'Null = ainda não foi aprovada ou negada pelo administrador | A = Candidatura aprovada | N = Candidatura negada',
  `usuario_id` int(11) NOT NULL COMMENT 'referencia de usuario.id',
  `cipa_id` int(11) NOT NULL COMMENT 'Referencia de cipa.id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de candidaturas, onde o administrador aprova ou nega';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidatura`
--
ALTER TABLE `candidatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `cipa_id` (`cipa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidatura`
--
ALTER TABLE `candidatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária das candidaturas';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidatura`
--
ALTER TABLE `candidatura`
  ADD CONSTRAINT `candidatura_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `candidatura_ibfk_2` FOREIGN KEY (`cipa_id`) REFERENCES `cipa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
