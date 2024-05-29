-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 20/05/2023 às 16:35
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
-- Banco de dados: `bd_ca_vln_ld`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alerta_antenas`
--

CREATE TABLE `alerta_antenas` (
  `id` int NOT NULL,
  `antena` varchar(1) NOT NULL,
  `local` varchar(50) NOT NULL,
  `tratado` varchar(3) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora_leitura` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alerta_tags`
--

CREATE TABLE `alerta_tags` (
  `id` int NOT NULL,
  `epc` varchar(24) NOT NULL,
  `faltou` varchar(200) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora_leitura` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura para tabela `atualizacao`
--

CREATE TABLE `atualizacao` (
  `id` int NOT NULL,
  `data_atualizacao` varchar(10) NOT NULL,
  `hora_atualizacao` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_leituras`
--

CREATE TABLE `historico_leituras` (
  `id` int NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `epc` varchar(24) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora_leitura` varchar(8) NOT NULL,
  `antena` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_match`
--

CREATE TABLE `historico_match` (
  `id` int NOT NULL,
  `epc_cavalo` varchar(24) DEFAULT NULL,
  `placa_cavalo` varchar(12) DEFAULT NULL,
  `epc_carreta` varchar(24) DEFAULT NULL,
  `placa_carreta` varchar(12) DEFAULT NULL,
  `ponto` varchar(50) DEFAULT NULL,
  `tratado` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_socket`
--

CREATE TABLE `historico_socket` (
  `id` int NOT NULL,
  `epc` varchar(30) DEFAULT NULL,
  `antena` varchar(2) DEFAULT NULL,
  `ponto` varchar(20) DEFAULT NULL,
  `ca` varchar(10) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `mac` varchar(20) DEFAULT NULL,
  `hostname` varchar(20) DEFAULT NULL,
  `nomeReader` varchar(50) DEFAULT NULL,
  `data_atualizacao` varchar(20) DEFAULT NULL,
  `hora_atualizacao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_tags`
--

CREATE TABLE `lista_tags` (
  `id` int NOT NULL,
  `placa` varchar(15) NOT NULL,
  `estado` varchar(3) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `parte` varchar(20) NOT NULL,
  `tag` varchar(30) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cod_sap` varchar(15) NOT NULL,
  `link` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_referencia`
--

CREATE TABLE `tabela_referencia` (
  `id` int NOT NULL,
  `placa` varchar(10) DEFAULT NULL,
  `tag` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `tabela_referencia`
--

INSERT INTO `tabela_referencia` (`id`, `placa`, `tag`) VALUES
(1, 'OQE5292', '442002000000000000001494'),
(2, 'RNM3E16', '442002000000000000001726'),
(3, 'RUC1G31', '442002000000000000001641'),
(4, 'RMU2I40', '442002000000000000001522'),
(5, 'RNG2D63', '442002000000000000001947'),
(6, 'RMS7F48', '442002000000000000001918'),
(7, 'RMT9G39', '442002000000000000001632'),
(8, 'RFM8G32', '442002000000000000001636'),
(9, 'RMW4A18', '442002000000000000001491'),
(10, 'RUC1G24', '442002000000000000001839'),
(11, 'RFD7F57', '442002000000000000001449'),
(12, 'RFF4A07', '442002000000000000001695'),
(13, 'RMU2H84', '442002000000000000001518'),
(14, 'RNM3E17', '442002000000000000001727'),
(15, 'RMU2H65', '442002000000000000001643'),
(16, 'RMO5D02', '442002000000000000001524'),
(17, 'RTQ2E46', '442002000000000000001529'),
(18, 'RNG2D52', '442002000000000000001909'),
(19, 'RNG2D59', '442002000000000000001911'),
(20, 'RNH3E00', '442002000000000000001960'),
(21, 'RUQ2E03', '442002000000000000001445'),
(22, 'RUQ2E12', '442002000000000000001496'),
(23, 'RMP4B07', '442002000000000000001519'),
(24, 'RNH1J75', '442002000000000000001948'),
(25, 'RNG2D69', '442002000000000000001904'),
(26, 'RMO5C98', '442002000000000000001536'),
(27, 'RFD7F66', '442002000000000000001430'),
(28, 'RNI3G96', '442002000000000000001962'),
(29, 'RMO6J83', '442002000000000000001631'),
(30, 'RUC1G29', '442002000000000000001731'),
(31, 'RUJ4B76', '442002000000000000001526'),
(32, 'RMX0G96', '442002000000000000001637'),
(33, 'RUC1G27', '442002000000000000001720'),
(34, 'RNM3A57', '442002000000000000001961'),
(35, 'RUB8G98', '442002000000000000001753'),
(36, 'RNG2D72', '442002000000000000001910'),
(37, 'RUP8B50', '442002000000000000001532'),
(38, 'RUP8B63', '442002000000000000001534'),
(39, 'RUE4J35', '442002000000000000001418'),
(40, 'RNH3D60', '442002000000000000001612'),
(41, 'RUE4J38', '442002000000000000001525'),
(42, 'RUQ2E08', '442002000000000000001539'),
(43, 'RMO5D00', '442002000000000000001630'),
(44, 'RFM8G43', '442002000000000000001537'),
(45, 'RFM8G39', '442002000000000000001533'),
(46, 'RUU7F10', '442002000000000000001528'),
(47, 'RVF8F02', '442002000000000000001642'),
(48, 'RUQ2E06', '442002000000000000001527'),
(49, 'RFM8G49', '442002000000000000001639'),
(50, 'RFM8G58', '442002000000000000001914'),
(51, 'RFM8G47', '442002000000000000001624'),
(52, 'RVE5A94', '442002000000000000001913'),
(53, 'RVE5A92', '442002000000000000001783'),
(54, 'RVF8F03', '442002000000000000001633'),
(55, 'RUJ4B79', '442002000000000000001535'),
(56, 'RFM8G55', '442002000000000000001498');

-- --------------------------------------------------------

--
-- Estrutura para tabela `validacoes_socket`
--

CREATE TABLE `validacoes_socket` (
  `id` int NOT NULL,
  `epc_carreta` varchar(30) DEFAULT NULL,
  `antena` varchar(2) DEFAULT NULL,
  `ponto` varchar(30) DEFAULT NULL,
  `data_leitura` varchar(20) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=COMPACT;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alerta_antenas`
--
ALTER TABLE `alerta_antenas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `alerta_tags`
--
ALTER TABLE `alerta_tags`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `atualizacao`
--
ALTER TABLE `atualizacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico_leituras`
--
ALTER TABLE `historico_leituras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico_match`
--
ALTER TABLE `historico_match`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico_socket`
--
ALTER TABLE `historico_socket`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lista_tags`
--
ALTER TABLE `lista_tags`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tabela_referencia`
--
ALTER TABLE `tabela_referencia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `validacoes_socket`
--
ALTER TABLE `validacoes_socket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alerta_antenas`
--
ALTER TABLE `alerta_antenas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `alerta_tags`
--
ALTER TABLE `alerta_tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atualizacao`
--
ALTER TABLE `atualizacao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historico_leituras`
--
ALTER TABLE `historico_leituras`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_match`
--
ALTER TABLE `historico_match`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3394;

--
-- AUTO_INCREMENT de tabela `historico_socket`
--
ALTER TABLE `historico_socket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lista_tags`
--
ALTER TABLE `lista_tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1716;

--
-- AUTO_INCREMENT de tabela `tabela_referencia`
--
ALTER TABLE `tabela_referencia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `validacoes_socket`
--
ALTER TABLE `validacoes_socket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
