-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Nov-2022 às 16:41
-- Versão do servidor: 10.3.25-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_leitura`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `leitura_balanca01_patrag`
--

CREATE TABLE `leitura_balanca01_patrag` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `leitura_balanca01_patrag`
--

INSERT INTO `leitura_balanca01_patrag` (`id`, `nome`) VALUES
(1, 'adasdasdafsdfdsfs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leitura_balanca01_patrag`
--
ALTER TABLE `leitura_balanca01_patrag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leitura_balanca01_patrag`
--
ALTER TABLE `leitura_balanca01_patrag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
