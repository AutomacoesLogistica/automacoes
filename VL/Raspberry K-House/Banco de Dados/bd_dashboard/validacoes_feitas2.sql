-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 31-Out-2022 às 14:25
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
-- Estrutura da tabela `validacoes_feitas2`
--

CREATE TABLE `validacoes_feitas2` (
  `id` int(11) NOT NULL,
  `placa_ou_tag` varchar(30) DEFAULT NULL,
  `validado` varchar(5) DEFAULT NULL,
  `data_validacao` varchar(12) DEFAULT NULL,
  `hora_validacao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `validacoes_feitas2`
--

INSERT INTO `validacoes_feitas2` (`id`, `placa_ou_tag`, `validado`, `data_validacao`, `hora_validacao`) VALUES
(1, '442002000000000000001500', 'Sim', '31/10/2022', '12:03:45'),
(2, '442002000000000000001352', 'Sim', '31/10/2022', '12:08:22'),
(3, '442002000000000000001604', 'Sim', '31/10/2022', '12:14:29'),
(4, '442002000000000000001372', 'Sim', '31/10/2022', '12:19:51'),
(5, '442002000000000000001703', 'Sim', '31/10/2022', '12:22:03'),
(6, '442002000000000000001867', 'Sim', '31/10/2022', '12:29:41'),
(7, '442002000000000000001885', 'Sim', '31/10/2022', '12:32:08'),
(8, '442002000000000000001441', 'Sim', '31/10/2022', '12:37:04'),
(9, '442002000000000000001439', 'Sim', '31/10/2022', '12:41:12'),
(10, '442002000000000000001902', 'Sim', '31/10/2022', '12:46:59'),
(11, '442002000000000000001876', 'Sim', '31/10/2022', '13:17:27'),
(12, '442002000000000000001879', 'Sim', '31/10/2022', '13:25:49'),
(13, '442002000000000000001504', 'Sim', '31/10/2022', '13:26:16'),
(14, '442002000000000000001945', 'Sim', '31/10/2022', '13:33:28'),
(15, '442002000000000000001541', 'Sim', '31/10/2022', '13:44:20'),
(16, '442002000000000000001493', 'Sim', '31/10/2022', '13:46:27'),
(17, '442002000000000000001898', 'Sim', '31/10/2022', '13:54:54'),
(18, '442002000000000000001888', 'Sim', '31/10/2022', '13:57:26'),
(19, '442002000000000000001390', 'Sim', '31/10/2022', '14:02:13'),
(20, '442002000000000000001862', 'Sim', '31/10/2022', '14:11:00'),
(21, '442002000000000000001722', 'Sim', '31/10/2022', '14:14:12'),
(22, '442002000000000000001547', 'Sim', '31/10/2022', '14:15:23'),
(23, '442002000000000000001925', 'Sim', '31/10/2022', '14:18:20'),
(24, '442002000000000000001388', 'Sim', '31/10/2022', '14:24:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `validacoes_feitas2`
--
ALTER TABLE `validacoes_feitas2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `validacoes_feitas2`
--
ALTER TABLE `validacoes_feitas2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
