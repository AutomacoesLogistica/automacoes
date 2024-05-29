-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 07-Jan-2023 às 08:55
-- Versão do servidor: 10.3.36-MariaDB-0+deb10u2
-- PHP Version: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_dashboard`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `validacoes_tags_tora_fjx`
--

CREATE TABLE `validacoes_tags_tora_fjx` (
  `id` int(11) NOT NULL,
  `placa_ou_tag` varchar(30) DEFAULT NULL,
  `validado` varchar(20) DEFAULT NULL,
  `data_validacao` varchar(12) DEFAULT NULL,
  `hora_validacao` varchar(12) DEFAULT NULL,
  `sigla` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `validacoes_tags_tora_fjx`
--
ALTER TABLE `validacoes_tags_tora_fjx`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `validacoes_tags_tora_fjx`
--
ALTER TABLE `validacoes_tags_tora_fjx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
