-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 07-Jan-2023 às 08:54
-- Versão do servidor: 10.3.36-MariaDB-0+deb10u2
-- PHP Version: 7.3.31-1~deb10u1

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
-- Estrutura da tabela `atualizacao_services`
--

CREATE TABLE `atualizacao_services` (
  `id` int(11) NOT NULL,
  `nome_service` varchar(100) DEFAULT NULL,
  `data_atualizacao` varchar(12) DEFAULT NULL,
  `hora_atualizacao` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atualizacao_services`
--

INSERT INTO `atualizacao_services` (`id`, `nome_service`, `data_atualizacao`, `hora_atualizacao`) VALUES
(1, 'verifica_tag_tora_ou_fjx.service', '07/01/2023', '08:54:30'),
(2, 'publica_tora.service', '07/01/2023', '08:54:30'),
(3, 'servidor_socket_balanca2.service', '27/12/2022', '08:00:00'),
(4, 'sincroniza_socket_balanca1.service', '27/12/2022', '08:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atualizacao_services`
--
ALTER TABLE `atualizacao_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atualizacao_services`
--
ALTER TABLE `atualizacao_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
