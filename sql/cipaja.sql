-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23-Out-2017 às 02:55
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id`, `usuario_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidatura`
--

CREATE TABLE `candidatura` (
  `id` int(11) NOT NULL COMMENT 'Chave primária das candidaturas',
  `status` varchar(1) DEFAULT NULL COMMENT 'Null = ainda não foi aprovada ou negada pelo administrador | A = Candidatura aprovada | N = Candidatura negada',
  `usuario_id` int(11) NOT NULL COMMENT 'referencia de usuario.id',
  `cipa_id` int(11) NOT NULL COMMENT 'Referencia de cipa.id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de candidaturas, onde o administrador aprova ou nega';

-- --------------------------------------------------------

--
-- Estrutura da tabela `cipa`
--

CREATE TABLE `cipa` (
  `id` int(11) NOT NULL COMMENT 'Chave primária da Cipa',
  `efetivos` int(11) NOT NULL COMMENT 'Número de Efetivos',
  `suplentes` int(11) NOT NULL COMMENT 'Número de Suplentes',
  `edital` varchar(255) NOT NULL COMMENT 'Edital da Cipa para este ano de vtação',
  `inicio_candidatura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data do inicio das candidaturas',
  `fim_candidatura` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data para o fim da candidatura',
  `inicio_votacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data que seram iniciada as votações pelos usuários',
  `fim_votacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data que seram finalizadas as votações pelos usuários'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cipa`
--

INSERT INTO `cipa` (`id`, `efetivos`, `suplentes`, `edital`, `inicio_candidatura`, `fim_candidatura`, `inicio_votacao`, `fim_votacao`) VALUES
(6, 0, 0, 'eea11f480e16285deb0e5a03cd853d7f', '2017-10-04 03:00:00', '2017-10-19 02:00:00', '2017-11-01 02:00:00', '2017-11-09 02:00:00'),
(9, 0, 0, '076b20c70fb7e5de3576c77a607495f6', '2017-10-01 03:00:00', '2017-10-04 03:00:00', '2017-10-01 03:00:00', '2017-10-03 03:00:00'),
(10, 0, 0, '83c5cf5c141a6477fd73efb526946ee0', '2017-10-04 03:00:00', '2017-10-26 02:00:00', '2017-09-01 03:00:00', '2017-09-28 03:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `matricula` varchar(40) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `matricula`, `nome`, `senha`) VALUES
(1, '100', 'Conde', 'f899139df5e1059396431415e770c6dd'),
(2, '200', 'José', '3644a684f98ea8fe223c713b77189a77');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidatura`
--
ALTER TABLE `candidatura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `cipa_id` (`cipa_id`);

--
-- Indexes for table `cipa`
--
ALTER TABLE `cipa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `candidatura`
--
ALTER TABLE `candidatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária das candidaturas';
--
-- AUTO_INCREMENT for table `cipa`
--
ALTER TABLE `cipa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da Cipa', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
