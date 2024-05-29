-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Nov-2022 às 16:39
-- Versão do servidor: 10.3.25-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

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
  `placa` varchar(15) NOT NULL,
  `sigla` varchar(30) NOT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
