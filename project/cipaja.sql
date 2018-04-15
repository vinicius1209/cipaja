-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Abr-2018 às 01:45
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.4

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
CREATE DATABASE IF NOT EXISTS `cipaja` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE `cipaja`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id`, `usuario_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `candidato`
--

CREATE TABLE `candidato` (
  `usuario_id` int(11) NOT NULL,
  `cipa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cipa`
--

CREATE TABLE `cipa` (
  `id` int(11) NOT NULL COMMENT 'Chave primária da Cipa',
  `edital` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Edital da Cipa para este ano de vtação',
  `inicio_candidatura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data do inicio das candidaturas',
  `fim_candidatura` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data para o fim da candidatura',
  `inicio_votacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data que seram iniciada as votações pelos usuários',
  `fim_votacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Data que seram finalizadas as votações pelos usuários',
  `faixa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cipa`
--

INSERT INTO `cipa` (`id`, `edital`, `inicio_candidatura`, `fim_candidatura`, `inicio_votacao`, `fim_votacao`, `faixa_id`) VALUES
(6, 'eea11f480e16285deb0e5a03cd853d7f', '2017-10-04 06:00:00', '2017-10-19 05:00:00', '2017-11-01 05:00:00', '2017-11-09 04:00:00', NULL),
(9, '076b20c70fb7e5de3576c77a607495f6', '2017-10-01 06:00:00', '2017-10-04 06:00:00', '2017-10-01 06:00:00', '2017-10-03 06:00:00', NULL),
(10, '83c5cf5c141a6477fd73efb526946ee0', '2017-10-04 06:00:00', '2017-10-26 05:00:00', '2017-09-01 06:00:00', '2017-09-28 06:00:00', NULL),
(12, 'teste.pdf', '2018-04-01 03:00:00', '2018-04-10 03:00:00', '2018-04-11 03:00:00', '2018-08-01 03:00:00', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `faixa`
--

CREATE TABLE `faixa` (
  `id` int(11) NOT NULL,
  `efetivos` int(11) NOT NULL,
  `suplentes` int(11) NOT NULL,
  `inicial` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `negocio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `faixa`
--

INSERT INTO `faixa` (`id`, `efetivos`, `suplentes`, `inicial`, `final`, `negocio_id`) VALUES
(1, 0, 0, 0, 19, 1),
(2, 1, 1, 20, 29, 1),
(3, 3, 3, 80, 80, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `negocio`
--

CREATE TABLE `negocio` (
  `id` int(11) NOT NULL,
  `area` varchar(100) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `negocio`
--

INSERT INTO `negocio` (`id`, `area`) VALUES
(1, 'Minerais');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `matricula` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `matricula`, `nome`, `senha`) VALUES
(1, '100', 'Conde', 'f899139df5e1059396431415e770c6dd'),
(2, '200', 'José', '3644a684f98ea8fe223c713b77189a77');

-- --------------------------------------------------------

--
-- Estrutura da tabela `voto`
--

CREATE TABLE `voto` (
  `usuario_id` int(11) NOT NULL,
  `cipa_id` int(11) NOT NULL,
  `candidato_id` int(11) DEFAULT NULL,
  `horario_voto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`usuario_id`,`cipa_id`),
  ADD KEY `fk_cipa_id1` (`cipa_id`);

--
-- Indexes for table `cipa`
--
ALTER TABLE `cipa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_faixa_id` (`faixa_id`);

--
-- Indexes for table `faixa`
--
ALTER TABLE `faixa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_negocio_id` (`negocio_id`);

--
-- Indexes for table `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`usuario_id`,`cipa_id`),
  ADD KEY `fk_cipa_id2` (`cipa_id`),
  ADD KEY `fk_candidato_id` (`candidato_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cipa`
--
ALTER TABLE `cipa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave primária da Cipa', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `faixa`
--
ALTER TABLE `faixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `negocio`
--
ALTER TABLE `negocio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `fk_cipa_id1` FOREIGN KEY (`cipa_id`) REFERENCES `cipa` (`id`),
  ADD CONSTRAINT `fk_usuario_id1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `cipa`
--
ALTER TABLE `cipa`
  ADD CONSTRAINT `fk_faixa_id` FOREIGN KEY (`faixa_id`) REFERENCES `faixa` (`id`);

--
-- Limitadores para a tabela `faixa`
--
ALTER TABLE `faixa`
  ADD CONSTRAINT `fk_negocio_id` FOREIGN KEY (`negocio_id`) REFERENCES `negocio` (`id`);

--
-- Limitadores para a tabela `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `fk_candidato_id` FOREIGN KEY (`candidato_id`) REFERENCES `candidato` (`usuario_id`),
  ADD CONSTRAINT `fk_cipa_id2` FOREIGN KEY (`cipa_id`) REFERENCES `cipa` (`id`),
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `fk_usuario_id2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
