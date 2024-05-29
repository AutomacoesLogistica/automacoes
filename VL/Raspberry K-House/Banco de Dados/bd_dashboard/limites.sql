-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 09-Jul-2022 às 18:49
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
-- Estrutura da tabela `limites`
--

CREATE TABLE `limites` (
  `id` int(11) NOT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `limite_em_minutos` varchar(20) DEFAULT NULL,
  `veiculos` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `limites`
--

INSERT INTO `limites` (`id`, `referencia`, `limite_em_minutos`, `veiculos`) VALUES
(1, 'entradas', '10.2', '20'),
(2, 'controles', '40.4', '35'),
(3, 'excesso', '12.3', '6'),
(4, 'estoques', '25.5', '15'),
(5, 'amostragem', '10.8', '5'),
(6, 'balancas', '11.2', '8'),
(7, 'saidas', '50.4', '40'),
(8, 'saida_co', '11', '40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `limites`
--
ALTER TABLE `limites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `limites`
--
ALTER TABLE `limites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
