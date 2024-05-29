-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 29-Maio-2023 às 15:10
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
-- Estrutura da tabela `historico_complemento`
--

CREATE TABLE `historico_complemento` (
  `id` int(11) NOT NULL,
  `id_historico` varchar(10) DEFAULT NULL,
  `num_gagf` varchar(30) DEFAULT NULL,
  `num_gscs` varchar(30) DEFAULT NULL,
  `num_GAGF_Filho` varchar(20) DEFAULT NULL,
  `num_GSCS_Filho` varchar(20) DEFAULT NULL,
  `nomination` varchar(20) DEFAULT NULL,
  `origem` varchar(100) DEFAULT NULL,
  `destino` varchar(100) DEFAULT NULL,
  `material` varchar(100) DEFAULT NULL,
  `estoque` varchar(100) DEFAULT NULL,
  `peso_bruto` varchar(20) DEFAULT NULL,
  `tara` varchar(20) DEFAULT NULL,
  `peso_liquido` varchar(20) DEFAULT NULL,
  `ttp_entrada_a_saida` varchar(20) DEFAULT NULL,
  `ttp_ca_a_saida` varchar(20) DEFAULT NULL,
  `turno` varchar(20) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historico_complemento`
--
ALTER TABLE `historico_complemento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historico_complemento`
--
ALTER TABLE `historico_complemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
