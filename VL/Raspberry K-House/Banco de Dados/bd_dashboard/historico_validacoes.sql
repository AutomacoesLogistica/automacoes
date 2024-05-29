-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 31-Out-2022 às 14:26
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
-- Estrutura da tabela `historico_validacoes`
--

CREATE TABLE `historico_validacoes` (
  `id` int(11) NOT NULL,
  `placa_ou_tag` varchar(30) DEFAULT NULL,
  `validado` varchar(5) DEFAULT NULL,
  `data_validacao` varchar(12) DEFAULT NULL,
  `hora_validacao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `historico_validacoes`
--

INSERT INTO `historico_validacoes` (`id`, `placa_ou_tag`, `validado`, `data_validacao`, `hora_validacao`) VALUES
(99, '442002000000000000001945', 'Sim', '31/10/2022', '13:33:28'),
(100, '442002000000000000001541', 'Sim', '31/10/2022', '13:44:20'),
(101, '442002000000000000001493', 'Sim', '31/10/2022', '13:46:27'),
(102, '442002000000000000001898', 'Sim', '31/10/2022', '13:54:54'),
(103, '442002000000000000001888', 'Sim', '31/10/2022', '13:57:26'),
(104, '442002000000000000001390', 'Sim', '31/10/2022', '14:02:13'),
(105, '442002000000000000001862', 'Sim', '31/10/2022', '14:11:00'),
(106, '442002000000000000001722', 'Sim', '31/10/2022', '14:14:12'),
(107, '442002000000000000001547', 'Sim', '31/10/2022', '14:15:23'),
(108, '442002000000000000001925', 'Sim', '31/10/2022', '14:18:20'),
(109, '442002000000000000001388', 'Sim', '31/10/2022', '14:24:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historico_validacoes`
--
ALTER TABLE `historico_validacoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historico_validacoes`
--
ALTER TABLE `historico_validacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
