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
-- Estrutura da tabela `mes`
--

CREATE TABLE `mes` (
  `id` int(11) NOT NULL,
  `nome_mes` varchar(30) NOT NULL,
  `valor_mes` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mes`
--

INSERT INTO `mes` (`id`, `nome_mes`, `valor_mes`) VALUES
(1, 'Janeiro', '01'),
(2, 'Fevereiro', '02'),
(3, 'Março', '03'),
(4, 'Abril', '04'),
(5, 'Maio', '05'),
(6, 'Junho', '06'),
(7, 'Julho', '07'),
(8, 'Agosto', '08'),
(9, 'Setembro', '09'),
(10, 'Outubro', '10'),
(11, 'Novembro', '11'),
(12, 'Dezembro', '12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mes`
--
ALTER TABLE `mes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mes`
--
ALTER TABLE `mes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
