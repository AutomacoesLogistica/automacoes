-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 29-Nov-2021 às 12:12
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
-- Estrutura da tabela `lista_tipo_cavalo`
--

CREATE TABLE `lista_tipo_cavalo` (
  `id` int(11) NOT NULL,
  `tipo_cavalo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_tipo_cavalo`
--

INSERT INTO `lista_tipo_cavalo` (`id`, `tipo_cavalo`) VALUES
(1, 'CAVALO MECÂNICO SIMPLES - 2 EIXOS'),
(2, 'CAVALO MECÂNICO TRAÇADO - 3 EIXOS'),
(3, 'CAVALO MECÂNICO TRUCADO - 3 EIXOS');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_tipo_cavalo`
--
ALTER TABLE `lista_tipo_cavalo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_tipo_cavalo`
--
ALTER TABLE `lista_tipo_cavalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;