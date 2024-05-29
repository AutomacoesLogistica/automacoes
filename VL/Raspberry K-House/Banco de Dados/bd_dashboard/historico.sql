-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 09-Jul-2022 às 18:47
-- Versão do servidor: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 7.3.27-1~deb10u1

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
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `epc_cavalo` varchar(24) DEFAULT NULL,
  `epc_carreta` varchar(24) DEFAULT NULL,
  `placa_cavalo` varchar(24) DEFAULT NULL,
  `placa_carreta` varchar(24) DEFAULT NULL,
  `turno` varchar(20) DEFAULT NULL,
  `v_status` varchar(20) DEFAULT NULL,
  `encerrado_por` varchar(20) DEFAULT NULL,
  `valor_ponto` varchar(20) DEFAULT NULL,
  `ponto1` varchar(30) DEFAULT NULL,
  `data_leitura1` varchar(20) DEFAULT NULL,
  `hora_leitura1` varchar(20) DEFAULT NULL,
  `ponto2` varchar(30) DEFAULT NULL,
  `data_leitura2` varchar(20) DEFAULT NULL,
  `hora_leitura2` varchar(20) DEFAULT NULL,
  `ponto3` varchar(30) DEFAULT NULL,
  `data_leitura3` varchar(20) DEFAULT NULL,
  `hora_leitura3` varchar(20) DEFAULT NULL,
  `ponto4` varchar(30) DEFAULT NULL,
  `data_leitura4` varchar(20) DEFAULT NULL,
  `hora_leitura4` varchar(20) DEFAULT NULL,
  `ponto5` varchar(30) DEFAULT NULL,
  `data_leitura5` varchar(20) DEFAULT NULL,
  `hora_leitura5` varchar(20) DEFAULT NULL,
  `ponto6` varchar(30) DEFAULT NULL,
  `data_leitura6` varchar(20) DEFAULT NULL,
  `hora_leitura6` varchar(20) DEFAULT NULL,
  `ponto7` varchar(30) DEFAULT NULL,
  `data_leitura7` varchar(20) DEFAULT NULL,
  `hora_leitura7` varchar(20) DEFAULT NULL,
  `ponto8` varchar(30) DEFAULT NULL,
  `data_leitura8` varchar(20) DEFAULT NULL,
  `hora_leitura8` varchar(20) DEFAULT NULL,
  `ponto9` varchar(30) DEFAULT NULL,
  `data_leitura9` varchar(20) DEFAULT NULL,
  `hora_leitura9` varchar(20) DEFAULT NULL,
  `ponto10` varchar(30) DEFAULT NULL,
  `data_leitura10` varchar(20) DEFAULT NULL,
  `hora_leitura10` varchar(20) DEFAULT NULL,
  `ponto11` varchar(30) DEFAULT NULL,
  `data_leitura11` varchar(20) DEFAULT NULL,
  `hora_leitura11` varchar(20) DEFAULT NULL,
  `ponto12` varchar(30) DEFAULT NULL,
  `data_leitura12` varchar(20) DEFAULT NULL,
  `hora_leitura12` varchar(20) DEFAULT NULL,
  `ponto13` varchar(30) DEFAULT NULL,
  `data_leitura13` varchar(20) DEFAULT NULL,
  `hora_leitura13` varchar(20) DEFAULT NULL,
  `ponto14` varchar(30) DEFAULT NULL,
  `data_leitura14` varchar(20) DEFAULT NULL,
  `hora_leitura14` varchar(20) DEFAULT NULL,
  `ponto15` varchar(30) DEFAULT NULL,
  `data_leitura15` varchar(20) DEFAULT NULL,
  `hora_leitura15` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
