-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 28-Out-2020 às 15:01
-- Versão do servidor: 10.3.22-MariaDB-0+deb10u1-log
-- PHP Version: 7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_gagf`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_leitura_tags_mb`
--

CREATE TABLE `lista_leitura_tags_mb` (
  `id` int(11) NOT NULL,
  `ca` varchar(10) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `epc` varchar(24) NOT NULL,
  `antena` int(11) NOT NULL,
  `funcao` varchar(60) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `localidade` varchar(2) NOT NULL,
  `operador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_leitura_tags_mb`
--

INSERT INTO `lista_leitura_tags_mb` (`id`, `ca`, `data`, `hora`, `epc`, `antena`, `funcao`, `placa`, `localidade`, `operador`) VALUES
(1, 'KA16005925', '28/10/2020', '14:51:49', '442002000000000000000020', 0, 'Excesso MB', '-', 'XX', 'Nao definido'),
(2, 'KA16005925', '28/10/2020', '14:51:54', '442002000000000000000878', 0, 'Excesso MB', '-', 'XX', 'Nao definido'),
(3, 'KA16005925', '28/10/2020', '14:52:03', '442001000000000000002239', 0, 'Excesso MB', '-', 'XX', 'Nao definido'),
(4, 'KA16005925', '28/10/2020', '14:52:08', '442002000000000000000837', 0, 'Excesso MB', '-', 'XX', 'Nao definido'),
(5, 'KA16005925', '28/10/2020', '14:52:20', '442002000000000000000020', 0, 'Excesso MB', '-', 'XX', 'Nao definido'),
(6, 'KA16005925', '28/10/2020', '14:52:24', '442002000000000000000837', 0, 'Excesso MB', '-', 'XX', 'Nao definido'),
(7, 'KA16005925', '28/10/2020', '14:52:30', '442002000000000000000878', 0, 'Excesso MB', '-', 'XX', 'Nao definido');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lista_leitura_tags_mb`
--
ALTER TABLE `lista_leitura_tags_mb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lista_leitura_tags_mb`
--
ALTER TABLE `lista_leitura_tags_mb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
