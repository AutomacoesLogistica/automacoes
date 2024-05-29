-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 09-Jul-2022 às 18:46
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
-- Estrutura da tabela `encerramentos`
--

CREATE TABLE `encerramentos` (
  `id` int(11) NOT NULL,
  `mes` varchar(20) DEFAULT NULL,
  `quantidade_job` varchar(10) DEFAULT NULL,
  `quantidade_antena` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `encerramentos`
--

INSERT INTO `encerramentos` (`id`, `mes`, `quantidade_job`, `quantidade_antena`) VALUES
(1, '01', '00', '0'),
(2, '02', '00', '0'),
(3, '03', '82', '20'),
(4, '04', '7015', '194'),
(5, '05', '2973', '8118'),
(6, '06', '1028', '8549'),
(7, '07', '148', '1688'),
(8, '08', '00', '0'),
(9, '09', '00', '0'),
(10, '10', '00', '0'),
(11, '11', '00', '0'),
(12, '12', '00', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encerramentos`
--
ALTER TABLE `encerramentos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encerramentos`
--
ALTER TABLE `encerramentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
