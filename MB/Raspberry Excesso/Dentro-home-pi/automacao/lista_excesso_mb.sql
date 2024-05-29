-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 28-Out-2020 às 14:56
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
-- Estrutura da tabela `lista_excesso_mb`
--

CREATE TABLE `lista_excesso_mb` (
  `id` int(11) NOT NULL,
  `epc` varchar(24) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `data` varchar(10) NOT NULL,
  `mes` varchar(2) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `ca` varchar(10) NOT NULL,
  `turno` varchar(2) NOT NULL,
  `operador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_excesso_mb`
--

INSERT INTO `lista_excesso_mb` (`id`, `epc`, `placa`, `data`, `mes`, `ano`, `hora`, `uf`, `local_instalacao`, `ca`, `turno`, `operador`) VALUES
(4, '442002000000000000000020', '-', '28/10/2020', '10', '2020', '14:51:49', 'XX', 'Miguel Burnier', 'KA16005925', 'D', 'Nao definido'),
(5, '442002000000000000000878', '-', '28/10/2020', '10', '2020', '14:51:54', 'XX', 'Miguel Burnier', 'KA16005925', 'D', 'Nao definido'),
(6, '442002000000000000000837', '-', '28/10/2020', '10', '2020', '14:52:08', 'XX', 'Miguel Burnier', 'KA16005925', 'D', 'Nao definido');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lista_excesso_mb`
--
ALTER TABLE `lista_excesso_mb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lista_excesso_mb`
--
ALTER TABLE `lista_excesso_mb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
