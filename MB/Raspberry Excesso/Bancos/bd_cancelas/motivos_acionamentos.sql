-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Nov-2022 às 16:36
-- Versão do servidor: 10.3.25-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_cancelas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `motivos_acionamentos`
--

CREATE TABLE `motivos_acionamentos` (
  `id` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `motivos_acionamentos`
--

INSERT INTO `motivos_acionamentos` (`id`, `motivo`) VALUES
(2, 'Material contaminado do pátio de produto '),
(3, 'Motorista com viagem errada.'),
(4, 'Motorista teve que trocar o cavalo por causa de problema mecânico '),
(5, 'Pipa da Fagundes umidificando a via '),
(6, 'Problema com o TAG do cavalo ou carreta '),
(7, 'Processo foi aberto manual em Várzea do Lopes'),
(8, 'Processo foi finalizado mais a carreta teve que sair por causa de problema mecânico '),
(9, 'Processo foi finalizado de forma manual '),
(10, 'Problemas no GAGF'),
(12, 'Manter cancela aberta'),
(13, 'Retirar condição de manter aberta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `motivos_acionamentos`
--
ALTER TABLE `motivos_acionamentos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `motivos_acionamentos`
--
ALTER TABLE `motivos_acionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
