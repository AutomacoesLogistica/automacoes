-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 29-Nov-2021 às 12:11
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_gagf`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_tipo_carreta`
--

CREATE TABLE `lista_tipo_carreta` (
  `id` int(11) NOT NULL,
  `tipo_carreta` varchar(100) NOT NULL,
  `tipo_carreta_2` varchar(100) NOT NULL,
  `capacidade` varchar(5) NOT NULL,
  `capacidade_tonelada` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_tipo_carreta`
--

INSERT INTO `lista_tipo_carreta` (`id`, `tipo_carreta`, `tipo_carreta_2`, `capacidade`, `capacidade_tonelada`) VALUES
(1, 'BI-TRUCK - 4 EIXOS', 'BI-TRUCK-4EIXOS-29T', '29000', '29.0'),
(2, 'CENTOPEIA', 'CAMINHAO CENTOPEIA 8X4', 'xx', '0'),
(3, 'SEMIREBOQUE SIMPLES ', 'CARRETA-5EIXOS-41,5T', '41500', '41.5'),
(4, 'TRAÇADO', '', 'xx', '0'),
(5, 'TRUCADO', 'CARRETA TRUCADA-6EIXOS-16M-45T', '45000', '45.0'),
(6, 'TESTES', 'TAG Testes', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_tipo_carreta`
--
ALTER TABLE `lista_tipo_carreta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_tipo_carreta`
--
ALTER TABLE `lista_tipo_carreta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
