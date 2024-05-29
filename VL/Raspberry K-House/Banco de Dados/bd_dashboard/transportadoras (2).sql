-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 29-Out-2022 às 11:50
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
-- Estrutura da tabela `transportadoras`
--

CREATE TABLE `transportadoras` (
  `id` int(11) NOT NULL,
  `sigla` varchar(30) NOT NULL,
  `nome` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transportadoras`
--

INSERT INTO `transportadoras` (`id`, `sigla`, `nome`) VALUES
(1, 'BVC', 'BVC TRANSPORTES LTDA'),
(2, 'LL', 'L L TRANSPORTES LTDA'),
(3, 'D\' Paula', 'DE PAULA TRANSPORTADORA LTDA'),
(4, 'Tora', 'TORA TRANSPORTES LTDA'),
(5, 'Silvano', 'SILVANO SANTOS DA ROCHA EIRELI'),
(6, 'Terra Minas', 'TERRA MINAS TERRAPLENAGEM MATIAS BA LTDA'),
(7, 'Vitran', 'VITRAN TRANSPORTES LTDA'),
(8, 'Cooperauto', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA'),
(9, 'Cotracargem', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA'),
(10, 'TSL', 'TRANSPORTES SARZEDO LTDA'),
(11, 'RLR', 'RLR TRANSPORTES LTDA'),
(12, 'Rodeiro', 'EMPREENDIMENTOS RODEIRO SA'),
(13, 'Rodoanel', 'RODOANEL TRANSPORTES E LOGISTICA LT DA'),
(14, 'FJX', 'FJX TRANSPORTES LTDA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transportadoras`
--
ALTER TABLE `transportadoras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
