-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Out-2022 às 16:22
-- Versão do servidor: 10.3.34-MariaDB-0+deb10u1
-- PHP Version: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_sva`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `leituras_pendentes`
--

CREATE TABLE `leituras_pendentes` (
  `id` int(11) NOT NULL,
  `epc` varchar(30) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `gagf` varchar(30) DEFAULT NULL,
  `gscs` varchar(30) DEFAULT NULL,
  `nomination` varchar(30) DEFAULT NULL,
  `material` varchar(200) DEFAULT NULL,
  `liquido` varchar(10) DEFAULT NULL,
  `resumo_transportadora` varchar(200) DEFAULT NULL,
  `condicao` varchar(20) DEFAULT NULL,
  `tratado` varchar(10) DEFAULT NULL,
  `data_atualizacao` varchar(20) DEFAULT NULL,
  `hora_atualizacao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leituras_pendentes`
--
ALTER TABLE `leituras_pendentes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leituras_pendentes`
--
ALTER TABLE `leituras_pendentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
