-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 10-Fev-2023 às 08:48
-- Versão do servidor: 10.6.11-MariaDB-0ubuntu0.22.04.1
-- versão do PHP: 8.1.2-1ubuntu2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_balanca1`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alerta_antenas`
--

CREATE TABLE `alerta_antenas` (
  `id` int(11) NOT NULL,
  `antena` varchar(1) NOT NULL,
  `local` varchar(50) NOT NULL,
  `tratado` varchar(3) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora_leitura` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `alerta_tags`
--

CREATE TABLE `alerta_tags` (
  `id` int(11) NOT NULL,
  `epc` varchar(24) NOT NULL,
  `faltou` varchar(200) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora_leitura` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atualizacao`
--

CREATE TABLE `atualizacao` (
  `id` int(11) NOT NULL,
  `data_atualizacao` varchar(10) NOT NULL,
  `hora_atualizacao` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_leituras`
--

CREATE TABLE `historico_leituras` (
  `id` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `epc` varchar(24) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora_leitura` varchar(8) NOT NULL,
  `antena` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_match`
--

CREATE TABLE `historico_match` (
  `id` int(11) NOT NULL,
  `epc_cavalo` varchar(24) DEFAULT NULL,
  `placa_cavalo` varchar(12) DEFAULT NULL,
  `epc_carreta` varchar(24) DEFAULT NULL,
  `placa_carreta` varchar(12) DEFAULT NULL,
  `ponto` varchar(50) DEFAULT NULL,
  `tratado` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_socket`
--

CREATE TABLE `historico_socket` (
  `id` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_tags`
--

CREATE TABLE `lista_tags` (
  `id` int(11) NOT NULL,
  `placa` varchar(15) NOT NULL,
  `estado` varchar(3) NOT NULL,
  `tipo` varchar(40) NOT NULL,
  `parte` varchar(20) NOT NULL,
  `tag` varchar(30) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cod_sap` varchar(15) NOT NULL,
  `link` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `validacoes_socket`
--

CREATE TABLE `validacoes_socket` (
  `id` int(11) NOT NULL,
  `epc_carreta` varchar(30) DEFAULT NULL,
  `antena` varchar(2) DEFAULT NULL,
  `ponto` varchar(30) DEFAULT NULL,
  `data_leitura` varchar(20) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alerta_antenas`
--
ALTER TABLE `alerta_antenas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `alerta_tags`
--
ALTER TABLE `alerta_tags`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `atualizacao`
--
ALTER TABLE `atualizacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_leituras`
--
ALTER TABLE `historico_leituras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_match`
--
ALTER TABLE `historico_match`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_socket`
--
ALTER TABLE `historico_socket`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `lista_tags`
--
ALTER TABLE `lista_tags`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `validacoes_socket`
--
ALTER TABLE `validacoes_socket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alerta_antenas`
--
ALTER TABLE `alerta_antenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `alerta_tags`
--
ALTER TABLE `alerta_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `atualizacao`
--
ALTER TABLE `atualizacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historico_leituras`
--
ALTER TABLE `historico_leituras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_match`
--
ALTER TABLE `historico_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3394;

--
-- AUTO_INCREMENT de tabela `historico_socket`
--
ALTER TABLE `historico_socket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47073;

--
-- AUTO_INCREMENT de tabela `lista_tags`
--
ALTER TABLE `lista_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1716;

--
-- AUTO_INCREMENT de tabela `validacoes_socket`
--
ALTER TABLE `validacoes_socket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6211;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
