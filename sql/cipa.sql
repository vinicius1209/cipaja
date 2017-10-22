-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2017 at 11:55 PM
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
-- Table structure for table `cipa`
--

CREATE TABLE `cipa` (
  `id` int(11) NOT NULL COMMENT 'Chave primária da Cipa',
  `efetivos` int(11) NOT NULL COMMENT 'Número de Efetivos',
  `suplentes` int(11) NOT NULL COMMENT 'Número de Suplentes',
  `edital` blob NOT NULL COMMENT 'Edital da Cipa para este ano de vtação',
  `inicio_candidatura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data do inicio das candidaturas',
  `fim_candidatura` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data para o fim da candidatura',
  `inicio_votacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data que seram iniciada as votações pelos usuários',
  `fim_votacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data que seram finalizadas as votações pelos usuários'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cipa`
--
ALTER TABLE `cipa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cipa`
--
ALTER TABLE `cipa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da Cipa';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
