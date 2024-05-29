-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 17/04/2023 às 10:34
-- Versão do servidor: 8.0.32-0ubuntu0.22.04.2
-- Versão do PHP: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_sva_lidar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int NOT NULL,
  `valor_dlc` varchar(10) DEFAULT NULL,
  `valor_dtc` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `valor_dlc`, `valor_dtc`) VALUES
(1, '12', '7');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados_api_lidar`
--

CREATE TABLE `dados_api_lidar` (
  `id` int NOT NULL,
  `media_server_id` varchar(8) DEFAULT NULL,
  `camera` varchar(20) DEFAULT NULL,
  `tipo_evento` varchar(8) DEFAULT NULL,
  `detected_at` varchar(30) DEFAULT NULL,
  `data_leitura` varchar(12) DEFAULT NULL,
  `hora_leitura` varchar(10) DEFAULT NULL,
  `confidence` varchar(5) DEFAULT NULL,
  `mediaZ_Total` varchar(20) DEFAULT NULL,
  `mediaZ_Carga` varchar(20) DEFAULT NULL,
  `tipo_veiculo` varchar(30) DEFAULT NULL,
  `condicao_veiculo` varchar(20) DEFAULT NULL,
  `dlc` varchar(5) DEFAULT NULL,
  `dtc` varchar(5) DEFAULT NULL,
  `alerta` varchar(30) DEFAULT NULL,
  `alerta2` varchar(100) DEFAULT NULL,
  `num_linhas_matrix` varchar(20) DEFAULT NULL,
  `num_colunas_matrix` varchar(20) DEFAULT NULL,
  `image` mediumblob,
  `url_video` varchar(200) DEFAULT NULL,
  `plot_lidar` longtext,
  `id_cheio_vazio` varchar(10) DEFAULT NULL,
  `id_historico_display` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `teste`
--

CREATE TABLE `teste` (
  `id` int NOT NULL,
  `mensagem` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `dados_api_lidar`
--
ALTER TABLE `dados_api_lidar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `teste`
--
ALTER TABLE `teste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `dados_api_lidar`
--
ALTER TABLE `dados_api_lidar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `teste`
--
ALTER TABLE `teste`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
