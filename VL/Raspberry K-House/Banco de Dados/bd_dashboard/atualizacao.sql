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
-- Estrutura da tabela `atualizacao`
--

CREATE TABLE `atualizacao` (
  `id` int(11) NOT NULL,
  `data_atualizacao` varchar(20) DEFAULT NULL,
  `hora_atualizacao` varchar(20) DEFAULT NULL,
  `ponto` varchar(30) DEFAULT NULL,
  `condicao` varchar(30) DEFAULT NULL,
  `data_atualizacao2` varchar(20) DEFAULT NULL,
  `hora_atualizacao2` varchar(20) DEFAULT NULL,
  `numero_antenas` varchar(10) DEFAULT NULL,
  `antena0` varchar(10) DEFAULT NULL,
  `antena1` varchar(10) DEFAULT NULL,
  `antena2` varchar(10) DEFAULT NULL,
  `antena3` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atualizacao`
--

INSERT INTO `atualizacao` (`id`, `data_atualizacao`, `hora_atualizacao`, `ponto`, `condicao`, `data_atualizacao2`, `hora_atualizacao2`, `numero_antenas`, `antena0`, `antena1`, `antena2`, `antena3`) VALUES
(1, '09/07/2022', '18:45:21', 'Entrada CO', 'OK', '09/07/2022', '18:43:53', '2', 'OK', 'Erro', '-', '-'),
(2, '01/12/2021', '12:00:00', 'Entrada BH', 'Erro', '09/07/2022', '18:43:53', '2', 'Erro', 'Erro', '-', '-'),
(3, '09/07/2022', '18:45:54', 'Controle 1', 'OK', '09/07/2022', '18:43:53', '2', 'OK', 'OK', '-', '-'),
(4, '09/07/2022', '18:46:01', 'Controle 2', 'OK', '09/07/2022', '18:43:53', '2', 'OK', 'OK', '-', '-'),
(5, '09/07/2022', '18:43:23', 'Controle 3', 'OK', '09/07/2022', '18:43:53', '2', 'OK', 'OK', '-', '-'),
(6, '01/12/2021', '12:00:00', 'Balanca 1', 'Erro', '09/07/2022', '18:43:53', '1', 'Erro', '-', '-', '-'),
(7, '01/12/2021', '12:00:00', 'Balanca 2', 'Erro', '09/07/2022', '18:43:53', '1', 'Erro', '-', '-', '-'),
(8, '01/12/2021', '12:00:00', 'Balanca 3', 'Erro', '09/07/2022', '18:43:53', '1', 'Erro', '-', '-', '-'),
(9, '04/07/2022', '08:55:52', 'Excesso', 'Erro', '09/07/2022', '18:43:53', '1', 'OK', '-', '-', '-'),
(10, '01/12/2021', '12:00:00', 'Amostragem', 'Erro', '09/07/2022', '18:43:53', '1', 'Erro', '-', '-', '-'),
(11, '09/07/2022', '18:45:55', 'Saida CO', 'OK', '09/07/2022', '18:43:53', '2', 'OK', 'OK', '-', '-'),
(12, '01/12/2021', '12:00:00', 'Saida BH', 'Erro', '09/07/2022', '18:43:53', '2', 'Erro', 'Erro', '-', '-'),
(13, '09/07/2022', '18:46:04', 'Dashboard', 'OK', '09/07/2022', '18:43:53', '75', 'Erro', 'Erro', '-', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atualizacao`
--
ALTER TABLE `atualizacao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atualizacao`
--
ALTER TABLE `atualizacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
