-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 20/05/2023 às 16:37
-- Versão do servidor: 8.0.33-0ubuntu0.22.04.2
-- Versão do PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_herculano`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `INTEGRACAO_GERDAU_HM`
--

CREATE TABLE `INTEGRACAO_GERDAU_HM` (
  `id` int NOT NULL,
  `nome_motorista` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `origem` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `destino` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `material` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_gagf` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_gscs` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numero_ticket` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomination` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `peso_liquido` varchar(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `placa_cavalo` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `placa_carreta` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_saida_origem` varchar(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hora_saida_origem` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_primeira_pesagem` varchar(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hora_primeira_pesagem` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_segunda_pesagem` varchar(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hora_segunda_pesagem` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_processo` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `processado` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `INTEGRACAO_GERDAU_HM`
--
ALTER TABLE `INTEGRACAO_GERDAU_HM`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `INTEGRACAO_GERDAU_HM`
--
ALTER TABLE `INTEGRACAO_GERDAU_HM`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
