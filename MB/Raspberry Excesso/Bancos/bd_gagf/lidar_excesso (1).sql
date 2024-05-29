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
-- Estrutura da tabela `lidar_excesso`
--

CREATE TABLE `lidar_excesso` (
  `id` int(11) NOT NULL,
  `id_lidar` varchar(10) DEFAULT NULL,
  `id_cheio_vazio` varchar(10) DEFAULT NULL,
  `id_historico` varchar(10) DEFAULT NULL,
  `epc_lidar` varchar(30) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `veiculo` varchar(20) DEFAULT NULL,
  `data_leitura` varchar(20) DEFAULT NULL,
  `dia` varchar(10) DEFAULT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `ano` varchar(5) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL,
  `confirmacao` varchar(20) DEFAULT NULL,
  `tempo_confirmacao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lidar_excesso`
--
ALTER TABLE `lidar_excesso`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lidar_excesso`
--
ALTER TABLE `lidar_excesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
