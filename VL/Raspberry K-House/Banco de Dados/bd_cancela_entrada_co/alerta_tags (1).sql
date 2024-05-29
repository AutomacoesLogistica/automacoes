-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 27-Out-2022 às 15:08
-- Versão do servidor: 10.3.36-MariaDB-0+deb10u2
-- PHP Version: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_cancela_entrada_co`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alerta_tags`
--

CREATE TABLE `alerta_tags` (
  `id` int(11) NOT NULL,
  `epc` varchar(24) NOT NULL,
  `faltou` varchar(200) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora_leitura` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `alerta_tags`
--

INSERT INTO `alerta_tags` (`id`, `epc`, `faltou`, `data_leitura`, `hora_leitura`) VALUES
(1, '442001000000000000001737', 'Faltando TAG do cavalo', '27/10/2022', '12:36:51'),
(2, '442001000000000000002229', 'Faltando TAG do cavalo', '27/10/2022', '12:37:05'),
(3, '442001000000000000001737', 'Faltando TAG do cavalo', '27/10/2022', '12:37:21'),
(4, '442001000000000000002229', 'Faltando TAG do cavalo', '27/10/2022', '12:37:39'),
(5, '442001000000000000001737', 'Faltando TAG do cavalo', '27/10/2022', '12:37:51'),
(6, '442001000000000000002229', 'Faltando TAG do cavalo', '27/10/2022', '12:38:08'),
(7, '442001000000000000001737', 'Faltando TAG do cavalo', '27/10/2022', '12:38:25'),
(8, '442001000000000000002229', 'Faltando TAG do cavalo', '27/10/2022', '12:38:38'),
(9, '442001000000000000001737', 'Faltando TAG do cavalo', '27/10/2022', '12:38:52'),
(10, '442001000000000000002229', 'Faltando TAG do cavalo', '27/10/2022', '12:39:06'),
(11, '442001000000000000002229', 'Faltando TAG do cavalo', '27/10/2022', '12:39:21'),
(12, '442001000000000000003019', 'Faltando TAG do cavalo', '27/10/2022', '13:46:10'),
(13, '442001000000000000003046', 'Faltando TAG do cavalo', '27/10/2022', '13:48:05'),
(14, '442001000000000000002464', 'Faltando TAG do cavalo', '27/10/2022', '13:48:20'),
(15, '442001000000000000003046', 'Faltando TAG do cavalo', '27/10/2022', '13:48:34'),
(16, '442001000000000000003046', 'Faltando TAG do cavalo', '27/10/2022', '13:48:46'),
(17, '442001000000000000002823', 'Faltando TAG do cavalo', '27/10/2022', '13:58:51'),
(18, '442001000000000000003341', 'Faltando TAG do cavalo', '27/10/2022', '14:07:39'),
(19, '442001000000000000002871', 'Faltando TAG do cavalo', '27/10/2022', '15:01:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerta_tags`
--
ALTER TABLE `alerta_tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerta_tags`
--
ALTER TABLE `alerta_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
