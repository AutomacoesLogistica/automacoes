-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 29-Nov-2021 às 12:10
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_gagf`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_ips`
--

CREATE TABLE `lista_ips` (
  `id` int(11) NOT NULL,
  `nome_dispositivo` varchar(50) NOT NULL,
  `ip_dispositivo` varchar(15) NOT NULL,
  `gateway_dispositivo` varchar(15) NOT NULL,
  `ip_externo` varchar(15) DEFAULT NULL,
  `porta_externa` varchar(5) DEFAULT NULL,
  `porta_interna` varchar(5) DEFAULT NULL,
  `rede_usada` int(11) NOT NULL,
  `tipo_dispositivo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_ips`
--

INSERT INTO `lista_ips` (`id`, `nome_dispositivo`, `ip_dispositivo`, `gateway_dispositivo`, `ip_externo`, `porta_externa`, `porta_interna`, `rede_usada`, `tipo_dispositivo`) VALUES
(1, 'Raspberry', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(2, 'a', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(3, 'a', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(4, 'a', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(5, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(6, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(7, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(8, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(9, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(10, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(11, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(12, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(13, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(14, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(15, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(16, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(17, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(18, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(19, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(20, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(21, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(22, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(23, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(24, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(25, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(26, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(27, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(28, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(29, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(30, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(31, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(32, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(33, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(34, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(35, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(36, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(37, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(38, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(39, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(40, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(41, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(42, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(43, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(44, 'b', '192.168.2.200', '', NULL, NULL, NULL, 0, ''),
(45, 'c', '192.168.2.220', '', NULL, NULL, NULL, 0, ''),
(46, 'v', '43434', '', NULL, NULL, NULL, 0, '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_ips`
--
ALTER TABLE `lista_ips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_ips`
--
ALTER TABLE `lista_ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
