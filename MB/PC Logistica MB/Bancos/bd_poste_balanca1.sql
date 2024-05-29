-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 10-Fev-2023 às 08:47
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
-- Banco de dados: `bd_poste_balanca1`
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

--
-- Extraindo dados da tabela `alerta_antenas`
--

INSERT INTO `alerta_antenas` (`id`, `antena`, `local`, `tratado`, `data_leitura`, `hora_leitura`) VALUES
(1, '0', 'Automacoes Saida Balanca 1', 'nao', '02/11/2022', '14:27:23'),
(2, '0', 'Automacoes Saida Balanca 1', 'nao', '12/11/2022', '08:57:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atualizacao`
--

CREATE TABLE `atualizacao` (
  `id` int(11) NOT NULL,
  `data_atualizacao` varchar(10) NOT NULL,
  `hora_atualizacao` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Extraindo dados da tabela `atualizacao`
--

INSERT INTO `atualizacao` (`id`, `data_atualizacao`, `hora_atualizacao`) VALUES
(1, '13/12/2022', '15:01:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atualizacao_services`
--

CREATE TABLE `atualizacao_services` (
  `id` int(11) NOT NULL,
  `nome_service` varchar(100) DEFAULT NULL,
  `data_atualizacao` varchar(12) DEFAULT NULL,
  `hora_atualizacao` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Extraindo dados da tabela `atualizacao_services`
--

INSERT INTO `atualizacao_services` (`id`, `nome_service`, `data_atualizacao`, `hora_atualizacao`) VALUES
(1, 'reiniciar_rock.service', '27/12/2022', '08:00:00'),
(2, 'verifica_services.service', '27/12/2022', '08:00:00'),
(3, 'sincroniza_consultar_apenas_saida_automacoes.service', '27/12/2022', '08:00:00'),
(4, 'sincroniza_socket_balanca1.service', '27/12/2022', '08:00:00'),
(5, 'servidor_socket_balanca1.service', '27/12/2022', '08:00:00'),
(6, 'servidor_socket_poste_balanca1.service', '27/12/2022', '08:00:00'),
(7, 'sincroniza_socket.service', '27/12/2022', '08:00:00'),
(8, 'automacoes_lora.service', '27/12/2022', '08:00:00'),
(9, 'atualiza_display.service', '27/12/2022', '08:00:00'),
(10, 'publica_tora.service', '09/02/2023', '10:30:39'),
(11, 'sincronizar_excesso.service', '27/12/2022', '08:00:00'),
(12, 'sincronizar_dados.service', '27/12/2022', '08:00:00'),
(13, 'poste_balanca1.service', '27/12/2022', '08:00:00'),
(14, 'alerta_lidar.service', '27/12/2022', '08:00:00'),
(15, 'balanca_poste.service', '27/12/2022', '08:00:00'),
(16, 'verifica_tag_tora_ou_fjx.service', '09/02/2023', '10:30:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `excesso` varchar(10) DEFAULT NULL,
  `carga_torta` varchar(10) DEFAULT NULL,
  `roubo_carga` varchar(10) DEFAULT NULL,
  `modo_operacao_display` varchar(20) DEFAULT NULL,
  `publicar_gagf` varchar(10) DEFAULT NULL,
  `publicar_display` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Extraindo dados da tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `excesso`, `carga_torta`, `roubo_carga`, `modo_operacao_display`, `publicar_gagf`, `publicar_display`) VALUES
(1, 'nao', 'nao', 'nao', 'modo_completo', 'false', 'true');

-- --------------------------------------------------------

--
-- Estrutura da tabela `display_balanca1`
--

CREATE TABLE `display_balanca1` (
  `id` int(11) NOT NULL,
  `mensagem1` varchar(30) DEFAULT NULL,
  `mensagem2` varchar(30) DEFAULT NULL,
  `mensagem_aux` varchar(20) DEFAULT NULL,
  `epc_carreta` varchar(30) DEFAULT NULL,
  `ultima_epc_carreta` varchar(30) DEFAULT NULL,
  `ponto` varchar(20) DEFAULT NULL,
  `semaforo_entrada` varchar(10) DEFAULT NULL,
  `semaforo_saida` varchar(10) DEFAULT NULL,
  `crc_display` longtext DEFAULT NULL,
  `condicao_automacao_semaforos` varchar(50) DEFAULT NULL,
  `api_cheio_vazio` varchar(50) DEFAULT NULL,
  `api_lidar` varchar(20) DEFAULT NULL,
  `ultima_api_lidar` varchar(20) DEFAULT NULL,
  `id_cheio_vazio` varchar(20) DEFAULT NULL,
  `data_math_lidar` varchar(20) DEFAULT NULL,
  `hora_math_lidar` varchar(20) DEFAULT NULL,
  `dlc` varchar(10) DEFAULT NULL,
  `dtc` varchar(10) DEFAULT NULL,
  `alerta` varchar(30) DEFAULT NULL,
  `alerta2` varchar(50) DEFAULT NULL,
  `data_alerta` varchar(12) DEFAULT NULL,
  `hora_alerta` varchar(10) DEFAULT NULL,
  `epc_lidar` varchar(30) DEFAULT NULL,
  `veiculo` varchar(20) DEFAULT NULL,
  `condicao_veiculo` varchar(20) DEFAULT NULL,
  `id_historico` varchar(10) DEFAULT NULL,
  `epc_cavalo` varchar(30) DEFAULT NULL,
  `placa_cavalo` varchar(20) DEFAULT NULL,
  `opcao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Extraindo dados da tabela `display_balanca1`
--

INSERT INTO `display_balanca1` (`id`, `mensagem1`, `mensagem2`, `mensagem_aux`, `epc_carreta`, `ultima_epc_carreta`, `ponto`, `semaforo_entrada`, `semaforo_saida`, `crc_display`, `condicao_automacao_semaforos`, `api_cheio_vazio`, `api_lidar`, `ultima_api_lidar`, `id_cheio_vazio`, `data_math_lidar`, `hora_math_lidar`, `dlc`, `dtc`, `alerta`, `alerta2`, `data_alerta`, `hora_alerta`, `epc_lidar`, `veiculo`, `condicao_veiculo`, `id_historico`, `epc_cavalo`, `placa_cavalo`, `opcao`) VALUES
(1, 'Aguardando_veiculo!', '___________________', '_______', '-', '-', '-', '0', '1', '', ' >0,0<', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '53833', '-', '-', '-');

-- --------------------------------------------------------

--
-- Estrutura da tabela `hh2risk_cadastro_motoristas`
--

CREATE TABLE `hh2risk_cadastro_motoristas` (
  `id` int(11) NOT NULL,
  `motorista` varchar(300) DEFAULT NULL,
  `data_validacao` varchar(12) DEFAULT NULL,
  `hora_validacao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `hh2risk_cadastro_placas`
--

CREATE TABLE `hh2risk_cadastro_placas` (
  `id` int(11) NOT NULL,
  `placa` varchar(30) DEFAULT NULL,
  `data_validacao` varchar(12) DEFAULT NULL,
  `hora_validacao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `hh2risk_cadastro_placas`
--

INSERT INTO `hh2risk_cadastro_placas` (`id`, `placa`, `data_validacao`, `hora_validacao`) VALUES
(2, 'RUP7A26', '03/01/2023', '15:07:04'),
(3, 'RVH7C21', '03/01/2023', '15:14:32'),
(6, 'RTX6C47', '09/01/2023', '13:23:34'),
(9, 'RVP6F61', '10/01/2023', '21:38:59'),
(16, 'RVP6F59', '14/01/2023', '12:36:48'),
(22, 'RVO9G09', '15/01/2023', '23:28:55'),
(32, 'RVO9G06', '08/02/2023', '16:26:40'),
(33, 'RTT4F64', '08/02/2023', '22:54:00'),
(34, 'PRU6A35', '08/02/2023', '23:27:17'),
(35, 'RVO9G05', '09/02/2023', '01:31:46'),
(36, 'RVL9G63', '09/02/2023', '01:41:09'),
(37, 'RVL9H41', '09/02/2023', '07:25:49'),
(38, 'RVL9H16', '09/02/2023', '07:26:45'),
(39, 'RVH7B78', '09/02/2023', '07:29:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_display`
--

CREATE TABLE `historico_display` (
  `id` int(11) NOT NULL,
  `epc_cavalo` varchar(30) DEFAULT NULL,
  `placa_cavalo` varchar(30) DEFAULT NULL,
  `epc_carreta` varchar(30) DEFAULT NULL,
  `placa_carreta` varchar(20) DEFAULT NULL,
  `ponto` varchar(20) DEFAULT NULL,
  `data_aqui1` varchar(20) DEFAULT NULL,
  `hora_aqui1` varchar(20) DEFAULT NULL,
  `condicao1` varchar(200) DEFAULT NULL,
  `tratado_por_segurpro` varchar(20) DEFAULT NULL,
  `registro_segurpro` varchar(20) DEFAULT NULL,
  `nome_segurpro` varchar(100) DEFAULT NULL,
  `descricao_segurpro` varchar(300) DEFAULT NULL,
  `tratado_por_ccl` varchar(20) DEFAULT NULL,
  `registro_ccl` varchar(20) DEFAULT NULL,
  `nome_ccl` varchar(100) DEFAULT NULL,
  `descricao_ccl` varchar(300) DEFAULT NULL,
  `data_aqui2` varchar(20) DEFAULT NULL,
  `hora_aqui2` varchar(20) DEFAULT NULL,
  `condicao2` varchar(20) DEFAULT NULL,
  `gagf` varchar(20) DEFAULT NULL,
  `gscs` varchar(20) DEFAULT NULL,
  `material` varchar(200) DEFAULT NULL,
  `destino` varchar(200) DEFAULT NULL,
  `motorista` varchar(100) DEFAULT NULL,
  `concluido` varchar(10) DEFAULT NULL,
  `status_saida` varchar(100) DEFAULT NULL,
  `id_cheio_vazio` varchar(20) DEFAULT NULL,
  `api_cheio_vazio` varchar(100) DEFAULT NULL,
  `id_lidar` varchar(20) DEFAULT NULL,
  `retorno_api` varchar(600) DEFAULT NULL,
  `caminho_snapshot` varchar(200) DEFAULT NULL,
  `sigla_transportadora` varchar(100) DEFAULT NULL,
  `veiculo` varchar(20) DEFAULT NULL,
  `condicao_veiculo` varchar(20) DEFAULT NULL,
  `mensagem` varchar(25) DEFAULT NULL,
  `mensagem2` varchar(25) DEFAULT NULL,
  `crc_display` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_leituras`
--

CREATE TABLE `historico_leituras` (
  `id` int(11) NOT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `epc` varchar(24) DEFAULT NULL,
  `data_leitura` varchar(10) DEFAULT NULL,
  `hora_leitura` varchar(8) DEFAULT NULL,
  `antena` varchar(1) DEFAULT NULL,
  `tratado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_lora`
--

CREATE TABLE `historico_lora` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(100) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `data_atualizacao` varchar(20) DEFAULT NULL,
  `hora_atualizacao` varchar(20) DEFAULT NULL
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
-- Estrutura da tabela `historico_recebido_python`
--

CREATE TABLE `historico_recebido_python` (
  `id` int(11) NOT NULL,
  `epc` varchar(30) DEFAULT NULL,
  `data` varchar(20) DEFAULT NULL,
  `hora` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_socket`
--

CREATE TABLE `historico_socket` (
  `id` int(11) NOT NULL,
  `epc` varchar(30) DEFAULT NULL,
  `antena` varchar(2) DEFAULT NULL,
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
-- Estrutura da tabela `lidar_excesso`
--

CREATE TABLE `lidar_excesso` (
  `id` int(11) NOT NULL,
  `id_lidar` varchar(10) DEFAULT NULL,
  `id_cheio_vazio` varchar(10) DEFAULT NULL,
  `id_historico` varchar(10) DEFAULT NULL,
  `epc_lidar` varchar(30) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `veiculo` varchar(20) DEFAULT NULL,
  `data_leitura` varchar(20) DEFAULT NULL,
  `dia` varchar(10) DEFAULT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `ano` varchar(5) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL,
  `confirmacao` varchar(20) DEFAULT NULL,
  `tempo_confirmacao` varchar(10) DEFAULT NULL,
  `motivo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `lidar_excesso`
--

INSERT INTO `lidar_excesso` (`id`, `id_lidar`, `id_cheio_vazio`, `id_historico`, `epc_lidar`, `placa`, `veiculo`, `data_leitura`, `dia`, `mes`, `ano`, `hora_leitura`, `condicao`, `data_tratado`, `hora_tratado`, `confirmacao`, `tempo_confirmacao`, `motivo`) VALUES
(1, '20', '-', '20', '442002000000000000001745', 'RTO4D66', 'Carreta', '25/11/2022', '25', '11', '2022', '15:07:33', 'Carga descentralizada para a dianteira!', '25/11/2022', '15:07:35', 'Tratado', '0', 'Excesso'),
(2, '24', '-', '22', '442002000000000000001480', 'OWY3550', 'Carreta', '25/11/2022', '25', '11', '2022', '15:15:32', 'Carga descentralizada transversalmente à direita!', '25/11/2022', '15:15:35', 'Tratado', '0', 'Carga Descentralizada'),
(7, '70', '-', '80', '442002000000000000001417', 'QPY8990', 'Nao identificado', '25/11/2022', '25', '11', '2022', '18:53:23', 'Carga descentralizada transversalmente à direita!', '25/11/2022', '18:53:24', 'Tratado', '0', 'Carga Descentralizada'),
(13, '182', '-', '188', '442002000000000000001366', 'PRU5945', 'Carreta', '26/11/2022', '26', '11', '2022', '15:28:03', 'Carga descentralizada para a dianteira!', '26/11/2022', '15:28:05', 'Tratado', '0', 'Carga Descentralizada'),
(23, '318', '-', '353', '442002000000000000001916', 'RTT4F70', 'Carreta', '27/11/2022', '27', '11', '2022', '03:40:59', 'Carga descentralizada para a dianteira!', '27/11/2022', '03:40:59', 'Tratado', '0', 'Excesso'),
(24, '372', '-', '411', '442002000000000000001941', 'RTX6B48', 'Nao identificado', '27/11/2022', '27', '11', '2022', '09:34:15', 'Carga descentralizada para a traseira!', '27/11/2022', '09:34:17', 'Tratado', '0', 'Carga Descentralizada'),
(28, '445', '-', '505', '442002000000000000001380', 'RTS6B31', 'Carreta', '27/11/2022', '27', '11', '2022', '14:40:06', 'Carga descentralizada para a dianteira!', '27/11/2022', '14:40:08', 'Tratado', '0', 'Excesso'),
(30, '456', '33767', '525', '442002000000000000001890', 'RUR5E62', 'Traçado', '27/11/2022', '27', '11', '2022', '15:25:53', 'Carga descentralizada para a traseira!', '27/11/2022', '15:25:54', 'Tratado', '0', 'Carga Descentralizada'),
(33, '462', '-', '533', '442002000000000000001897', 'RUP4F42', 'Carreta', '27/11/2022', '27', '11', '2022', '15:57:35', 'Carga descentralizada transversalmente à direita!', '27/11/2022', '15:57:36', 'Tratado', '0', 'Excesso'),
(34, '482', '-', '551', '442002000000000000001827', 'RTE3D09', 'Carreta', '27/11/2022', '27', '11', '2022', '18:29:30', 'Carga descentralizada para a traseira!', '27/11/2022', '18:29:31', 'Tratado', '0', 'Carga Descentralizada'),
(35, '494', '-', '563', '442002000000000000001953', 'PRR4946', 'Carreta', '27/11/2022', '27', '11', '2022', '19:12:25', 'Carga descentralizada para a traseira!', '27/11/2022', '19:12:25', 'Tratado', '0', 'Carga Descentralizada'),
(36, '501', '-', '571', '442002000000000000001676', 'RFS5J21', 'Nao identificado', '27/11/2022', '27', '11', '2022', '20:42:10', 'Carga descentralizada para a traseira!', '27/11/2022', '20:42:11', 'Tratado', '0', 'Carga Descentralizada'),
(39, '526', '-', '591', '442002000000000000001884', 'RTX6D40', 'Carreta', '27/11/2022', '27', '11', '2022', '21:56:01', 'Tudo OK', '27/11/2022', '21:56:01', 'Tratado', '0', 'Carga Descentralizada'),
(40, '541', '-', '605', '442002000000000000001411', 'PRT5331', 'Carreta', '27/11/2022', '27', '11', '2022', '22:46:34', 'Carga descentralizada para a traseira!', '27/11/2022', '22:46:35', 'Tratado', '0', 'Carga Descentralizada'),
(42, '587', '-', '648', '442002000000000000001448', 'RGC4B21', 'Carreta', '28/11/2022', '28', '11', '2022', '03:56:57', 'Carga descentralizada transversalmente à direita!', '28/11/2022', '03:56:57', 'Tratado', '0', 'Carga Descentralizada'),
(43, '695', '33962', '749', '442002000000000000001419', 'PRU5985', 'Carreta', '28/11/2022', '28', '11', '2022', '10:37:03', 'Carga descentralizada transversalmente à direita!', '28/11/2022', '10:37:04', 'Tratado', '0', 'Excesso'),
(44, '712', '33994', '767', '442002000000000000001869', 'CQU1G84', 'Carreta', '28/11/2022', '28', '11', '2022', '11:42:17', 'Carga descentralizada transversalmente à direita!', '28/11/2022', '11:42:19', 'Tratado', '0', 'Carga Descentralizada'),
(45, '713', '33995', '768', '442002000000000000001558', 'RTT3I09', 'Carreta', '28/11/2022', '28', '11', '2022', '11:43:44', 'Carga descentralizada para a dianteira!', '28/11/2022', '11:43:46', 'Tratado', '0', 'Excesso'),
(49, '762', '34054', '810', '442002000000000000001674', 'RFL4A49', 'Nao identificado', '28/11/2022', '28', '11', '2022', '13:52:50', 'Carga descentralizada transversalmente à direita!', '28/11/2022', '13:52:52', 'Tratado', '0', 'Carga Descentralizada'),
(51, '785', '34077', '823', '442002000000000000001319', 'PVC0308', 'Carreta', '28/11/2022', '28', '11', '2022', '14:57:48', 'Carga descentralizada para a dianteira!', '28/11/2022', '14:57:48', 'Tratado', '0', 'Carga Descentralizada'),
(52, '794', '34088', '828', '442002000000000000001615', 'OQJ6242', 'Carreta', '28/11/2022', '28', '11', '2022', '15:13:28', 'Carga descentralizada transversalmente à direita!', '28/11/2022', '15:13:29', 'Tratado', '0', 'Carga Descentralizada'),
(53, '1143', '-', '1190', '442002000000000000001271', 'QQG3840', 'Nao identificado', '29/11/2022', '29', '11', '2022', '19:11:05', 'Carga descentralizada transversalmente à direita!', '29/11/2022', '19:11:06', 'Tratado', '0', 'Carga Descentralizada'),
(54, '1145', '-', '1194', '442002000000000000001274', 'RFF4A18', 'Carreta', '29/11/2022', '29', '11', '2022', '19:23:40', 'Carga descentralizada transversalmente à direita!', '29/11/2022', '19:23:41', 'Tratado', '0', 'Excesso'),
(57, '1145', '-', '1200', '442002000000000000001889', 'RUR5E48', 'Nao identificado', '29/11/2022', '29', '11', '2022', '19:43:53', 'Carga descentralizada transversalmente à direita!', '29/11/2022', '19:43:54', 'Tratado', '0', 'Carga Descentralizada'),
(62, '1212', '34577', '1266', '442002000000000000001403', 'QQJ2619', 'Carreta', '30/11/2022', '30', '11', '2022', '04:31:22', 'Carga descentralizada para a dianteira!', '30/11/2022', '04:31:23', 'Tratado', '0', 'Carga Descentralizada'),
(63, '1224', '34590', '1135', '442002000000000000001470', 'HFD5G53', 'Carreta', '30/11/2022', '30', '11', '2022', '05:27:48', 'Carga descentralizada para a traseira!', '30/11/2022', '05:27:50', 'Tratado', '0', 'Carga Descentralizada'),
(71, '1610', '35158', '1289', '442002000000000000001298', 'QPY8661', 'Carreta', '01/12/2022', '01', '12', '2022', '14:54:46', 'Carga descentralizada transversalmente à direita!', '01/12/2022', '14:54:47', 'Tratado', '0', 'Carga Descentralizada'),
(72, '1617', '-', '1518', '442002000000000000001368', 'RNP8D73', 'Carreta', '01/12/2022', '01', '12', '2022', '15:03:44', 'Carga descentralizada em dois pontos!', '01/12/2022', '15:03:45', 'Tratado', '0', 'Carga Descentralizada'),
(73, '1622', '35180', '1226', '442002000000000000001655', 'PRU6A35', 'Carreta', '01/12/2022', '01', '12', '2022', '15:20:57', 'Carga descentralizada transversalmente à direita!', '01/12/2022', '15:20:57', 'Tratado', '0', 'Carga Descentralizada'),
(74, '1629', '35190', '1502', '442002000000000000001860', 'RNB1E40', 'Carreta', '01/12/2022', '01', '12', '2022', '15:33:23', 'Carga descentralizada transversalmente à direita!', '01/12/2022', '15:33:24', 'Tratado', '0', 'Carga Descentralizada'),
(75, '1648', '35258', '1624', '442002000000000000001793', 'RMX5E76', 'Carreta', '01/12/2022', '01', '12', '2022', '17:16:25', 'Carga descentralizada transversalmente à direita!', '01/12/2022', '17:16:27', 'Tratado', '0', 'Carga Descentralizada'),
(76, '1664', '35278', '1629', '442002000000000000001732', 'RND5C37', 'Carreta', '01/12/2022', '01', '12', '2022', '18:19:57', 'Carga descentralizada para a dianteira!', '01/12/2022', '18:19:58', 'Tratado', '0', 'Carga Descentralizada'),
(77, '1681', '35296', '1080', '442002000000000000001864', 'QPG3365', 'Carreta', '01/12/2022', '01', '12', '2022', '18:52:37', 'Carga descentralizada transversalmente à direita!', '01/12/2022', '18:52:38', 'Tratado', '0', 'Excesso'),
(81, '1715', '35344', '1649', '442002000000000000001809', 'RNQ5C75', 'Carreta', '01/12/2022', '01', '12', '2022', '21:51:08', 'Carga descentralizada para a dianteira!', '01/12/2022', '21:51:09', 'Tratado', '0', 'Carga Descentralizada'),
(82, '1719', '35347', '1436', '442002000000000000001902', 'RTK2C19', 'Nao identificado', '01/12/2022', '01', '12', '2022', '22:07:05', 'Carga descentralizada para a traseira!', '01/12/2022', '22:07:06', 'Tratado', '0', 'Carga Descentralizada'),
(84, '1757', '35385', '1661', '442002000000000000001693', 'GYI8D58', 'Carreta', '02/12/2022', '02', '12', '2022', '02:04:00', 'Carga descentralizada para a dianteira!', '02/12/2022', '02:04:02', 'Tratado', '0', 'Carga Descentralizada'),
(87, '1766', '-', '1665', '442002000000000000001696', 'RNV5B56', 'Carreta', '02/12/2022', '02', '12', '2022', '02:49:49', 'Carga descentralizada para a dianteira!', '02/12/2022', '02:49:50', 'Tratado', '0', 'Carga Descentralizada'),
(88, '1768', '-', '1427', '442002000000000000001835', 'RNW3H96', 'Carreta', '02/12/2022', '02', '12', '2022', '03:21:53', 'Carga descentralizada para a dianteira!', '02/12/2022', '03:21:55', 'Tratado', '0', 'Carga Descentralizada'),
(90, '1786', '35415', '1481', '442002000000000000001619', 'RTT3I07', 'Nao identificado', '02/12/2022', '02', '12', '2022', '05:50:32', 'Carga descentralizada transversalmente à direita!', '02/12/2022', '05:50:32', 'Tratado', '0', 'Carga Descentralizada'),
(91, '1788', '-', '1505', '442002000000000000001250', 'PUG2813', 'Carreta', '02/12/2022', '02', '12', '2022', '05:56:12', 'Carga descentralizada transversalmente à direita!', '02/12/2022', '05:56:13', 'Tratado', '0', 'Carga Descentralizada'),
(92, '1798', '-', '621', '442002000000000000001921', 'RTO4D80', 'Carreta', '02/12/2022', '02', '12', '2022', '06:21:49', 'Carga descentralizada transversalmente à direita!', '02/12/2022', '06:21:49', 'Tratado', '0', 'Carga Descentralizada'),
(94, '1818', '35439', '1680', '442002000000000000001554', 'PRU6A95', 'Nao identificado', '02/12/2022', '02', '12', '2022', '07:22:40', 'Carga descentralizada transversalmente à direita!', '02/12/2022', '07:22:40', 'Tratado', '0', 'Carga Descentralizada'),
(95, '1821', '35443', '1682', '442002000000000000001204', 'QUO2624', 'Carreta', '02/12/2022', '02', '12', '2022', '07:33:44', 'Carga descentralizada transversalmente à direita!', '02/12/2022', '07:33:46', 'Tratado', '0', 'Carga Descentralizada'),
(96, '1828', '35451', '1496', '442002000000000000001402', 'RNP5D82', 'Carreta', '02/12/2022', '02', '12', '2022', '07:48:02', 'Carga descentralizada em dois pontos!', '02/12/2022', '07:48:03', 'Tratado', '0', 'Carga Descentralizada'),
(97, '1849', '35485', '1690', '442002000000000000001516', 'RFE6D64', 'Carreta', '02/12/2022', '02', '12', '2022', '09:25:47', 'Carga descentralizada transversalmente à direita!', '02/12/2022', '09:25:49', 'Tratado', '0', 'Carga Descentralizada'),
(98, '1879', '35524', '1554', '442002000000000000001859', 'RNP6C86', 'Carreta', '02/12/2022', '02', '12', '2022', '10:59:01', 'Carga descentralizada para a dianteira!', '02/12/2022', '10:59:01', 'Tratado', '0', 'Carga Descentralizada'),
(100, '1916', '35575', '1526', '442002000000000000001500', 'RFA3E69', 'Nao identificado', '02/12/2022', '02', '12', '2022', '13:26:53', 'Carga descentralizada para a dianteira!', '02/12/2022', '13:26:53', 'Tratado', '0', 'Carga Descentralizada'),
(103, '1963', '35649', '1793', '442002000000000000001896', 'RTH2A88', 'Carreta', '02/12/2022', '02', '12', '2022', '15:43:03', 'Carga descentralizada para a dianteira!', '02/12/2022', '15:43:03', 'Tratado', '0', 'Carga Descentralizada'),
(105, '1973', '35662', '1810', '442002000000000000001638', 'QXR6H72', 'Carreta', '02/12/2022', '02', '12', '2022', '16:27:32', 'Carga descentralizada transversalmente à direita!', '02/12/2022', '16:27:33', 'Tratado', '0', 'Carga Descentralizada'),
(106, '1987', '-', '1818', '442002000000000000001400', 'PVK6101', 'Carreta', '02/12/2022', '02', '12', '2022', '16:57:20', 'Carga descentralizada para a dianteira!', '02/12/2022', '16:57:21', 'Tratado', '0', 'Carga Descentralizada'),
(107, '1991', '35677', '-', '442002000000000000001938', 'RFX0I54', 'Carreta', '02/12/2022', '02', '12', '2022', '17:02:15', 'Carga descentralizada para a traseira!', '02/12/2022', '17:02:16', 'Tratado', '0', 'Excesso'),
(109, '2089', '35778', '1904', '442002000000000000001951', 'RTS6B30', 'Carreta', '03/12/2022', '03', '12', '2022', '01:40:27', 'Carga descentralizada para a dianteira!', '03/12/2022', '01:40:27', 'Tratado', '0', 'Excesso'),
(110, '2093', '-', '1782', '442002000000000000001703', 'RTE7G67', 'Carreta', '03/12/2022', '03', '12', '2022', '02:28:55', 'Carga descentralizada transversalmente à direita!', '03/12/2022', '02:28:56', 'Tratado', '0', 'Carga Descentralizada'),
(112, '2106', '35794', '1922', '442002000000000000001779', 'RNP7D93', 'Carreta', '03/12/2022', '03', '12', '2022', '05:01:55', 'Carga descentralizada transversalmente à direita!', '03/12/2022', '05:01:56', 'Tratado', '0', 'Carga Descentralizada'),
(115, '2177', '35871', '1888', '442002000000000000001891', 'RUR5E44', 'Carreta', '03/12/2022', '03', '12', '2022', '09:35:35', 'Carga descentralizada para a traseira!', '03/12/2022', '09:35:37', 'Tratado', '0', 'Carga Descentralizada'),
(117, '2235', '35950', '2019', '442002000000000000001861', 'HBN7681', 'Carreta', '03/12/2022', '03', '12', '2022', '13:18:31', 'Carga descentralizada para a dianteira!', '03/12/2022', '13:18:32', 'Tratado', '0', 'Carga Descentralizada'),
(118, '2240', '35959', '2021', '442002000000000000001946', 'RTX6B54', 'Carreta', '03/12/2022', '03', '12', '2022', '13:32:30', 'Carga descentralizada transversalmente à direita!', '03/12/2022', '13:32:31', 'Tratado', '0', 'Carga Descentralizada'),
(120, '2251', '35974', '2029', '442002000000000000001473', 'OPY6918', 'Carreta', '03/12/2022', '03', '12', '2022', '14:28:55', 'Carga descentralizada transversalmente à direita!', '03/12/2022', '14:28:56', 'Tratado', '0', 'Excesso'),
(121, '2265', '35988', '2042', '442002000000000000001487', 'GSV0946', 'Carreta', '03/12/2022', '03', '12', '2022', '15:26:49', 'Carga descentralizada para a dianteira!', '03/12/2022', '15:26:50', 'Tratado', '0', 'Carga Descentralizada'),
(125, '2361', '36076', '2132', '442002000000000000001483', 'QNJ9953', 'Carreta', '04/12/2022', '04', '12', '2022', '04:15:40', 'Carga descentralizada para a dianteira!', '04/12/2022', '04:15:42', 'Tratado', '0', 'Carga Descentralizada'),
(126, '2406', '36114', '2020', '442002000000000000001610', 'QQE3037', 'Carreta', '04/12/2022', '04', '12', '2022', '09:33:10', 'Carga descentralizada transversalmente à direita!', '04/12/2022', '09:33:11', 'Tratado', '0', 'Carga Descentralizada'),
(132, '2479', '-', '2227', '442002000000000000001877', 'RTX6C34', 'Carreta', '04/12/2022', '04', '12', '2022', '16:00:14', 'Carga descentralizada para a dianteira!', '04/12/2022', '16:00:16', 'Tratado', '0', 'Excesso'),
(137, '2496', '36199', '2238', '442002000000000000001742', 'RTO4E74', 'Carreta', '04/12/2022', '04', '12', '2022', '18:04:03', 'Carga descentralizada transversalmente à direita!', '04/12/2022', '18:04:04', 'Tratado', '0', 'Carga Descentralizada'),
(144, '2541', '-', '2280', '442002000000000000001926', 'RTT3I12', 'Traçado', '04/12/2022', '04', '12', '2022', '22:18:44', 'Carga descentralizada transversalmente à direita!', '04/12/2022', '22:18:46', 'Tratado', '0', 'Carga Descentralizada'),
(145, '2543', '36230', '2282', '442002000000000000001899', 'RTX6C45', 'Carreta', '04/12/2022', '04', '12', '2022', '22:27:30', 'Carga descentralizada transversalmente à direita!', '04/12/2022', '22:27:31', 'Tratado', '0', 'Excesso'),
(148, '2651', '36352', '2375', '442002000000000000001795', 'RNU6F73', 'Carreta', '05/12/2022', '05', '12', '2022', '09:36:57', 'Carga descentralizada transversalmente à direita!', '05/12/2022', '09:36:58', 'Tratado', '0', 'Carga Descentralizada'),
(149, '2666', '36372', '2385', '442002000000000000001422', 'PRR4106', 'Nao identificado', '05/12/2022', '05', '12', '2022', '10:36:57', 'Carga descentralizada em dois pontos!', '05/12/2022', '10:36:59', 'Tratado', '0', 'Carga Descentralizada'),
(151, '2706', '-', '2186', '442002000000000000001900', 'RTX6D34', 'Nao identificado', '05/12/2022', '05', '12', '2022', '14:42:09', 'Carga descentralizada para a dianteira!', '05/12/2022', '14:42:11', 'Tratado', '0', 'Carga Descentralizada'),
(152, '2711', '-', '2438', '442002000000000000001932', 'RTX6B43', 'Carreta', '05/12/2022', '05', '12', '2022', '14:58:28', 'Carga descentralizada para a dianteira!', '05/12/2022', '14:58:28', 'Tratado', '0', 'Carga Descentralizada'),
(156, '2721', '36484', '2447', '442002000000000000001377', 'RTS6B28', 'Nao identificado', '05/12/2022', '05', '12', '2022', '16:19:54', 'Carga descentralizada para a dianteira!', '05/12/2022', '16:19:56', 'Tratado', '0', 'Excesso'),
(157, '2745', '36507', '2481', '442002000000000000001656', 'PRT5301', 'Carreta', '05/12/2022', '05', '12', '2022', '18:42:53', 'Carga descentralizada transversalmente à direita!', '05/12/2022', '18:42:54', 'Tratado', '0', 'Excesso'),
(161, '2920', '-', '2630', '442002000000000000001901', '-', 'Carreta', '06/12/2022', '06', '12', '2022', '11:31:02', 'Carga descentralizada para a traseira!', '06/12/2022', '11:31:04', 'Tratado', '0', 'Carga Descentralizada'),
(162, '2951', '-', '788', '442002000000000000001614', 'OQI2328', 'Traçado', '06/12/2022', '06', '12', '2022', '13:28:00', 'Carga descentralizada para a traseira!', '06/12/2022', '13:28:01', 'Tratado', '0', 'Carga Descentralizada'),
(165, '2990', '36822', '157', '442002000000000000001905', 'RTO4E35', 'Nao identificado', '06/12/2022', '06', '12', '2022', '16:16:01', 'Carga descentralizada para a dianteira!', '06/12/2022', '16:16:02', 'Tratado', '0', 'Carga Descentralizada'),
(166, '2993', '36829', '2684', '442002000000000000001495', 'KRA9C01', 'Nao identificado', '06/12/2022', '06', '12', '2022', '16:26:51', 'Carga descentralizada para a dianteira!', '06/12/2022', '16:26:52', 'Tratado', '0', 'Carga Descentralizada'),
(167, '3043', '-', '2727', '442002000000000000001780', '-', 'Carreta', '06/12/2022', '06', '12', '2022', '22:37:32', 'Carga descentralizada para a dianteira!', '06/12/2022', '22:37:34', 'Tratado', '0', 'Carga Descentralizada'),
(168, '3054', '-', '2736', '442002000000000000001609', 'PRR4146', 'Carreta', '07/12/2022', '07', '12', '2022', '00:40:49', 'Tudo OK', '07/12/2022', '00:40:51', 'Tratado', '0', 'Carga Descentralizada'),
(172, '3078', '-', '2757', '442002000000000000001640', 'PUP0660', 'Carreta', '07/12/2022', '07', '12', '2022', '02:24:34', 'Carga descentralizada em dois pontos!', '07/12/2022', '02:24:35', 'Tratado', '0', 'Carga Descentralizada'),
(174, '3151', '37027', '2824', '442002000000000000001510', '-', 'Carreta', '07/12/2022', '07', '12', '2022', '07:55:34', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '07:55:36', 'Tratado', '0', 'Carga Descentralizada'),
(175, '3159', '37051', '2832', '442002000000000000001598', 'QXR2G91', 'Carreta', '07/12/2022', '07', '12', '2022', '09:17:52', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '09:17:53', 'Tratado', '0', 'Carga Descentralizada'),
(176, '3171', '37075', '2847', '442002000000000000001489', 'QXZ1C37', 'Carreta', '07/12/2022', '07', '12', '2022', '10:17:17', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '10:17:17', 'Tratado', '0', 'Carga Descentralizada'),
(177, '3173', '-', '2849', '442002000000000000001361', 'RFD2A28', 'Nao identificado', '07/12/2022', '07', '12', '2022', '10:20:08', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '10:20:09', 'Tratado', '0', 'Carga Descentralizada'),
(178, '3182', '37089', '2859', '442002000000000000001215', 'LLX4472', 'Carreta', '07/12/2022', '07', '12', '2022', '10:53:03', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '10:53:04', 'Tratado', '0', 'Carga Descentralizada'),
(180, '3194', '-', '2879', '442002000000000000001329', 'QUF7414', 'Carreta', '07/12/2022', '07', '12', '2022', '11:42:02', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '11:42:03', 'Tratado', '0', 'Carga Descentralizada'),
(181, '3219', '37142', '2908', '442002000000000000001474', 'PYB2I51', 'Carreta', '07/12/2022', '07', '12', '2022', '12:42:59', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '12:43:01', 'Tratado', '0', 'Carga Descentralizada'),
(183, '3252', '37196', '2947', '442002000000000000001898', 'RUP4F35', 'Carreta', '07/12/2022', '07', '12', '2022', '15:13:24', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '15:13:26', 'Tratado', '0', 'Carga Descentralizada'),
(184, '3273', '37220', '2964', '442002000000000000001330', 'QUH1610', 'Carreta', '07/12/2022', '07', '12', '2022', '16:18:16', 'Carga descentralizada para a dianteira!', '07/12/2022', '16:18:17', 'Tratado', '0', 'Carga Descentralizada'),
(186, '3282', '37262', '2977', '442002000000000000001721', 'RFF9C00', 'Carreta', '07/12/2022', '07', '12', '2022', '17:43:19', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '17:43:21', 'Tratado', '0', 'Carga Descentralizada'),
(187, '3286', '37272', '2981', '442002000000000000001879', 'RTX6C58', 'Carreta', '07/12/2022', '07', '12', '2022', '18:09:17', 'Carga descentralizada em dois pontos!', '07/12/2022', '18:09:19', 'Tratado', '0', 'Carga Descentralizada'),
(190, '3295', '37282', '2989', '442002000000000000001658', 'PRR4236', 'Nao identificado', '07/12/2022', '07', '12', '2022', '18:42:49', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '18:42:50', 'Tratado', '0', 'Carga Descentralizada'),
(192, '3311', '-', '3007', '442002000000000000001919', 'RTT3H99', 'Carreta', '07/12/2022', '07', '12', '2022', '20:30:23', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '20:30:24', 'Tratado', '0', 'Carga Descentralizada'),
(193, '3314', '-', '3009', '442002000000000000001354', 'PRR4276', 'Carreta', '07/12/2022', '07', '12', '2022', '20:35:10', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '20:35:12', 'Tratado', '0', 'Carga Descentralizada'),
(194, '3333', '-', '3025', '442002000000000000001935', 'RTY4B75', 'Carreta', '07/12/2022', '07', '12', '2022', '22:01:37', 'Carga descentralizada para a traseira!', '07/12/2022', '22:01:38', 'Tratado', '0', 'Carga Descentralizada'),
(195, '3337', '37305', '3029', '442002000000000000001768', 'RUO9J52', 'Carreta', '07/12/2022', '07', '12', '2022', '22:15:13', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '22:15:15', 'Tratado', '0', 'Carga Descentralizada'),
(198, '3349', '37311', '2996', '442002000000000000001243', 'PRR4226', 'Carreta', '07/12/2022', '07', '12', '2022', '23:10:11', 'Carga descentralizada transversalmente à direita!', '07/12/2022', '23:10:12', 'Tratado', '0', 'Carga Descentralizada'),
(199, '3354', '-', '2995', '442002000000000000001582', 'RTT4F64', 'Carreta', '08/12/2022', '08', '12', '2022', '02:24:28', 'Tudo OK', '08/12/2022', '02:24:29', 'Tratado', '0', 'Carga Descentralizada'),
(200, '3366', '-', '3030', '442002000000000000001718', 'RFY6J35', 'Carreta', '08/12/2022', '08', '12', '2022', '04:30:29', 'Carga descentralizada para a traseira!', '08/12/2022', '04:30:30', 'Tratado', '0', 'Carga Descentralizada'),
(202, '3472', '-', '3178', '442002000000000000001903', '-', 'Carreta', '08/12/2022', '08', '12', '2022', '12:43:43', 'Carga descentralizada para a traseira!', '08/12/2022', '12:43:45', 'Tratado', '0', 'Carga Descentralizada'),
(203, '3493', '37394', '3199', '442002000000000000001678', 'RMQ6E37', 'Carreta', '08/12/2022', '08', '12', '2022', '14:05:48', 'Carga descentralizada transversalmente à direita!', '08/12/2022', '14:05:48', 'Tratado', '0', 'Carga Descentralizada'),
(205, '3513', '37421', '3231', '442002000000000000001654', 'HFM9508', 'Carreta', '08/12/2022', '08', '12', '2022', '15:35:55', 'Carga descentralizada para a dianteira!', '08/12/2022', '15:35:56', 'Tratado', '0', 'Carga Descentralizada'),
(207, '3521', '37427', '3244', '442002000000000000001764', 'RNX2B62', 'Carreta', '08/12/2022', '08', '12', '2022', '16:01:35', 'Carga descentralizada transversalmente à direita!', '08/12/2022', '16:01:35', 'Tratado', '0', 'Carga Descentralizada'),
(208, '3525', '-', '3248', '442002000000000000001725', 'RNX9I01', 'Carreta', '08/12/2022', '08', '12', '2022', '16:12:06', 'Carga descentralizada transversalmente à direita!', '08/12/2022', '16:12:07', 'Tratado', '0', 'Carga Descentralizada'),
(209, '3534', '-', '3262', '442002000000000000001463', 'RFE1D57', 'Carreta', '08/12/2022', '08', '12', '2022', '17:36:18', 'Carga descentralizada transversalmente à direita!', '08/12/2022', '17:36:20', 'Tratado', '0', 'Carga Descentralizada'),
(210, '3581', '38304', '3328', '442002000000000000001446', 'RFX0A89', 'Carreta', '12/12/2022', '12', '12', '2022', '12:12:54', 'Carga descentralizada em dois pontos!', '12/12/2022', '12:12:54', 'Tratado', '0', 'Carga Descentralizada'),
(212, '3586', '38315', '3334', '442002000000000000001875', 'RTX6C31', 'Carreta', '12/12/2022', '12', '12', '2022', '12:29:18', 'Carga descentralizada em dois pontos!', '12/12/2022', '12:29:19', 'Tratado', '0', 'Carga Descentralizada'),
(213, '3590', '38319', '3338', '442002000000000000001805', 'RNR1G38', 'Carreta', '12/12/2022', '12', '12', '2022', '12:41:18', 'Carga descentralizada transversalmente à direita!', '12/12/2022', '12:41:19', 'Tratado', '0', 'Carga Descentralizada'),
(214, '3667', '-', '3464', '442002000000000000001924', 'RTT3H97', 'Nao identificado', '12/12/2022', '12', '12', '2022', '18:15:23', 'Carga descentralizada para a dianteira!', '12/12/2022', '18:15:25', 'Tratado', '0', 'Carga Descentralizada'),
(215, '3668', '-', '3466', '442002000000000000001548', 'QPU0236', 'Nao identificado', '12/12/2022', '12', '12', '2022', '18:17:49', 'Carga descentralizada transversalmente à direita!', '12/12/2022', '18:17:50', 'Tratado', '0', 'Carga Descentralizada'),
(216, '3672', '-', '3479', '442002000000000000001265', 'QPY8986', 'Carreta', '12/12/2022', '12', '12', '2022', '18:54:11', 'Carga descentralizada transversalmente à direita!', '12/12/2022', '18:54:12', 'Tratado', '0', 'Carga Descentralizada'),
(217, '3685', '-', '3496', '442002000000000000001404', 'QXP6A37', 'Carreta', '12/12/2022', '12', '12', '2022', '20:02:25', 'Carga descentralizada transversalmente à direita!', '12/12/2022', '20:02:26', 'Tratado', '0', 'Carga Descentralizada'),
(219, '3712', '-', '3519', '442002000000000000001352', 'RTT3I10', 'Carreta', '12/12/2022', '12', '12', '2022', '22:09:51', 'Carga descentralizada transversalmente à direita!', '12/12/2022', '22:09:53', 'Tratado', '0', 'Carga Descentralizada'),
(220, '3755', '-', '3561', '442002000000000000001486', 'RTS8C21', 'Carreta', '13/12/2022', '13', '12', '2022', '02:28:11', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '02:28:13', 'Tratado', '0', 'Excesso'),
(222, '3850', '-', '3196', '442002000000000000001856', 'QOK4487', 'Nao identificado', '13/12/2022', '13', '12', '2022', '09:17:36', 'Carga descentralizada para a traseira!', '13/12/2022', '09:17:37', 'Tratado', '0', 'Carga Descentralizada'),
(223, '3861', '-', '3601', '442002000000000000001223', 'PRT5381', 'Carreta', '13/12/2022', '13', '12', '2022', '09:41:25', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '09:41:26', 'Tratado', '0', 'Carga Descentralizada'),
(224, '3872', '-', '3663', '442002000000000000001888', 'RUP4E29', 'Carreta', '13/12/2022', '13', '12', '2022', '10:10:51', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '10:10:51', 'Tratado', '0', 'Carga Descentralizada'),
(225, '3890', '-', '3686', '442002000000000000001862', 'RMJ7H57', 'Carreta', '13/12/2022', '13', '12', '2022', '11:26:12', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '11:26:14', 'Tratado', '0', 'Carga Descentralizada'),
(226, '3891', '-', '3688', '442002000000000000001806', 'RMZ1C49', 'Carreta', '13/12/2022', '13', '12', '2022', '11:27:34', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '11:27:36', 'Tratado', '0', 'Carga Descentralizada'),
(227, '3892', '-', '3691', '442002000000000000001912', 'QPX0692', 'Carreta', '13/12/2022', '13', '12', '2022', '11:34:35', 'Carga descentralizada em dois pontos!', '13/12/2022', '11:34:36', 'Tratado', '0', 'Carga Descentralizada'),
(228, '3893', '-', '3694', '442002000000000000001509', 'RMS8I07', 'Carreta', '13/12/2022', '13', '12', '2022', '11:42:53', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '11:42:55', 'Tratado', '0', 'Carga Descentralizada'),
(229, '3895', '-', '3696', '442002000000000000001479', 'QUB6935', 'Carreta', '13/12/2022', '13', '12', '2022', '11:52:14', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '11:52:15', 'Tratado', '0', 'Carga Descentralizada'),
(230, '3918', '-', '3595', '442002000000000000001467', 'RNQ5C49', 'Carreta', '13/12/2022', '13', '12', '2022', '12:50:01', 'Carga descentralizada em dois pontos!', '13/12/2022', '12:50:02', 'Tratado', '0', 'Carga Descentralizada'),
(231, '3933', '-', '3735', '442002000000000000001952', 'RUB6I79', 'Carreta', '13/12/2022', '13', '12', '2022', '13:20:09', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '13:20:11', 'Tratado', '0', 'Carga Descentralizada'),
(234, '3953', '-', '3755', '442002000000000000001515', 'RTG8G43', 'Carreta', '13/12/2022', '13', '12', '2022', '14:40:27', 'Carga descentralizada transversalmente à direita!', '13/12/2022', '14:40:29', 'Tratado', '0', 'Carga Descentralizada'),
(235, '5490', '40032', '3732', '442002000000000000001443', 'QXK3700', 'Carreta', '20/12/2022', '20', '12', '2022', '01:46:13', 'Carga descentralizada para a dianteira!', '20/12/2022', '01:46:14', 'Tratado', '0', 'Carga Descentralizada'),
(236, '6174', '40562', '4121', '442002000000000000001858', 'RND5F68', 'Carreta', '23/12/2022', '23', '12', '2022', '12:23:21', 'Carga descentralizada para a dianteira!', '23/12/2022', '12:23:21', 'Tratado', '0', 'Carga Descentralizada'),
(237, '6200', '-', '4121', '442002000000000000001833', 'RVL9H87', 'Carreta', '23/12/2022', '23', '12', '2022', '13:26:39', 'Carga descentralizada para a dianteira!', '23/12/2022', '13:26:41', 'Tratado', '0', 'Carga Descentralizada'),
(238, '6238', '40624', '4121', '442002000000000000001881', 'RUB6I18', 'Carreta', '23/12/2022', '23', '12', '2022', '15:17:48', 'Carga descentralizada para a dianteira!', '23/12/2022', '15:17:50', 'Tratado', '0', 'Carga Descentralizada'),
(239, '6324', '40685', '4121', '442002000000000000001850', 'RFG3H51', 'Carreta', '23/12/2022', '23', '12', '2022', '22:44:33', 'Carga descentralizada para a dianteira!', '23/12/2022', '22:44:34', 'Tratado', '0', 'Carga Descentralizada'),
(240, '6342', '40698', '4121', '442002000000000000001894', '-', 'Carreta', '24/12/2022', '24', '12', '2022', '00:58:56', 'Carga descentralizada transversalmente à direita!', '24/12/2022', '00:58:56', 'Tratado', '0', 'Carga Descentralizada'),
(241, '6607', '-', '43087', '442002000000000000001874', 'QUN4010', 'Carreta', '26/12/2022', '26', '12', '2022', '16:15:26', 'Carga descentralizada transversalmente à direita!', '26/12/2022', '16:15:27', 'Tratado', '0', 'Carga Descentralizada'),
(242, '6613', '40998', '43093', '442002000000000000001410', 'RTE7G65', 'Nao identificado', '26/12/2022', '26', '12', '2022', '16:31:24', 'Carga descentralizada para a dianteira!', '26/12/2022', '16:31:26', 'Tratado', '0', 'Carga Descentralizada'),
(243, '6656', '41034', '4121', '442002000000000000001756', 'RMG4C29', 'Carreta', '26/12/2022', '26', '12', '2022', '19:54:54', 'Carga descentralizada para a traseira!', '26/12/2022', '19:54:55', 'Tratado', '0', 'Carga Descentralizada'),
(244, '6796', '41161', '50613', '442002000000000000001930', 'QXR2G88', 'Carreta', '27/12/2022', '27', '12', '2022', '10:24:07', 'Carga descentralizada para a dianteira!', '27/12/2022', '10:24:09', 'Tratado', '0', 'Carga Descentralizada'),
(245, '6848', '41231', '39647', '442002000000000000001668', 'RNQ5C60', 'Carreta', '27/12/2022', '27', '12', '2022', '13:59:05', 'Carga descentralizada transversalmente à direita!', '27/12/2022', '13:59:07', 'Tratado', '0', 'Carga Descentralizada'),
(246, '6928', '41314', '51725', '442002000000000000001542', 'LMD4191', 'Carreta', '27/12/2022', '27', '12', '2022', '18:28:42', 'Carga descentralizada para a dianteira!', '27/12/2022', '18:28:44', 'Tratado', '0', 'Carga Descentralizada'),
(247, '6933', '41316', '51728', '442002000000000000001741', 'QXF1208', 'Carreta', '27/12/2022', '27', '12', '2022', '19:25:25', 'Carga descentralizada para a dianteira!', '27/12/2022', '19:25:26', 'Tratado', '0', 'Carga Descentralizada'),
(248, '6942', '41333', '51732', '442002000000000000001239', 'RMJ3D45', 'Carreta', '27/12/2022', '27', '12', '2022', '23:59:16', 'Carga descentralizada transversalmente à direita!', '27/12/2022', '23:59:18', 'Tratado', '0', 'Carga Descentralizada'),
(249, '7068', '41459', '51756', '442002000000000000001934', 'PRR4246', 'Nao identificado', '28/12/2022', '28', '12', '2022', '12:19:54', 'Carga descentralizada transversalmente à direita!', '28/12/2022', '12:19:55', 'Tratado', '0', 'Carga Descentralizada'),
(250, '7135', '41533', '3997', '442002000000000000001834', 'RMQ2A94', 'Carreta', '28/12/2022', '28', '12', '2022', '15:31:19', 'Carga descentralizada para a dianteira!', '28/12/2022', '15:31:20', 'Tratado', '0', 'Carga Descentralizada'),
(251, '7144', '41543', '51771', '442002000000000000001629', 'PRT5361', 'Nao identificado', '28/12/2022', '28', '12', '2022', '16:03:32', 'Carga descentralizada para a dianteira!', '28/12/2022', '16:03:33', 'Tratado', '0', 'Excesso'),
(252, '7154', '-', '51780', '442002000000000000001547', 'RFJ7I64', 'Carreta', '28/12/2022', '28', '12', '2022', '17:44:45', 'Carga descentralizada para a dianteira!', '28/12/2022', '17:44:47', 'Tratado', '0', 'Carga Descentralizada'),
(253, '7157', '41558', '51781', '442002000000000000001855', '-', 'Carreta', '28/12/2022', '28', '12', '2022', '17:50:51', 'Carga descentralizada para a dianteira!', '28/12/2022', '17:50:53', 'Tratado', '0', 'Carga Descentralizada'),
(254, '7221', '41603', '51810', '442002000000000000001878', 'RTX6C47', 'Carreta', '28/12/2022', '28', '12', '2022', '21:22:29', 'Carga descentralizada para a dianteira!', '28/12/2022', '21:22:30', 'Tratado', '0', 'Carga Descentralizada'),
(255, '7263', '41634', '51833', '442002000000000000001379', 'QNH8D07', 'Carreta', '29/12/2022', '29', '12', '2022', '00:51:28', 'Carga descentralizada para a dianteira!', '29/12/2022', '00:51:28', 'Tratado', '0', 'Carga Descentralizada'),
(256, '7428', '41802', '51919', '442002000000000000001439', 'QUS8I06', 'Carreta', '29/12/2022', '29', '12', '2022', '11:31:46', 'Carga descentralizada para a dianteira!', '29/12/2022', '11:31:46', 'Tratado', '0', 'Carga Descentralizada'),
(257, '7452', '-', '51924', '442002000000000000001378', 'QPV3244', 'Nao identificado', '29/12/2022', '29', '12', '2022', '13:22:33', 'Carga descentralizada transversalmente à direita!', '29/12/2022', '13:22:34', 'Tratado', '0', 'Carga Descentralizada'),
(258, '7591', '41968', '4121', '442002000000000000001887', '-', 'Carreta', '29/12/2022', '29', '12', '2022', '20:28:23', 'Carga descentralizada transversalmente à direita!', '29/12/2022', '20:28:24', 'Tratado', '0', 'Carga Descentralizada'),
(259, '7622', '41986', '51819', '442002000000000000001744', '-', 'Carreta', '29/12/2022', '29', '12', '2022', '22:36:16', 'Carga descentralizada transversalmente à direita!', '29/12/2022', '22:36:18', 'Tratado', '0', 'Carga Descentralizada'),
(260, '9700', '43539', '4064', '442002000000000000001389', 'QXR3F95', 'Nao identificado', '13/01/2023', '13', '01', '2023', '10:57:59', 'Carga descentralizada transversalmente à direita!', '13/01/2023', '10:58:00', 'Tratado', '0', 'Carga Descentralizada'),
(261, '9712', '43550', '4121', '442002000000000000002051', 'RUP7A30', 'Nao identificado', '13/01/2023', '13', '01', '2023', '11:49:27', 'Carga descentralizada transversalmente à direita!', '13/01/2023', '11:49:28', 'Tratado', '0', 'Carga Descentralizada'),
(262, '9726', '43566', '52503', '442002000000000000001710', 'QPW8921', 'Carreta', '13/01/2023', '13', '01', '2023', '12:45:46', 'Carga descentralizada transversalmente à direita!', '13/01/2023', '12:45:47', 'Tratado', '0', 'Carga Descentralizada'),
(263, '9729', '43572', '52374', '442002000000000000001241', 'PWH2742', 'Carreta', '13/01/2023', '13', '01', '2023', '13:07:49', 'Carga descentralizada em dois pontos!', '13/01/2023', '13:07:51', 'Tratado', '0', 'Carga Descentralizada'),
(264, '9813', '43722', '52543', '442002000000000000001866', 'QPV3946', 'Carreta', '14/01/2023', '14', '01', '2023', '06:42:57', 'Carga descentralizada transversalmente à direita!', '14/01/2023', '06:42:57', 'Tratado', '0', 'Carga Descentralizada'),
(265, '9828', '43742', '52170', '442002000000000000001660', 'GVQ9C19', 'Carreta', '14/01/2023', '14', '01', '2023', '07:35:25', 'Carga descentralizada transversalmente à direita!', '14/01/2023', '07:35:26', 'Tratado', '0', 'Carga Descentralizada'),
(266, '9840', '43767', '52109', '442002000000000000001408', 'PWB7434', 'Carreta', '14/01/2023', '14', '01', '2023', '10:00:45', 'Carga descentralizada para a dianteira!', '14/01/2023', '10:00:47', 'Tratado', '0', 'Carga Descentralizada'),
(267, '9938', '43910', '52715', '442002000000000000001700', 'RTO8D09', 'Carreta', '15/01/2023', '15', '01', '2023', '09:36:45', 'Carga descentralizada transversalmente à direita!', '15/01/2023', '09:36:47', 'Tratado', '0', 'Carga Descentralizada'),
(268, '9962', '43950', '52699', '442002000000000000001892', '-', 'Carreta', '15/01/2023', '15', '01', '2023', '15:28:06', 'Carga descentralizada para a dianteira!', '15/01/2023', '15:28:06', 'Tratado', '0', 'Carga Descentralizada'),
(269, '9966', '43952', '52710', '442002000000000000001933', 'RTX6D31', 'Nao identificado', '15/01/2023', '15', '01', '2023', '15:48:23', 'Carga descentralizada para a dianteira!', '15/01/2023', '15:48:23', 'Tratado', '0', 'Carga Descentralizada'),
(270, '10106', '44134', '52830', '442002000000000000001337', 'PRR4076', 'Nao identificado', '16/01/2023', '16', '01', '2023', '13:28:59', 'Carga descentralizada transversalmente à direita!', '16/01/2023', '13:28:59', 'Tratado', '0', 'Carga Descentralizada'),
(271, '10113', '44144', '52578', '442002000000000000001490', 'QXX2H86', 'Carreta', '16/01/2023', '16', '01', '2023', '13:56:45', 'Carga descentralizada transversalmente à direita!', '16/01/2023', '13:56:46', 'Tratado', '0', 'Carga Descentralizada'),
(272, '10116', '44146', '52263', '442002000000000000001590', 'QXR2G93', 'Nao identificado', '16/01/2023', '16', '01', '2023', '14:10:06', 'Carga descentralizada transversalmente à direita!', '16/01/2023', '14:10:06', 'Tratado', '0', 'Carga Descentralizada'),
(273, '10117', '44149', '52831', '442002000000000000001943', 'RTX6D37', 'Nao identificado', '16/01/2023', '16', '01', '2023', '14:16:33', 'Carga descentralizada para a dianteira!', '16/01/2023', '14:16:35', 'Tratado', '0', 'Carga Descentralizada'),
(274, '10162', '44208', '52839', '442002000000000000001659', 'OPY1132', 'Carreta', '16/01/2023', '16', '01', '2023', '16:38:42', 'Carga descentralizada transversalmente à direita!', '16/01/2023', '16:38:42', 'Tratado', '0', 'Carga Descentralizada'),
(275, '10255', '44323', '52828', '442002000000000000001613', 'PRR4196', 'Carreta', '17/01/2023', '17', '01', '2023', '07:08:34', 'Carga descentralizada para a dianteira!', '17/01/2023', '07:08:35', 'Tratado', '0', 'Carga Descentralizada'),
(276, '10273', '44340', '52894', '442002000000000000001499', 'QOM9187', 'Carreta', '17/01/2023', '17', '01', '2023', '07:44:47', 'Carga descentralizada transversalmente à direita!', '17/01/2023', '07:44:47', 'Tratado', '0', 'Carga Descentralizada'),
(277, '10286', '44364', '52549', '442002000000000000001393', 'HJD3044', 'Carreta', '17/01/2023', '17', '01', '2023', '09:27:55', 'Carga descentralizada para a dianteira!', '17/01/2023', '09:27:56', 'Tratado', '0', 'Carga Descentralizada');

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

--
-- Extraindo dados da tabela `lista_tags`
--

INSERT INTO `lista_tags` (`id`, `placa`, `estado`, `tipo`, `parte`, `tag`, `nome`, `cod_sap`, `link`) VALUES
(1, 'OUF6358', 'BA', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000002984', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(2, 'QUB6935', 'MA', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001479', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(3, 'PUH1690', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002141', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(4, 'GXE6100', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003295', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(5, 'LLI6194', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003194', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(6, 'DBL8816', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003171', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(7, 'ORC3324', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003163', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(8, 'HHH5900', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001331', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(9, 'QXI4455', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002266', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(10, 'MRP6088', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003198', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(11, 'PXI0708', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002468', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(12, 'QWU9000', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003124', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(13, 'QWU0450', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003122', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(14, 'QQB5712', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003115', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(15, 'QNZ7375', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003114', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(16, 'QNQ0460', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003113', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(17, 'QQO4500', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002985', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(18, 'OPF9584', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003154', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(19, 'OOE9530', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003152', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(20, 'OCX0008', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003173', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(21, 'FTE2083', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003165', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(22, 'KGP9428', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003164', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(23, 'QWW4600', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003160', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(24, 'QWW4000', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003159', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(25, 'QWW2000', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003158', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(26, 'QPZ7797', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003157', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(27, 'QNZ7379', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003156', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(28, 'KXB5571', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003150', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(29, 'EZU1625', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003147', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(30, 'OOC9530', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003137', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(31, 'QQD2971', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002018', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(32, 'QNY7950', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002142', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(33, 'PVN5352', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003128', 'RLR TRANSPORTES LTDA', '100400792', 'AGREGADO'),
(34, 'PWH2737', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000203', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(35, 'QWX9800', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002009', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(36, 'QUC1083', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002288', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(37, 'QXC8092', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002274', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(38, 'BUD7658', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002994', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(39, 'QUV6638', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003201', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(40, 'QNQ7300', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003181', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(41, 'GVQ7100', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003138', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(42, 'QWU0500', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003123', 'RLR TRANSPORTES LTDA', '100400792', 'TERCEIRO'),
(43, 'DBL4882', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003078', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(44, 'LPY6046', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003077', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(45, 'DDD1111', 'MG', 'Bi-Truck - 4 eixos', 'Carreta', '442002000000000000001395', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(46, 'QOV6277', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001662', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(47, 'PZP7998', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001441', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(48, 'QOK4517', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001873', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(49, 'QQI2557', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001563', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(50, 'QPN0572', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001867', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(51, 'QWV7787', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001245', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(52, 'AVD9387', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001461', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(53, 'OQD8222', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001435', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(54, 'QPX1376', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001868', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(55, 'QOA2510', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001702', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(56, 'OPY6918', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001473', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(57, 'PUH9544', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001317', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(58, 'QPV3946', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001866', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(59, 'QWS3429', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001484', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(60, 'QXK3700', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001443', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(61, 'QPG3365', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001864', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(62, 'RFE6I56', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002471', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(63, 'HOC6E86', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003195', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(64, 'HGE4E06', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003192', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(65, 'QOX4F55', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003188', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(66, 'QQS1F66', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001780', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(67, 'OPL9A54', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003109', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(68, 'HHK3H79', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003190', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(69, 'QXT3H59', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003099', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(70, 'QXK8D68', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002814', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(71, 'RNP6C92', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002926', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(72, 'RNB1E07', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002933', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(73, 'RTC7E28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002934', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(74, 'RMZ1C51', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002931', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(75, 'LPW4F90', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003204', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(76, 'RNX8F37', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002886', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(77, 'QDG4B61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002525', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(78, 'RMW1C10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002928', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(79, 'RMH7B47', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002802', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(80, 'RNX8F36', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002887', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(81, 'RNX8F39', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002893', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(82, 'QWU7I11', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001722', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(83, 'RNX6F58', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002930', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(84, 'RNI9A80', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002932', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(85, 'RTC7E25', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002929', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(86, 'RFA0J96', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003193', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(87, 'RMQ8D54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003047', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(88, 'RMW1B93', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002935', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(89, 'QWW0I08', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002637', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(90, 'OPX5H59', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002690', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(91, 'RNH9H23', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002927', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(92, 'REA9I65', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000002883', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(93, 'AVW9D48', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000002815', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(94, 'RTU4C47', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001459', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(95, 'GYI8D58', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001693', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(96, 'RNH8E83', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001937', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(97, 'QXZ1C37', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001489', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(98, 'RFX0I54', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001938', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(99, 'RNR9G37', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001442', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(100, 'OOV1E49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001863', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(101, 'QXA5A97', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000555', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(102, 'PVH5E07', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001252', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(103, 'RFH3C21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001944', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(104, 'FOY8I04', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001870', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(105, 'RNQ9H10', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001364', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(106, 'PYK1H29', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001939', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(107, 'RFM2D65', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001936', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(108, 'RNC3I31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001246', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(109, 'RFF4A18', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001274', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(110, 'RMH7B52', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001508', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(111, 'RNQ6D08', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001460', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(112, 'FYV3B71', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001865', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(113, 'RND5C37', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001732', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(114, 'RMT2G54', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001222', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(115, 'RNX9I01', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001725', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(116, 'QXV6F93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001423', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(117, 'RFS9C81', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001617', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'AGREGADO'),
(118, 'RMZ2H14', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001367', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(119, 'FQA0C25', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001871', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(120, 'CQU1G84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001869', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(121, 'DKH7J42', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001872', 'EMPREENDIMENTOS RODEIRO SA', '100147461', 'FROTA'),
(122, 'RTQ0F64', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001920', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(123, 'RMP4B07', 'BR', 'Centopeia', 'Carreta', '442002000000000000001519', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(124, 'RUC1G24', 'BR', 'Centopeia', 'Carreta', '442002000000000000001445', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(125, 'RUE4J35', 'BR', 'Centopeia', 'Carreta', '442002000000000000001418', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(126, 'RUC1G29', 'BR', 'Centopeia', 'Carreta', '442002000000000000001537', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(127, 'RFM8G43', 'BR', 'Centopeia', 'Carreta', '442002000000000000001498', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(128, 'RFD7F57', 'BR', 'Centopeia', 'Carreta', '442002000000000000001449', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(129, 'RMS8H79', 'BR', 'Centopeia', 'Carreta', '442002000000000000001501', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(130, 'RUB8G98', 'BR', 'Centopeia', 'Carreta', '442002000000000000001528', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(131, 'RUC1G27', 'BR', 'Centopeia', 'Carreta', '442002000000000000001533', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(132, 'RNH3D60', 'BR', 'Centopeia', 'Carreta', '442002000000000000001496', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(133, 'RUC1G31', 'BR', 'Centopeia', 'Carreta', '442002000000000000001530', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(134, 'RNG2D69', 'BR', 'Centopeia', 'Carreta', '442002000000000000001904', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(135, 'RNG2D72', 'BR', 'Centopeia', 'Carreta', '442002000000000000001910', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(136, 'RNM3E16', 'BR', 'Centopeia', 'Carreta', '442002000000000000001726', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(137, 'RNH1J75', 'BR', 'Centopeia', 'Carreta', '442002000000000000001948', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(138, 'RUJ4B76', 'BR', 'Centopeia', 'Carreta', '442002000000000000001526', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(139, 'RNG2D52', 'BR', 'Centopeia', 'Carreta', '442002000000000000001909', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(140, 'RFF4A07', 'BR', 'Centopeia', 'Carreta', '442002000000000000001695', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(141, 'RUP8B50', 'BR', 'Centopeia', 'Carreta', '442002000000000000001532', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(142, 'RUP8B63', 'BR', 'Centopeia', 'Carreta', '442002000000000000001534', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(143, 'RUE4J38', 'BR', 'Centopeia', 'Carreta', '442002000000000000001525', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(144, 'RUJ4B79', 'BR', 'Centopeia', 'Carreta', '442002000000000000001535', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(145, 'RNM3E17', 'BR', 'Centopeia', 'Carreta', '442002000000000000001727', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(146, 'RNG2D59', 'BR', 'Centopeia', 'Carreta', '442002000000000000001911', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(147, 'RNM3E15', 'BR', 'Centopeia', 'Carreta', '442002000000000000001436', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(148, 'HJD3A53', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003183', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(149, 'QPT0I86', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002990', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(150, 'MRZ2J98', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002983', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(151, 'RUD1B78', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002991', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(152, 'HFD4D41', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003121', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(153, 'EZU2B10', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003149', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(154, 'HJZ2B32', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003094', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(155, 'GVE8B81', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003184', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(156, 'PUP5F48', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003155', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(157, 'HJZ0G04', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003142', 'RLR TRANSPORTES LTDA', '100400792', 'AGREGADO'),
(158, 'PUR5F34', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003131', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(159, 'PGG8H17', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003085', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(160, 'RUC9I08', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002987', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(161, 'RTX3B56', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002993', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(162, 'QNS1H00', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003185', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(163, 'RFC1I73', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003180', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(164, 'RTK6G80', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002992', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(165, 'RFE0A73', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003179', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(166, 'DBL4I96', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003178', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(167, 'RMY7H15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003064', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(168, 'RMY7H21', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003063', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(169, 'RMW4I74', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003062', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(170, 'RMW4I63', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003060', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(171, 'HIJ3J51', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003089', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(172, 'NRZ2F19', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003151', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(173, 'NWM2F84', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003169', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(174, 'OPQ0F98', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003129', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(175, 'RMW4I84', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003059', 'RLR TRANSPORTES LTDA', '100400792', 'AGREGADO'),
(176, 'RMV1G33', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003057', 'RLR TRANSPORTES LTDA', '100400792', 'TERCEIRO'),
(177, 'RTX3B48', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003076', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(178, 'RUC9I17', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003168', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(179, 'MEQ6D27', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002982', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(180, 'MYT8F62', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003139', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(181, 'LQK7G73', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003132', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(182, 'HOA1G01', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003175', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(183, 'KXH5B27', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003172', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(184, 'RMX6A63', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003167', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(185, 'OPF9F87', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003153', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(186, 'EZU1G38', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003148', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(187, 'ACS2F59', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003145', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(188, 'OMY4E89', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003071', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(189, 'OLC9B31', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003070', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(190, 'RMY7H16', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003068', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(191, 'RMY7H08', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003067', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(192, 'EOE1J12', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003146', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(193, 'RMY5C47', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003066', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(194, 'GDW3J89', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003073', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(195, 'GYS2G22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003199', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(196, 'HDM7F27', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003200', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(197, 'RMY7H19', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003065', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(198, 'RFT5C74', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003095', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(199, 'RNV4D13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003093', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(200, 'RFF6E93', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003091', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(201, 'OWK6J81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003090', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(202, 'HBN6A43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003088', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(203, 'OWL6A97', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003087', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(204, 'RNV4D06', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003086', 'RLR TRANSPORTES LTDA', '100400792', 'TERCEIRO'),
(205, 'EOE1J21', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003083', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(206, 'HMV2B25', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003082', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(207, 'PXO3H48', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003081', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(208, 'RNP6H01', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003079', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(209, 'NYY0G11', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003075', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(210, 'QPT0I90', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003074', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(211, 'OMI7C04', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003072', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(212, 'HIV0E00', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003112', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(213, 'QWW3A00', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003116', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(214, 'RMI6A16', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003120', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(215, 'RMF3I15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003125', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(216, 'RMI6A15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003126', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(217, 'RMI6A17', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003127', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(218, 'RFA6G76', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003056', 'RLR TRANSPORTES LTDA', '100400792', 'AGREGADO'),
(219, 'HIJ0E10', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003058', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(220, 'HBG5A87', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003140', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(221, 'RFC4C29', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003117', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(222, 'RFC1I83', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003161', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(223, 'RFC4C27', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003162', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(224, 'RUI1D13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003211', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(225, 'RUI7C22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003027', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(226, 'RUI4A50', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003017', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(227, 'RGA4F28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002855', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(228, 'RFZ6D74', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002836', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(229, 'RUI1D33', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003010', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(230, 'RUI4B78', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003016', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(231, 'RUI6A54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003018', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(232, 'RUI1D26', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003215', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(233, 'RUI1D30', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002906', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(234, 'RUI1D28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002907', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(235, 'RUI6A51', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003032', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(236, 'RUI1D18', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002908', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(237, 'RUI7C27', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003022', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(238, 'RUI7B23', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003021', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(239, 'RUI4B83', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003006', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(240, 'RUI7C26', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003028', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(241, 'RUI4A76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003019', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(242, 'RUI4B82', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003014', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(243, 'RFZ6D57', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002858', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(244, 'RFZ6D76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002905', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(245, 'RUI4B93', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003007', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(246, 'RUI4A10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003236', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(247, 'RUI1D15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003213', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(248, 'RUI3J93', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003235', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(249, 'RUI1D23', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003212', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(250, 'RUI1D32', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003011', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(251, 'RUI8B28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003024', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(252, 'RUI1D24', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002910', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(253, 'RUI4B96', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003008', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(254, 'RUI7C18', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003026', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(255, 'RUI7B21', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003029', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(256, 'RUI3I93', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003234', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(257, 'RUI4A20', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003237', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(258, 'RFZ6D53', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002522', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(259, 'RUI7C25', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003030', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(260, 'RUI4B72', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003015', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(261, 'RUI3J96', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003013', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(262, 'RUI1D34', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003009', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(263, 'RUI7B73', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003031', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(264, 'RGC8J04', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002871', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(265, 'RUI6A50', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003012', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(266, 'RUI1D22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003214', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(267, 'RUI7C24', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003025', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(268, 'RUI7C54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003020', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(269, 'RUI1D21', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002909', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(270, 'RFZ6D77', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002835', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(271, 'RUI7C56', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003023', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(272, 'RFZ6D71', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002830', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(273, 'RGC5E52', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002861', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(274, 'RUI4B63', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003238', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(275, 'RTX6B54', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001946', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(276, 'RTT3I09', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001558', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(277, 'RTS6B30', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001951', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(278, 'RTT4F70', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001916', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(279, 'RTX6C65', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001876', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(280, 'RTT3H97', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001924', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(281, 'RTK2C19', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001902', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(282, 'RTS6B28', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001377', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(283, 'RTX6C42', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001883', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(284, 'RTX6I84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001880', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(285, 'RTX6D40', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001884', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(286, 'RTY4B75', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001935', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(287, 'RTX6C47', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001878', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(288, 'RTT3I07', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001619', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(289, 'RTS6B24', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001620', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(290, 'RTS8C21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001486', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(291, 'RTX6D34', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001900', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(292, 'RUB6I79', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001952', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(293, 'RTX6D31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001933', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(294, 'RTX6C34', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001877', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(295, 'RTX6B43', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001932', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(296, 'RTT3I10', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001352', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(297, 'RTX6D37', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001943', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(298, 'RTX6C45', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001899', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(299, 'RTX6C31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001875', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(300, 'RTX6C28', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001927', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(301, 'RTT3I12', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001926', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(302, 'RTT3H99', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001919', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(303, 'RTX6B48', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001941', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(304, 'RTS6B31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001380', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(305, 'RTT4F64', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001582', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(306, 'RUB6I18', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001881', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(307, 'RUB6I30', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001882', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(308, 'QUH6170', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001771', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(309, 'QPY7482', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002341', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(310, 'QUH7737', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002436', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(311, 'GYI8020', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003104', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(312, 'QUI2043', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001768', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(313, 'QUH7736', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003050', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(314, 'QUH7736', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003050', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(315, 'HEH7133', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002642', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(316, 'QUH6199', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001772', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(317, 'QPY1240', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002890', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(318, 'QPW2683', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002180', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(319, 'QQZ2909', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002892', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(320, 'QXL9530', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002286', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(321, 'QPL5814', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002272', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(322, 'GXX8249', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002104', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(323, 'OOZ2733', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002603', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA');
INSERT INTO `lista_tags` (`id`, `placa`, `estado`, `tipo`, `parte`, `tag`, `nome`, `cod_sap`, `link`) VALUES
(324, 'OQP5508', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003133', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(325, 'QPP3783', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002891', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(326, 'OQI3458', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002881', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'AGREGADO'),
(327, 'QQE0674', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002148', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(328, 'QQE0674', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002148', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(329, 'QQE0674', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002148', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(330, 'AYM9874', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001796', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(331, 'QQD3024', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002849', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(332, 'PWM6799', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002913', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(333, 'PWM6799', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002913', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(334, 'QPQ1307', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001558', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(335, 'QPQ1307', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001558', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(336, 'HIA8900', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003130', 'RLR TRANSPORTES LTDA', '100400792', 'AGREGADO'),
(337, 'ONT8888', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003177', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(338, 'FXP4329', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003080', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(339, 'MIG5149', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003166', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(340, 'QXC2904', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000002634', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(341, 'QXC2904', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000002634', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(342, 'PWW0928', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001681', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(343, 'PWW0928', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001681', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(344, 'PWM6792', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001504', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(345, 'QNC1187', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001466', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(346, 'QNC1187', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001466', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(347, 'QNC1187', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001466', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(348, 'QNH7832', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001736', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(349, 'QNV4966', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001704', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(350, 'QPW2701', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001036', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(351, 'QUO2624', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001204', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(352, 'QPL5813', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001375', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(353, 'LMD4191', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001542', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(354, 'QPQ2168', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001011', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(355, 'QOK4447', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001728', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(356, 'QOI5640', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000158', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(357, 'QOI5640', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000158', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(358, 'QUC7899', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001485', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(359, 'OMH7663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001593', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(360, 'OMH7663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001593', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(361, 'OMH7663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001593', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(362, 'OMH7663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001593', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(363, 'OMH7663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001593', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(364, 'OPY1166', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001244', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(365, 'QUC7903', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001314', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(366, 'QUC7903', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001314', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(367, 'QQG0152', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000560', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(368, 'QUK0208', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001348', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(369, 'QOM3617', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001723', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(370, 'QQE3025', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001276', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(371, 'HEH7083', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001580', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(372, 'OMH7664', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001594', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(373, 'QUO0214', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001270', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(374, 'QPY8990', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001417', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(375, 'PUG8821', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001647', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(376, 'PUP0660', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001640', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(377, 'QOI2523', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001405', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(378, 'QPS4836', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001413', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(379, 'QQG3840', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001271', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(380, 'QOK4551', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001507', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(381, 'PUG3J22', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003092', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(382, 'QXR8G03', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002889', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(383, 'PZN2G79', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002385', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(384, 'PZN2G79', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002385', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(385, 'MLJ5F52', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003102', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(386, 'QXX4G35', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002452', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(387, 'RFD1B68', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002698', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(388, 'RFA8A75', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002054', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(389, 'RFC9F09', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002443', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(390, 'RNX8D64', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002888', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(391, 'RNT7D92', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002894', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(392, 'RFG6J88', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003191', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(393, 'QXR2G84', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002608', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(394, 'QXR2G83', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002600', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(395, 'QXR2G79', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002599', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(396, 'RNO6H34', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002511', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(397, 'RNO6H38', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002510', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(398, 'RFK7J61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002535', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(399, 'RFK7J61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002535', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(400, 'RNT7D86', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002895', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(401, 'QPM7C73', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002055', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(402, 'ECM7G58', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003187', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(403, 'GVE8E96', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003135', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(404, 'RMY7H24', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003069', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(405, 'RFZ7G47', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003119', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(406, 'RMT2F01', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003170', 'RLR TRANSPORTES LTDA', '100400792', 'TERCEIRO'),
(407, 'RFM9D84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001604', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(408, 'OWQ1I06', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001666', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(409, 'RGD5F23', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001323', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(410, 'QXR2G91', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001598', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(411, 'QXR2G91', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001598', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(412, 'QXR2G91', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001598', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(413, 'QNH8D07', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001379', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(414, 'QXR2G94', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001592', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(415, 'RFT6I68', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001627', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(416, 'HFD5G53', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001470', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(417, 'RFM9D89', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001652', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(418, 'RFE1D57', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001463', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(419, 'HJF6D52', 'BR', 'Traçado', 'Carreta', '442002000000000000001531', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(420, 'RNH3E00', 'BR', 'Centopeia', 'Carreta', '442002000000000000001529', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(421, 'RNM3A57', 'BR', 'Centopeia', 'Carreta', '442002000000000000001522', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(422, 'RNG2D63', 'BR', 'Centopeia', 'Carreta', '442002000000000000001947', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(423, 'RNG2D63', 'BR', 'Centopeia', 'Carreta', '442002000000000000001947', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(424, 'RNI3G96', 'BR', 'Centopeia', 'Carreta', '442002000000000000001518', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(425, 'QXX2H81', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002309', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(426, 'QNS1G96', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003143', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(427, 'RFD1B68', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002698', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(428, 'RFC9F09', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002443', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(429, 'RFH2B20', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002112', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(430, 'RTQ9F85', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003038', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(431, 'RTQ9F91', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003040', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(432, 'QXT3J43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002537', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(433, 'QXT3J43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002537', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(434, 'QXT3J43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002537', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(435, 'QXR2G81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002609', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(436, 'QXR2G81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002609', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(437, 'QXR2G81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002609', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(438, 'RTQ9F90', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003043', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(439, 'RFD6E78', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002109', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(440, 'QXR2G79', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002599', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(441, 'RNO6H38', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002510', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(442, 'RTQ9F86', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003041', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(443, 'RTU3E91', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003042', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(444, 'RFK7J61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002535', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(445, 'RTV5H06', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002901', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(446, 'RMW9G19', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003061', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(447, 'RTS0J22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003036', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(448, 'RTU2B89', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003037', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(449, 'RFC4C30', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000003118', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(450, 'RFM9D84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001604', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(451, 'RNV5B56', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001696', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(452, 'RNB6D61', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001427', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(453, 'QXR2G91', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001598', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(454, 'QXX2H86', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001490', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(455, 'QXR2G93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001590', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(456, 'QNH8D07', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001379', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(457, 'QXX2H84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001301', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(458, 'RNV5B54', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001694', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(459, 'RNV5B54', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001694', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(460, 'QXR2G94', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001592', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(461, 'RNV5B63', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001513', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(462, 'RFU9A50', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001707', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(463, 'RNV5B61', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001699', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(464, 'RNV5B59', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001701', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(465, 'RMS7F48', 'BR', 'Centopeia', 'Carreta', '442002000000000000001918', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(466, 'RMT9G39', 'BR', 'Centopeia', 'Carreta', '442002000000000000001632', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(467, 'RMW4A18', 'BR', 'Centopeia', 'Carreta', '442002000000000000001491', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(468, 'RNG2D63', 'BR', 'Centopeia', 'Carreta', '442002000000000000001947', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(469, 'QUH6170', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001771', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(470, 'QUH7737', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002436', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(471, 'GYI8020', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003104', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(472, 'GYI8020', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003104', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(473, 'QUI2043', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001768', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(474, 'QPY7503', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003052', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(475, 'HFD2133', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003141', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(476, 'QUH7736', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003050', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(477, 'HAR1815', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002583', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(478, 'HAR1815', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002583', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(479, 'QUH6199', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001772', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(480, 'QQE0903', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002813', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(481, 'QQE0903', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002813', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(482, 'QPY1240', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002890', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(483, 'QUH6197', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002057', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(484, 'QUH6197', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002057', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(485, 'HBG7899', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002411', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'AGREGADO'),
(486, 'QPL5814', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002272', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(487, 'OPJ6806', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001761', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(488, 'GXX8249', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002104', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(489, 'QQE0674', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002148', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(490, 'QPO5523', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002021', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(491, 'QXE3680', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002344', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(492, 'AYM9874', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001796', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(493, 'AYM9874', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001796', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(494, 'QQD3024', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002849', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(495, 'QPQ1307', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001558', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(496, 'QQN2011', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003084', 'RLR TRANSPORTES LTDA', '100400792', 'TERCEIRO'),
(497, 'KVK1672', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003144', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(498, 'QXC2904', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000002634', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(499, 'QXC2904', 'MG', 'Cavalo mecânico traçado - 3 eixos', 'Cavalo', '442001000000000000002634', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(500, 'PWW0928', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001681', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(501, 'PWW0928', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001681', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(502, 'PWM6792', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001504', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(503, 'PWM6792', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001504', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(504, 'QUN5937', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001553', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(505, 'QUN5937', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001553', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(506, 'QUN5937', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001553', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(507, 'QPY8986', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001265', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(508, 'QNC1187', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001466', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(509, 'QNH7832', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001736', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(510, 'QNH7832', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001736', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(511, 'QQS1574', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001299', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(512, 'QXF1208', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001741', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(513, 'QNV4966', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001704', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(514, 'QPW2701', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001036', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(515, 'QUO2624', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001204', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(516, 'QPL5813', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001375', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(517, 'QPQ2168', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001011', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(518, 'GXS9449', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001586', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(519, 'QOK4447', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001728', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(520, 'QUC7899', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001485', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(521, 'QUC7897', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001478', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(522, 'QUK0208', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001348', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(523, 'QOM3617', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001723', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(524, 'QQE3025', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001276', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(525, 'QQE3025', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001276', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(526, 'QQE3025', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001276', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(527, 'QUO0215', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001264', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(528, 'HIJ6292', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001550', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(529, 'HIJ6292', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001550', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(530, 'HIJ6292', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001550', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(531, 'HIJ6292', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001550', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(532, 'QUK0206', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001310', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(533, 'QUK0206', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001310', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(534, 'OMH7664', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001594', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(535, 'QUO0214', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001270', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(536, 'QUN5942', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001262', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(537, 'QOA2501', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001387', 'L L TRANSPORTES LTDA', '100189599', 'FROTA'),
(538, 'QOA2501', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001387', 'L L TRANSPORTES LTDA', '100189599', 'FROTA'),
(539, 'QPS4836', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001413', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(540, 'HFI5862', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001471', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(541, 'HFI5862', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001471', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(542, 'QQE3037', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001610', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(543, 'QQE3037', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001610', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(544, 'QQE3037', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001610', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(545, 'QQE3037', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001610', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(546, 'QOK4551', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001507', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(547, 'RGB1D85', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002877', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(548, 'RFZ6D61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002824', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(549, 'RGA4F62', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003110', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(550, 'RFZ6D56', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002827', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(551, 'RGA8B03', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002826', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(552, 'RGC7B18', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002878', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(553, 'RGA4F50', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002866', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(554, 'RGC7B23', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003035', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(555, 'RFZ8J51', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002839', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(556, 'RGC9F74', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002842', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(557, 'RGA8B15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002860', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(558, 'RGC7B22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002867', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(559, 'RGC7B22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002867', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(560, 'RGA4F65', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002821', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(561, 'RGC7B24', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002523', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(562, 'RFZ6H11', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002865', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(563, 'RGC7B19', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002885', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(564, 'RGC5E21', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002875', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(565, 'RFZ6D55', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002828', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(566, 'RGC9F76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002868', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(567, 'RGC9F76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002868', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(568, 'RGC8D92', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002864', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(569, 'RFZ6H10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002825', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(570, 'RFZ6H10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002825', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(571, 'RFZ6H10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002825', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(572, 'RFZ6H02', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002819', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(573, 'RGA4F47', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002874', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(574, 'RGC9F83', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002863', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(575, 'RGB1E28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002862', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(576, 'RGB1E28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002862', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(577, 'PRU6065', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001281', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(578, 'PRU6065', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001281', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(579, 'PRU6065', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001281', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(580, 'PRU6065', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001281', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(581, 'PRR4236', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001658', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(582, 'PRU5985', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001419', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(583, 'PRU5985', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001419', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(584, 'PRR4086', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001690', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(585, 'PRR4086', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001690', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(586, 'PRR4076', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001337', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(587, 'PRR4076', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001337', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(588, 'PRR4076', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001337', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(589, 'PRR4946', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001953', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(590, 'PRR4196', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001613', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(591, 'RTX6C58', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001879', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(592, 'PRR4136', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001514', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(593, 'PRR4066', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001242', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(594, 'PRT5421', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001365', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(595, 'PRT5331', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001411', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(596, 'PRT5331', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001411', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(597, 'PRT5321', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001482', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(598, 'PRR4056', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001353', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(599, 'PRR4056', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001353', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(600, 'PRR4146', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001609', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(601, 'PRR4146', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001609', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(602, 'PRR4146', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001609', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(603, 'PRR4276', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001354', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(604, 'PRR4276', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001354', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(605, 'PRT5381', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001223', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(606, 'PRU5945', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001366', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(607, 'PRT5301', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001656', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(608, 'RFZ6D61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002824', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(609, 'RGA3F25', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002857', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(610, 'RGC5E22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002843', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(611, 'RGA4F62', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003110', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(612, 'RGA4F43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002831', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(613, 'RFZ6D56', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002827', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(614, 'RFZ8J56', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002833', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(615, 'RGA4F39', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002829', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(616, 'RGC5F15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002873', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(617, 'RGA8B03', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002826', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(618, 'RGB1D75', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002856', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(619, 'RGA4F50', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002866', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(620, 'RGC7B23', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003035', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(621, 'RFZ8J51', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002839', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(622, 'RGB1D81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002822', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(623, 'RGC9F74', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002842', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(624, 'RGA8B15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002860', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(625, 'RGC7B22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002867', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(626, 'RFZ6H08', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002840', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(627, 'RGA4F34', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002872', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(628, 'RGA4F57', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002870', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(629, 'RGA4F65', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002821', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(630, 'RGC7B24', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002523', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(631, 'RFZ6H11', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002865', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(632, 'RGC7B19', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002885', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(633, 'RFZ6D54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002832', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(634, 'RGA4F37', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002841', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(635, 'RGC5E21', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002875', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(636, 'RGC5F06', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002808', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(637, 'RGA3F23', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002820', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(638, 'RGB1D68', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002869', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(639, 'RGC9F76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002868', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(640, 'RGC8D92', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002864', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(641, 'RFZ6H10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002825', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(642, 'RGD8J29', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002837', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(643, 'RFZ6H02', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002819', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(644, 'RFZ6H03', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002823', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(645, 'RGA4F47', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002874', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(646, 'RGC9F83', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002863', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(647, 'RGB1E28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002862', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(648, 'RGC5E44', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002838', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(649, 'PRR4106', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001422', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(650, 'PRT5E31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001431', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(651, 'RTH2A88', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001896', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(652, 'PRU6065', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001281', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(653, 'RTE7G67', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001703', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(654, 'PRR4236', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001658', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(655, 'PRU6A35', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001655', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA');
INSERT INTO `lista_tags` (`id`, `placa`, `estado`, `tipo`, `parte`, `tag`, `nome`, `cod_sap`, `link`) VALUES
(656, 'PRU5985', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001419', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(657, 'PRR4086', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001690', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(658, 'PRT5C81', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001665', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(659, 'PRR4156', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001456', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(660, 'RTO8C96', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001541', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(661, 'PRR4946', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001953', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(662, 'RTO4E35', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001905', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(663, 'PRR4196', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001613', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(664, 'RTO8D03', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001906', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(665, 'RTE7G65', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001410', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(666, 'PRR4176', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001437', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(667, 'PRR4136', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001514', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(668, 'PRU5J55', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001433', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(669, 'RTO4E19', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001475', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(670, 'PRR4226', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001243', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(671, 'PRT5361', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001629', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(672, 'PRR4066', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001242', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(673, 'RTG8G43', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001515', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(674, 'PRT5421', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001365', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(675, 'RTO4E74', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001742', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(676, 'PRT5331', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001411', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(677, 'PRT5321', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001482', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(678, 'PRR4056', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001353', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(679, 'PRR4146', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001609', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(680, 'PRR4146', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001609', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(681, 'PRU6A95', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001554', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(682, 'PRU5975', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001477', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(683, 'PRR4276', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001354', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(684, 'PRT5381', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001223', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(685, 'PRR4C56', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001481', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(686, 'PRR4166', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001565', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(687, 'PRU5945', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001366', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(688, 'PRU5945', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001366', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(689, 'PRR4C16', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001733', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(690, 'PRR4246', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001934', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(691, 'RTO4D80', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001921', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(692, 'PRT5301', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001656', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(693, 'RTO4D66', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001745', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(694, 'RTO8D09', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001700', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(695, 'QXR8G03', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002889', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(696, 'HFZ7I21', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002816', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(697, 'QXX4G35', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002452', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(698, 'QXX4G35', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002452', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(699, 'HMF0C57', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002671', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(700, 'HMF0C57', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002671', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(701, 'RFD1B68', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002698', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(702, 'RFA8A75', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002054', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(703, 'RFK7J59', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002801', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(704, 'RFC9F09', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002443', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(705, 'RFH2B20', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002112', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(706, 'RFK7J58', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002520', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(707, 'QXT3J43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002537', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(708, 'RFG6J88', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003191', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(709, 'RGA8B03', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002826', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(710, 'QXR2G84', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002608', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(711, 'QXR2G81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002609', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(712, 'QXR2G81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002609', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(713, 'RFK7J60', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002446', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(714, 'RFK7J60', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002446', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(715, 'QXR2G83', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002600', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(716, 'QXR2G79', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002599', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(717, 'RFZ6D54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002832', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(718, 'RNO6H34', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002511', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(719, 'RNO6H38', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002510', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(720, 'RFK7J61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002535', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(721, 'RFZ6H10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002825', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(722, 'RGD8J29', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002837', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(723, 'RFZ6D67', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002834', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(724, 'OTS9J93', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003134', 'RLR TRANSPORTES LTDA', '100400792', 'FROTA'),
(725, 'RFE2G15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002444', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(726, 'QXZ4H48', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002382', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(727, 'RFE4B64', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002242', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(728, 'RGC5E44', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002838', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(729, 'PRR4106', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001422', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(730, 'PRU6065', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001281', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(731, 'PRU6065', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001281', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(732, 'PRR4236', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001658', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(733, 'PRR4236', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001658', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(734, 'PRU5985', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001419', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(735, 'PRU5985', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001419', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(736, 'PRR4086', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001690', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(737, 'RFU9A67', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001716', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(738, 'RFM9D84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001604', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(739, 'RFX0A89', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001446', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(740, 'PRR4076', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001337', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(741, 'PRR4156', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001456', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(742, 'PRR4946', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001953', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(743, 'RFJ7I64', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001547', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(744, 'PRR4196', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001613', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(745, 'PRR4176', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001437', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(746, 'QXR2G88', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001930', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(747, 'PRR4136', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001514', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(748, 'PRR4226', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001243', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(749, 'OWQ1I06', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001666', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(750, 'PRT5361', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001629', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(751, 'PRR4066', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001242', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(752, 'PRT5331', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001411', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(753, 'PRT5331', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001411', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(754, 'PRT5331', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001411', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(755, 'PRT5321', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001482', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(756, 'PRR4146', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001609', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(757, 'PRR4146', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001609', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(758, 'PRR4276', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001354', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(759, 'PRT5381', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001223', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(760, 'RNB6D61', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001427', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(761, 'QXR2G91', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001598', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(762, 'QXR2G91', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001598', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(763, 'FJA4G21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001384', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(764, 'PRR4166', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001565', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(765, 'PRR4166', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001565', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(766, 'QXR2G93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001590', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(767, 'QXR2G93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001590', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(768, 'QXR2G93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001590', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(769, 'QNC1B80', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001689', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(770, 'PRT5411', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001712', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(771, 'PRT5411', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001712', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(772, 'RNS7E86', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001543', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(773, 'PRU5945', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001366', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(774, 'QXR2G94', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001592', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(775, 'QXR2G94', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001592', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(776, 'QXR2G94', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001592', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(777, 'PRR4246', 'GO', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001934', 'TORA TRANSPORTES LTDA', '100731061', 'FROTA'),
(778, 'RFM9D89', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001652', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(779, 'QNC1B79', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001714', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(780, 'RFE1D57', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001463', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(781, 'QXP6A37', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001404', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(782, 'QXP6A37', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001404', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(783, 'RMO5D02', 'BR', 'Centopeia', 'Carreta', '442002000000000000001524', 'TERRA MINAS TERRAPLENAGEM E TRANSPO RTES LTDA', '100664409', 'FROTA'),
(784, 'GYI8020', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003104', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(785, 'GYI8020', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003104', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(786, 'HKW4251', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002335', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(787, 'HKW4251', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002335', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(788, 'OOZ2729', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002594', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(789, 'OOZ2729', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002594', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(790, 'HEH7133', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002642', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(791, 'QQE0903', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002813', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(792, 'QQE0903', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002813', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(793, 'HBG7899', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002411', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'AGREGADO'),
(794, 'QPL5814', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002272', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(795, 'OPJ6806', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001761', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(796, 'HEH7112', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002641', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(797, 'HEH7112', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002641', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(798, 'HEH7112', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002641', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(799, 'HEH7079', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002568', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(800, 'HEH7079', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002568', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(801, 'GXX8249', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002104', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(802, 'GXX8249', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002104', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(803, 'GXX8249', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002104', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(804, 'GXX8249', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002104', 'L L TRANSPORTES LTDA', '100189599', 'TERCEIRO'),
(805, 'GXS9372', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002415', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(806, 'OOZ2733', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002603', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(807, 'OOZ2733', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002603', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(808, 'OQI3458', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002881', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'AGREGADO'),
(809, 'OQI3458', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002881', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'AGREGADO'),
(810, 'QPO5523', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002021', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(811, 'QPO5523', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002021', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(812, 'PWM6799', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002913', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(813, 'PWM6792', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001504', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(814, 'QQS1574', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001299', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(815, 'QQS1574', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001299', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(816, 'QNV4966', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001704', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(817, 'QNV4966', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001704', 'SILVANO SANTOS DA ROCHA EIRELI', '100182389', 'FROTA'),
(818, 'QPL5813', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001375', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(819, 'LMD4191', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001542', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(820, 'GXS9449', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001586', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(821, 'GXS9449', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001586', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(822, 'GXS9449', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001586', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(823, 'HEH7086', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001931', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(824, 'GXS9453', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001591', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(825, 'GXS9453', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001591', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(826, 'OPY1166', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001244', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(827, 'HMF0263', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001583', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(828, 'HEH7083', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001580', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(829, 'QPY4886', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001426', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(830, 'HIJ6292', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001550', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(831, 'HIJ6292', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001550', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(832, 'HIJ6292', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001550', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(833, 'OMH7664', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001594', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(834, 'OMH7664', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001594', 'VITRAN TRANSPORTES LTDA', '100242348', 'FROTA'),
(835, 'QOA2501', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001387', 'L L TRANSPORTES LTDA', '100189599', 'FROTA'),
(836, 'QOA2501', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001387', 'L L TRANSPORTES LTDA', '100189599', 'FROTA'),
(837, 'OWZ5873', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001649', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(838, 'PUG8821', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001647', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(839, 'PUP0660', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001640', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(840, 'HFI5862', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001471', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(841, 'HFI5862', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001471', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '100167501', 'COOPERATIVA'),
(842, 'QQE3037', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001610', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(843, 'PUG8791', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001645', 'BVC TRANSPORTES LTDA', '100181533', 'FROTA'),
(844, 'QQZ9792', 'MG', 'Centopeia', 'Carreta', '442002000000000000001915', 'TRANSPORTES SARZEDO LTDA', '101010573', 'FROTA'),
(845, 'OWO6123', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002007', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(846, 'QUH6170', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001771', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(847, 'QPY7482', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002341', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(848, 'QUI2043', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001768', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(849, 'QPT1830', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002504', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(850, 'QPT1830', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002504', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(851, 'QPY7503', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003052', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(852, 'QPY7503', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003052', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(853, 'QPY7503', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003052', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(854, 'QUH7736', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003050', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(855, 'QQZ2831', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002243', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(856, 'QQZ2831', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002243', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(857, 'HAR1815', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002583', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(858, 'HAR1815', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002583', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(859, 'HAR1815', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002583', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(860, 'QUH6199', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001772', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(861, 'QUH6197', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002057', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(862, 'QUH6197', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002057', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(863, 'QPW2683', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002180', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(864, 'QPW2683', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002180', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(865, 'QPW2687', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002017', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(866, 'QQZ2909', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002892', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(867, 'QQZ2909', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002892', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(868, 'QQZ2906', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002178', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(869, 'QQZ2906', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002178', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(870, 'QQZ2906', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002178', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(871, 'QPQ1305', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002450', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(872, 'QPQ1305', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002450', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(873, 'QPP3783', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002891', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(874, 'QQE0674', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002148', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(875, 'QXE3680', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002344', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(876, 'QPQ1307', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001558', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(877, 'QPQ1307', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001558', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(878, 'QPY8986', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001265', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(879, 'QPY8986', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001265', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(880, 'QPY8986', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001265', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(881, 'QUO2624', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001204', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(882, 'QUO2624', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001204', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(883, 'QPQ2168', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001011', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(884, 'QOK4447', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001728', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(885, 'QOI5640', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000158', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(886, 'QOI5640', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000158', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(887, 'QUC7899', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001485', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(888, 'QUC7899', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001485', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(889, 'QUC7899', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001485', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(890, 'QPQ1306', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001452', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(891, 'QPQ1306', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001452', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(892, 'QPW2693', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001046', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(893, 'QPW2693', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001046', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(894, 'QUC7903', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001314', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(895, 'QUC7903', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001314', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(896, 'QPW2697', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000360', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(897, 'QUC7897', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001478', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(898, 'QUC7897', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001478', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(899, 'QUC7897', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001478', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(900, 'QQG0152', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000560', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(901, 'QUK0208', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001348', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(902, 'QOM3617', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001723', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(903, 'QUO0215', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001264', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(904, 'QUK0206', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001310', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(905, 'QQC8346', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001374', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(906, 'QQC8346', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001374', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(907, 'QUO0214', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001270', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(908, 'QUO0214', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001270', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(909, 'QUN5942', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001262', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(910, 'QOI2523', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001405', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'AGREGADO'),
(911, 'QPS4836', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001413', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(912, 'QPS4836', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001413', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(913, 'QQG3840', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001271', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(914, 'QOI3620', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000841', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(915, 'QOI3620', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000000841', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(916, 'QOK4551', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001507', 'DE PAULA TRANSPORTADORA LTDA', '100192294', 'FROTA'),
(917, 'QXP6B86', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002332', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(918, 'RFF4C04', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002107', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(919, 'HJF4I87', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(920, 'PZT4B63', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002031', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(921, 'PZT4B63', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002031', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(922, 'PZT4B63', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002031', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(923, 'QNQ5F22', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002533', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(924, 'QNQ5F22', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002533', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(925, 'QNQ5F22', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002533', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(926, 'QUS7A55', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003205', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(927, 'QNQ5F40', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003203', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(928, 'RFI0J95', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(929, 'RFI0J95', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(930, 'RFF6B51', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002121', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(931, 'RFC4F32', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003101', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(932, 'RFC4F32', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003101', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(933, 'QUN7J94', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002306', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(934, 'QXO9I00', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002011', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(935, 'OWY3F41', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000344', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(936, 'OWY3F41', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000344', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(937, 'LQY6A02', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002320', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(938, 'QNI1A73', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002115', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(939, 'QNI1A73', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002115', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(940, 'HKN7E67', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002464', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(941, 'HKN7E67', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002464', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(942, 'HKN7E67', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002464', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(943, 'HKN7E67', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002464', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(944, 'CUE2E97', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002516', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(945, 'CUE2E97', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002516', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(946, 'CUE2E97', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002516', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(947, 'OPE9A48', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000187', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(948, 'OPE9A48', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000187', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(949, 'OPE9A48', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000187', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(950, 'QXR5C87', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002333', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(951, 'RBQ7C23', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003202', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(952, 'OXH2C61', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002898', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(953, 'OXH2C61', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002898', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(954, 'MSP5I38', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002846', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(955, 'MSP5I38', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002846', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(956, 'MSP5I38', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002846', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(957, 'MSP5I38', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002846', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(958, 'QUF0F43', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002683', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(959, 'RFA6D64', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002119', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(960, 'OXJ1C60', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002470', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(961, 'OXJ1C60', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002470', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(962, 'OXJ1C60', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002470', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(963, 'RFJ1G19', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002651', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(964, 'RMM6F14', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003107', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(965, 'PVS3F72', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002586', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(966, 'OQR0B57', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001677', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(967, 'OQR0B57', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001677', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(968, 'OQR0B57', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001677', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(969, 'RNP8D68', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003100', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(970, 'GRE8J46', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002469', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA');
INSERT INTO `lista_tags` (`id`, `placa`, `estado`, `tipo`, `parte`, `tag`, `nome`, `cod_sap`, `link`) VALUES
(971, 'GRE8J46', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002469', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(972, 'OQA7J06', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001074', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(973, 'RFA7H50', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002884', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(974, 'HFK4F55', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002844', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(975, 'MKM9D14', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001147', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(976, 'MKM9D14', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001147', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(977, 'PUB9D76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002044', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(978, 'PUB9D76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002044', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(979, 'RFX6D14', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002882', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(980, 'RFX6D14', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002882', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(981, 'RFC2B54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002138', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(982, 'QXS1E10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002924', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(983, 'QXS1E10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002924', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(984, 'QXS1E10', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002924', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(985, 'RFD9G33', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003098', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(986, 'RMQ5A80', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002438', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(987, 'RMQ5A80', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002438', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(988, 'RMQ5A80', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002438', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(989, 'RMI2F56', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003296', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(990, 'QUS8I06', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001439', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(991, 'RNP8D73', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001368', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(992, 'RFY6J35', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001718', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(993, 'RFY6J35', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001718', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(994, 'RFA3E69', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001500', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(995, 'RFA3E69', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001500', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(996, 'RFL4A49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001674', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(997, 'RFL4A49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001674', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(998, 'RFL4A49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001674', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(999, 'RFL4A49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001674', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1000, 'RMO8B34', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001399', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1001, 'HDI4D62', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001388', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1002, 'HDI4D62', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001388', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1003, 'CUE8J97', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001472', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1004, 'KRA9C01', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001495', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1005, 'RMR7C31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001424', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1006, 'RMR7C31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001424', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1007, 'RMR7C31', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001424', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1008, 'RFE5F90', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001453', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1009, 'RFE5F90', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001453', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1010, 'RFJ4I93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001544', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1011, 'QUA4B89', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001232', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1012, 'RFF9C00', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001721', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1013, 'RFF9C00', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001721', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1014, 'PYB2I51', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001474', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1015, 'PYB2I51', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001474', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1016, 'PYB2I51', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001474', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1017, 'RFV5J00', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001345', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1018, 'OWY3F49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001309', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1019, 'OWY3F49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001309', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1020, 'OWY3F49', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001309', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1021, 'RFT1H08', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001293', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1022, 'RFT1H08', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001293', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1023, 'RFS5J21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1024, 'RFS5J21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1025, 'RFS5J21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1026, 'RNA8J89', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001205', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1027, 'QXZ9J52', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001566', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1028, 'QXZ9J52', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001566', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1029, 'GSV0J47', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001464', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1030, 'RGC4B21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001448', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1031, 'RGC4B21', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001448', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1032, 'QXR3F95', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001389', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1033, 'QXR3F95', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001389', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1034, 'RMJ3D45', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001239', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1035, 'RMJ3D45', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001239', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1036, 'RMJ3D45', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001239', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1037, 'PUG8G68', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001282', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1038, 'PUG8G68', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001282', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1039, 'RMR5D71', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001724', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1040, 'RMJ7H57', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001862', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1041, 'RMJ7H57', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001862', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1042, 'PYF8H32', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001260', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1043, 'PYF8H32', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001260', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1044, 'PYF8H32', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001260', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1045, 'PYF8H32', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001260', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1046, 'RMG2C84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001657', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1047, 'RMG2C84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001657', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1048, 'RMG2C84', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001657', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1049, 'RMK0F20', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001409', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1050, 'RMK0F20', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001409', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1051, 'HNP3C42', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001236', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1052, 'RFE6D64', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001516', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1053, 'RFE6D64', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001516', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1054, 'HEH2F41', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001607', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1055, 'HEH2F41', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001607', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1056, 'RFO0A93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001394', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1057, 'GVQ9C19', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001660', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1058, 'RGB5B19', 'BR', 'Canguru', 'Carreta', '442002000000000000001945', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1059, 'DTB0049', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002241', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1060, 'DTB0049', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002241', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1061, 'QOQ4370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002897', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1062, 'QOQ4370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002897', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1063, 'OPB3880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001060', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1064, 'OPB3880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001060', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1065, 'FUM9850', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003096', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1066, 'HIV2813', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000967', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1067, 'FTL4957', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001725', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1068, 'PUG4180', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002697', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1069, 'PUG4180', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002697', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1070, 'PUG4180', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002697', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1071, 'HNY0212', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002213', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1072, 'HNY0212', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002213', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1073, 'NTI5246', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1074, 'NTI5246', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1075, 'OPY2015', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001735', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1076, 'NTX6554', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002114', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1077, 'NTX6554', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002114', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1078, 'LLH2370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002650', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1079, 'QXF8949', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002229', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1080, 'QXF8949', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002229', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1081, 'QXF8949', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002229', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1082, 'PUT2107', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001893', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1083, 'OWK3981', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002102', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1084, 'PXT3517', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002461', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1085, 'PXT3517', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002461', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1086, 'OSZ3579', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002323', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1087, 'PWB6112', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001382', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1088, 'PWB6112', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001382', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1089, 'PWB6112', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001382', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1090, 'HFD5866', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000645', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1091, 'QWY1492', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001728', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1092, 'QOC4843', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001285', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1093, 'OWH9726', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000220', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1094, 'FEJ6633', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001741', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1095, 'FEJ6633', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001741', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1096, 'QNZ2230', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002847', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1097, 'NLE8588', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002899', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1098, 'EOE1521', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002462', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1099, 'OVS9128', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000207', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1100, 'KNW7315', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1101, 'JIG6447', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002896', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1102, 'EFO9173', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001937', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1103, 'LMC0471', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001625', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1104, 'LMC0471', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001625', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1105, 'PVC0308', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001319', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1106, 'AYA3973', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001363', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1107, 'OPE2318', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001450', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1108, 'GSV0946', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001487', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1109, 'GSV0946', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001487', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1110, 'QPY8661', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001298', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1111, 'QPY8661', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001298', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1112, 'QPY8661', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001298', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1113, 'HFM9508', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001654', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1114, 'QOM9187', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001499', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1115, 'GSV0943', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001414', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1116, 'OQR6980', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001318', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1117, 'LLX4472', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001215', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1118, 'LLX4472', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001215', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1119, 'GXS7662', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001667', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1120, 'GVE8397', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001606', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1121, 'GVE8397', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001606', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1122, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1123, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1124, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1125, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1126, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1127, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1128, 'OPY1132', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001659', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1129, 'OPY1132', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001659', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1130, 'OPY1132', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001659', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1131, 'QUN4010', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001874', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1132, 'QUF7414', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001329', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1133, 'QOC4852', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001493', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1134, 'HJD3044', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001393', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1135, 'HJD3044', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001393', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1136, 'HJD3044', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001393', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1137, 'OPY1158', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001273', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1138, 'OPY1158', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001273', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1139, 'OQJ6242', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001615', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1140, 'QQI8269', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001277', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1141, 'QOU2971', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001929', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1142, 'OPK5184', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001722', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1143, 'OWY3550', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001480', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1144, 'PUL2352', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001279', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1145, 'GYI8335', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001315', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1146, 'QNZ3233', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001492', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1147, 'QXK8418', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001451', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1148, 'ELW3930', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001735', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1149, 'ELW3930', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001735', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1150, 'QPS6452', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001457', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1151, 'QQE6018', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001373', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1152, 'KRY3424', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001677', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1153, 'QQJ2619', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001403', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1154, 'QQJ2619', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001403', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1155, 'PWB7434', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001408', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1156, 'OWJ2380', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1157, 'OWJ2380', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1158, 'OWJ2380', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1159, 'PVO7205', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001372', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1160, 'PVO7205', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001372', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1161, 'PVO7205', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001372', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1162, 'PVO7205', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001372', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1163, 'LLU2433', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001429', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1164, 'OXE5229', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001407', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1165, 'HMK1634', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001557', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1166, 'PYK1663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001338', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1167, 'PYK1663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001338', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1168, 'HFD5654', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001465', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1169, 'HFD5654', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001465', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1170, 'HFD5654', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001465', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1171, 'HFD5654', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001465', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1172, 'QNX4265', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001511', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1173, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1174, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1175, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1176, 'QNJ9953', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001483', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1177, 'QNJ9953', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001483', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1178, 'QNJ9953', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001483', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1179, 'QOQ4370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002897', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1180, 'OPB3880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001060', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1181, 'HIV2813', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000967', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1182, 'FTL4957', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001725', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1183, 'HKA1212', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002010', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1184, 'PUH2426', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002538', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1185, 'PUH2426', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002538', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1186, 'NYE2229', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002524', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1187, 'MIP1830', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002211', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1188, 'HBG4880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001871', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1189, 'NYA8165', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003105', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1190, 'HIM2615', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003294', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1191, 'HIM2615', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003294', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1192, 'NTI5246', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1193, 'OPY2015', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001735', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1194, 'OQN4737', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001545', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1195, 'HNF1240', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000484', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1196, 'NTX6554', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002114', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1197, 'LLH2370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002650', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1198, 'KRF5683', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001530', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1199, 'PUM0732', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000200', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1200, 'PUM0732', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000200', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1201, 'PUM0732', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000200', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1202, 'PXT3517', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002461', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1203, 'QWT3377', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002245', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1204, 'QWT3377', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002245', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1205, 'QWT3377', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002245', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1206, 'QWT3377', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002245', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1207, 'OSZ3579', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002323', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1208, 'OSZ3579', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002323', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1209, 'QWY5017', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002322', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1210, 'QWY5017', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002322', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1211, 'HNX1634', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1212, 'HNX1634', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1213, 'HNX1634', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1214, 'HNX1634', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1215, 'OWH9726', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000220', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1216, 'OXC4555', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000664', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1217, 'FEJ6633', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001741', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1218, 'QUP5237', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001779', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1219, 'EOE1521', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002462', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1220, 'OVS9128', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000207', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1221, 'OVS9128', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000207', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA');
INSERT INTO `lista_tags` (`id`, `placa`, `estado`, `tipo`, `parte`, `tag`, `nome`, `cod_sap`, `link`) VALUES
(1222, 'PZY4708', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001823', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1223, 'KNW7315', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1224, 'KNW7315', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1225, 'JIG6447', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002896', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1226, 'JIG6447', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002896', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1227, 'EFO9173', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001937', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1228, 'QNH0557', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1229, 'AYA3973', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001363', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1230, 'GSV0946', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001487', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1231, 'GSV0943', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001414', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1232, 'OQR6980', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001318', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1233, 'LLX4472', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001215', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1234, 'GXS7662', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001667', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1235, 'GXS7662', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001667', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1236, 'GVE8397', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001606', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1237, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1238, 'HJD3057', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001661', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1239, 'OPY1132', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001659', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1240, 'OPY1132', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001659', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1241, 'HJD3044', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001393', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1242, 'PWH2742', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001241', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1243, 'OPY1158', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001273', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1244, 'PUH8178', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001390', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1245, 'PUH8178', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001390', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1246, 'OQJ6242', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001615', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1247, 'QOU2971', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001929', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1248, 'PUA4814', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001440', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1249, 'PUA4814', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001440', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1250, 'QWU1670', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001362', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1251, 'PVK6101', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001400', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1252, 'PVK6101', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001400', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1253, 'QQE6018', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001373', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1254, 'QQE6018', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001373', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1255, 'QQE6018', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001373', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1256, 'QXJ6487', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001259', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1257, 'QXJ6487', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001259', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1258, 'KRY3424', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001677', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1259, 'OPG2254', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001297', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1260, 'LMC0471', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001625', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1261, 'OQI2328', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001614', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1262, 'PWB7434', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001408', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1263, 'OWJ2380', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1264, 'LLU2433', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001429', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1265, 'OXE5229', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001407', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1266, 'OXE5229', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001407', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1267, 'OXE5229', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001407', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1268, 'HJC7612', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1269, 'HMK1634', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001557', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1270, 'HMK1634', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001557', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1271, 'HMK1634', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001557', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1272, 'PYK1663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001338', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1273, 'PYK1663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001338', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1274, 'HFD5654', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001465', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1275, 'PYC4367', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001663', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1276, 'PYC4367', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001663', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1277, 'QNX4265', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001511', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1278, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1279, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1280, 'DTB0049', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002241', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1281, 'QOQ4370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002897', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1282, 'QOQ4370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002897', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1283, 'HFD2932', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002922', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1284, 'OPB3880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001060', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1285, 'HIV2813', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000967', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1286, 'HIV2813', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000000967', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1287, 'OLY6037', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002400', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1288, 'HKA1212', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002010', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1289, 'HNY0212', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002213', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1290, 'HNY0212', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002213', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1291, 'PUH2426', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002538', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1292, 'DVT7673', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002321', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1293, 'NYE2229', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002524', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1294, 'HBG4880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001871', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1295, 'HBG4880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001871', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1296, 'HBG4880', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001871', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1297, 'GXA3146', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1298, 'QXJ6493', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002267', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1299, 'NYA8165', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003105', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1300, 'OPS5320', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002230', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1301, 'OPS5320', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002230', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1302, 'OPS5320', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002230', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1303, 'NTI5246', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1304, 'NTI5246', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1305, 'OPY2015', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001735', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1306, 'OPY2015', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001735', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1307, 'NTX6554', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002114', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1308, 'LLH2370', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002650', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1309, 'QXF8949', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002229', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1310, 'QXF8949', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002229', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1311, 'QXF8949', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002229', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1312, 'PUT2107', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001893', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1313, 'PUT2107', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001893', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1314, 'PUT2107', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000001893', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1315, 'PUM0732', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000200', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1316, 'PUM0732', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000200', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1317, 'MIU0867', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001703', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1318, 'MIU0867', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001703', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1319, 'MIU0867', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001703', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1320, 'OUU1578', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002238', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1321, 'OUU1578', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002238', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1322, 'OWK3981', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002102', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1323, 'PXT3517', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002461', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1324, 'PXT3517', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002461', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1325, 'PWB6112', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001382', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1326, 'PWB6112', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001382', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1327, 'PWB6112', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001382', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1328, 'QWY1492', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001728', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1329, 'QWY1492', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001728', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1330, 'QWY5017', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002322', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1331, 'HNX1634', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002676', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1332, 'QOX3712', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001914', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1333, 'OWH9726', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000000220', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1334, 'QUP5237', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001779', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1335, 'NLE8588', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002899', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1336, 'NLE8588', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002899', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1337, 'EOE1521', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002462', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1338, 'PZY4708', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001823', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1339, 'PZY4708', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001823', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1340, 'KNW7315', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1341, 'KNW7315', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1342, 'JIG6447', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002896', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1343, 'EFO9173', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001937', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1344, 'HOA1289', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001361', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1345, 'HOA1289', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001361', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1346, 'QNH0557', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1347, 'QNH0557', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1348, 'GQR6768', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002463', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1349, 'GQR6768', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002463', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1350, 'PVO7205', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001372', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1351, 'LLU2433', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001429', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1352, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1353, 'PVC0308', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001319', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1354, 'AYA3973', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001363', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1355, 'OPE2318', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001450', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1356, 'GSV0946', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001487', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1357, 'GSV0946', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001487', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1358, 'GSV0946', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001487', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1359, 'QPY8661', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001298', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1360, 'QPW6196', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001240', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1361, 'QOM9187', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001499', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1362, 'HAX3364', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001416', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1363, 'GSV0943', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001414', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1364, 'GSV0943', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001414', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1365, 'GSV0943', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001414', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1366, 'GXH2851', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001386', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1367, 'GXH2851', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001386', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1368, 'OQR6980', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001318', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1369, 'OQR6980', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001318', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1370, 'LLX4472', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001215', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1371, 'LLX4472', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001215', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1372, 'GXS7662', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001667', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1373, 'GVE8397', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001606', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1374, 'GVE8397', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001606', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1375, 'OPY1132', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001659', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1376, 'HJD3044', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001393', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1377, 'OPY1158', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001273', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1378, 'OPY1158', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001273', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1379, 'OPY1158', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001273', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1380, 'PUH8178', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001390', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1381, 'PUH8178', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001390', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1382, 'OQJ6242', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001615', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1383, 'OQJ6242', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001615', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1384, 'QOU2971', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001929', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1385, 'PUA4814', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001440', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1386, 'OWY3550', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001480', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1387, 'HJC7090', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001432', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1388, 'GYI8335', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001315', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1389, 'GYI8335', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001315', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1390, 'ELW3930', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001735', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1391, 'PVK6101', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001400', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1392, 'PVK6101', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001400', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1393, 'PVK6101', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001400', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1394, 'QPS6452', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001457', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1395, 'QQE6018', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001373', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1396, 'KRY3424', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001677', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1397, 'KRY3424', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001677', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1398, 'QQJ2619', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001403', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1399, 'OPG2254', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001297', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1400, 'OQI2328', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001614', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1401, 'OQI2328', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001614', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1402, 'PWB7434', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001408', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1403, 'PWB7434', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001408', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1404, 'OWJ2380', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1405, 'OWJ2380', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001925', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1406, 'PVO7205', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001372', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1407, 'LLU2433', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001429', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1408, 'HJC7612', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1409, 'HJC7612', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001339', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1410, 'HMK1634', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001557', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1411, 'HMK1634', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001557', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1412, 'PYK1663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001338', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1413, 'PYK1663', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001338', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1414, 'HFD5654', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001465', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1415, 'PYC4367', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001663', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1416, 'PUG2813', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001250', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1417, 'PUG2813', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001250', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1418, 'OQC5403', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001370', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1419, 'OQC5403', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001370', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1420, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1421, 'PUM0737', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001749', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1422, 'QNJ9953', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001483', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1423, 'QNJ9953', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001483', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '100146256', 'COOPERATIVA'),
(1430, 'RNP6C86', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001859', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1433, 'GJD3D34', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003302', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1434, 'RUP4F43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003338', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1435, 'RUR5E62', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001890', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1437, 'RMG3A01', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002977', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1438, 'QUR4235', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001847', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1439, 'RUP4E29', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001888', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1440, 'RMX5E43', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002943', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1441, 'RNI9D62', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001818', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1442, 'QQA8616', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002951', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1443, 'QQD2J71', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002018', 'SILVANO SANTOS DA ROCHA EIRELI ', '-', '-'),
(1444, 'RUS9B76', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003342', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1445, 'RUP4F59', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001885', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1446, 'QOK4481', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003305', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1447, 'RMZ1C49', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001806', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1448, '', '', '', 'Carreta', '442002000000000000001525', '', '-', '-'),
(1449, 'RUP4E22', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003034', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1450, 'RUP4F32', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003334', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1451, 'RUR5E48', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001889', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1452, 'RUP4F38', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003336', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1453, 'BYP7F94', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003299', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1454, 'RNQ5C75', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001809', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1455, 'SHB9H92', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003363', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1456, 'RUP4F42', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001897', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1457, 'QUH1610', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001330', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '-', '-'),
(1458, 'OPY1B32', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003357', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1459, 'PPI5E03', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001659', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1460, 'RUR5E60', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003033', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1461, 'DSK8F08', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002954', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1462, 'ODJ1B64', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001722', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1463, 'RUP4F47', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003339', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1464, 'RUR5E51', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001886', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1465, 'RNH9G95', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003301', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1466, 'QOK4438', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001810', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1467, 'RUR5E55', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003215', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1468, 'QPG5B16', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003196', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1469, 'RUP4F55', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003341', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1470, 'RUR5E44', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001891', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1471, 'SHB9H47', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003340', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1472, 'RUP4F50', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001895', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1473, 'RTI5G27', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003355', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1474, 'RNW3H96', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001835', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1475, 'RNQ4B63', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002979', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '-', '-'),
(1476, 'RFA5C55', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001512', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '-', '-'),
(1477, 'RUP4E42', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002981', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1478, 'HJC7A90', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002922', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1479, 'RGB6J43', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003358', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1480, '-', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001820', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1481, 'RUS9B27', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003335', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1482, 'RUP4F35', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001898', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1483, 'FXF4E13', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003300', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1484, 'RNI9A82', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001831', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1485, 'CKO2J73', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002972', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1486, 'RNB1E41', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001551', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1487, 'QPN0579', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002965', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1488, 'RNQ9A32', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001679', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1489, 'RMJ7H24', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001811', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1490, 'RMT2H63', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002939', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1491, 'RNZ4J39', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001812', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1492, 'FMK3E05', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003297', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1493, 'RNS9A29', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001830', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1494, 'BZK9G65', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002967', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1495, 'RNQ5C60', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001668', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1496, 'FUM7H84', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002968', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1497, 'RNQ5C49', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001467', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1498, 'QPV3936', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002970', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1499, 'RNB1D95', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001650', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1500, 'QXV2H30', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003383', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-');
INSERT INTO `lista_tags` (`id`, `placa`, `estado`, `tipo`, `parte`, `tag`, `nome`, `cod_sap`, `link`) VALUES
(1501, 'QXI6585', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001849', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1502, 'HIV2I13', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001250', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1503, 'RNX3J48', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001821', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1504, 'QPW2689', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003377', 'DE PAULA TRANSPORTADORA LTDA ', '-', '-'),
(1505, 'GCR6G23', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003303', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1506, 'RNB1E40', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001860', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1507, 'RNG3C54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002966', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1508, 'QOK4487', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001856', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1509, 'QUF1C35', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003365', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1510, 'QUF0F33', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001908', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1511, 'PZM4512', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001771', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1512, 'QNQ2I20', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001546', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1513, 'OPM9672', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001828', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1514, 'RTE3D14', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002978', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1515, 'RTE3D09', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001827', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1516, 'RMQ6D53', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002947', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1517, 'RNH7B74', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001825', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1518, 'QQD6610', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002975', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1519, 'RMS8I07', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001509', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1520, 'RNN1A37', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001820', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1521, 'RMX5E66', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003384', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1522, 'RNX2B62', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001764', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1523, 'RNP4B68', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003396', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1524, 'RND5F54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001760', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1525, 'HHK3H13', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002541', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1526, 'GYI2445', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001776', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1527, 'EGJ9020', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003404', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1528, 'HBN7681', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001861', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1529, 'PYI0J84', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003410', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1530, 'PWH3G26', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001774', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1531, 'QPH9062', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003406', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1532, 'QPU0236', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001548', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1533, 'RMX6G59', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003408', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1534, 'FIJ0H62', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003298', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1535, 'RNQ9B88', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001808', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1536, 'RNB1E12', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003304', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1537, 'BTZ5C13', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001807', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1538, 'RFH4A58', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003382', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1539, 'RFG3H51', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001850', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1540, 'RNO1D54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003409', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1541, 'RMS3B43', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002945', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1542, 'RFI5B10', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003389', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1543, 'RNX3I79', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001758', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1544, 'RNE8B57', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003390', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1545, 'RND5F61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001763', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1546, 'QQD3A24', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002849', 'SILVANO SANTOS DA ROCHA EIRELI ', '-', '-'),
(1547, 'RMS2F38', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003386', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1548, 'RND5F68', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001858', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1549, 'REF5A09', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003366', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1550, 'HKA1C12', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002010', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1551, 'QXC8A92', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000002274', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1552, 'DKU0F58', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002973', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1553, 'RNB1D86', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001841', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1554, 'QPX1381', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002971', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1555, 'RMQ2A94', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001834', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1556, 'GSV0J46', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002650', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1557, 'FAA8G31', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002974', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1558, 'RTC7E26', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001845', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1559, 'FZP0A37', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002952', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1560, 'HKH0G65', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003413', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1561, 'EJW4514', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001777', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1562, 'NTX6F54', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000002114', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1563, 'RBQ8E13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000001798', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '-', '-'),
(1564, 'RVH7B78', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1565, 'RVG0A82', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001769', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1566, 'PVO7202', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1567, 'DUD6B10', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1568, 'PUG2I13', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1569, 'QUY8E83', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1570, 'LQZ9F56', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1571, 'HHK5994', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001234', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1572, 'RMG4C25', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1573, 'RTA6A27', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001757', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1574, 'QOK4499', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1575, 'RNB1E15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001671', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1576, 'RTD9D78', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1577, 'QOK4508', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001796', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1578, 'RNJ4B86', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1579, 'RND5F63', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001781', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1580, 'RNL0I95', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1581, 'RTA6A50', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001787', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1582, 'RFO2J64', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1583, 'RNZ4J63', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001854', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1584, 'QQA8G16', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1585, 'RNU8B13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1586, 'QOK4525', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001504', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1587, 'CTR5D81', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1588, 'RNT8J13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001800', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1589, 'RVG5E02', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1590, 'BSX9G91', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1591, 'RNP5D82', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001402', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1592, 'RMS3B80', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1593, 'RMX5E76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001793', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1594, 'FTO3C44', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1595, 'RNT1J27', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001802', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1596, 'QPV3953', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1597, 'RNV7G52', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001798', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1598, 'EFF7E56', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1599, 'RNU5B13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001799', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1600, 'OLG6557', 'BA', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001720', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1601, 'RMV5C15', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '-', '-'),
(1602, 'RUP7A26', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1603, 'RFP3F15', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001794', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1604, 'PVS4G09', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1605, 'RBQ9H13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001651', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1606, 'QWT1784', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1607, 'QWY4959', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001626', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1608, 'RFM8J47', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1609, 'QPW8J19', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1610, 'QPV3895', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001360', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1611, 'QWT1F93', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1612, 'QXH5822', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001603', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1613, 'QWT1585', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1614, 'QWR2619', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001627', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1615, 'QXL0087', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1616, 'RFD2A28', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001361', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1617, 'QPV3238', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1618, 'QPV6805', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001970', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1619, 'QXL0121', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1620, 'QXM5177', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001922', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1621, 'NWO8668', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1622, 'RUT6F46', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001648', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1623, 'QWT1616', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1624, 'QPX0692', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001912', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1625, 'QXL0092', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1626, 'QXR6H72', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001638', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1627, 'QWY4J54', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1628, 'QWT1741', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001622', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1629, 'RUQ6J36', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1630, 'RVL9H16', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1631, 'RNW9C83', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001848', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1632, 'RMS3B47', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1633, 'RMT2H67', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001773', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1634, 'RNX3I48', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1635, 'RNP7D93', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001779', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1636, 'FCC2E48', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1637, 'RNU6F73', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001795', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1638, 'RVL9H41', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1639, 'RVH7C21', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1640, 'RMQ5G41', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001801', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1641, 'DKU3C58', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1642, 'RNU5B64', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001503', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1643, 'QQT4190', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1644, 'RNP7E06', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1645, 'RVG0A69', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001772', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1646, 'QPV7879', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1647, 'RFE3D85', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001462', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1648, 'RFU2E42', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1649, 'RFP3F01', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001770', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1650, 'DLY3A86', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1651, 'RNH3D96', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001617', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1652, 'QPO5305', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1653, 'QPR7884', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001963', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1654, 'RNW9D04', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1655, 'RNZ2J42', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001759', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1656, 'RTA5J33', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1657, 'RNH7A13', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001817', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1658, 'HJD3B02', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1659, 'RUP8D69', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001734', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1660, 'OLG6F57', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1661, 'RVL9H65', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1662, 'RUP7A31', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1663, 'RUO9J52', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001768', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1664, 'GVQ7F76', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1665, 'RUU1D61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001680', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1666, 'RUT2A35', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1667, 'SHB9J55', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001753', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1668, 'DVR4H32', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1669, 'RNR8H20', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001789', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1670, 'QWT1G02', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1671, 'QPR7J11', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001698', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1672, 'QPS8C57', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1673, 'QPO5D40', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001969', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1674, 'QVW6I49', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1675, 'RBU0D93', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001964', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1676, 'QXL0093', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1677, 'RFD0F66', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001618', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1678, 'QPW6938', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1679, 'QPW8921', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001710', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1680, 'QPN0583', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1681, 'RNX6F41', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001797', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1682, 'OQJ4B92', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1683, 'PVS7J00', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001641', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '-', '-'),
(1684, 'RNP7D91', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1685, 'RUO9F98', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001792', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1686, 'PUH2E26', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1687, 'RMX5E61', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1688, 'RMQ6E37', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001678', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1689, 'QWT1811', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1690, 'QXE5206', 'MG', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001971', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1691, 'QPV3203', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1692, 'QPX3J14', 'BR', 'Cavalo mecânico traçado - 3 eixos', 'Carreta', '442002000000000000001917', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1693, 'PVW6I49', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1694, 'OZO7292', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1695, 'RNR1G38', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001805', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1696, 'QPV3224', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1697, 'QPX3J20', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001711', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1698, 'PVW6I51', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1699, 'RBT9I53', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001967', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1700, 'RUQ3J48', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1701, 'RVL9H81', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001778', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1702, 'RUK5D05', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002949', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1703, 'RVL9H87', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001833', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1704, 'RVL9H28', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003340', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1705, 'RVL9G63', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003341', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1706, 'RUK5C84', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003393', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1707, 'RMG4C29', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001756', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1708, 'QPH0B52', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003049', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1709, 'RVO9G06', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003338', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1710, 'QPV6I13', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1711, 'QPV3244', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001378', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1712, 'QPW6A86', 'BR', 'Cavalo mecânico simples - 2 eixos', 'Cavalo', '442001000000000000003485', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1713, 'QPV3898', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001907', 'FERTRAN TRANSPORTES LTDA ', '-', '-'),
(1714, 'QPX8368', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001928', 'VITRAN TRANSPORTES LTDA ', '-', '-'),
(1715, 'RVL9G71', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003346', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1716, 'RVL9G55', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003339', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1717, 'RVP6F61', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003335', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1718, 'RVO9G09', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002841', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1719, 'RVL9G87', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002823', 'TORA TRANSPORTES LTDA ', '-', '-'),
(1720, 'RNG3C56', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003443', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1721, 'QOK4472', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001790', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1722, 'RNH7B75', 'BR', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001755', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1723, 'RVG0A76', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001782', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1724, 'RVL9I61', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003511', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1725, 'RUP7A30', 'BR', 'Bi-Truck - 4 eixos', 'Carreta', '442002000000000000002051', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1726, 'QQS1566', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001299', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '-', '-'),
(1727, 'QQG1805', 'MG', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003437', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1728, 'RNU6F70', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001803', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1729, 'RMG4C24', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000002938', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1730, 'RNN1A33', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '442001000000000000003418', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1731, 'RMQ5G37', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001785', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1732, 'QQF2633', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001842', 'COOPERVALE COOPERATIVA DE TRANSPORT E DE CARGAS E PASSAGEIROS DE BELO V', '-', '-'),
(1733, 'RNW9C74', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001784', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1734, 'QUO0109', 'MG', 'Cavalo mecânico simples - 2 eixos', 'Carreta', '442002000000000000001973', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '-', '-'),
(1735, 'RMG4C26', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001823', 'FJX TRANSPORTES LTDA ', '-', '-'),
(1736, 'FGU6D26', 'BR', 'Semireboque Simples - 3 eixos', 'Cavalo', '', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1737, 'RNH9G49', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Carreta', '442002000000000000001488', 'EMPREENDIMENTOS RODEIRO SA ', '-', '-'),
(1738, 'PWE4A42', 'BR', 'Cavalo mecânico trucado - 3 eixos', 'Cavalo', '442001000000000000003500', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-'),
(1739, 'PWE6228', 'MG', 'Semireboque Simples - 3 eixos', 'Carreta', '442002000000000000001338', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '-', '-');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens_lora`
--

CREATE TABLE `mensagens_lora` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pendente_saida_automacoes`
--

CREATE TABLE `pendente_saida_automacoes` (
  `id` int(11) NOT NULL,
  `id_historico` varchar(20) DEFAULT 'NULL',
  `data_leitura` varchar(20) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rotas`
--

CREATE TABLE `rotas` (
  `id` int(11) NOT NULL,
  `rota` varchar(100) DEFAULT NULL,
  `descricao_rota` varchar(100) DEFAULT NULL,
  `id_viagem` varchar(5) DEFAULT NULL,
  `origem_latitude` varchar(20) DEFAULT NULL,
  `origem_longitude` varchar(20) DEFAULT NULL,
  `destino_latitude` varchar(20) DEFAULT NULL,
  `destino_longitude` varchar(20) DEFAULT NULL,
  `cod_hh2risk` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Extraindo dados da tabela `rotas`
--

INSERT INTO `rotas` (`id`, `rota`, `descricao_rota`, `id_viagem`, `origem_latitude`, `origem_longitude`, `destino_latitude`, `destino_longitude`, `cod_hh2risk`) VALUES
(1, 'MMB - BCOC CATIVO', 'MIGUEL BURNIER MMB - BR-ML-BARAO DE COCAIS-BCOC', '21', '-20.43262010', '-43.7739670', '-19.9369310', '-43.4774470', '307'),
(2, 'MMB - CSN', 'MIGUEL BURNIER MMB - CSN MINERACAO', '205', '-20.43262010', '-43.7739670', '-20.4869490', '-43.8954450', '296'),
(3, 'MMB - CSN CATIVO', 'MIGUEL BURNIER MMB - CSN MINERACAO', '33', '-20.43262010', '-43.7739670', '-20.4869490', '-43.8954450', '296'),
(4, 'MMB - FILIAL MURTINHO SPOT', 'MIGUEL BURNIER MMB - FILIAL MURTINHO', '70', '-20.43262010', '-43.7739670', '-20.5673860', '-43.8096640', '288'),
(5, 'MMB FILIAL MURTINHO', 'MIGUEL BURNIER MMB - FILIAL MURTINHO', '68', '-20.43262010', '-43.7739670', '-20.5673860', '-43.8096640', '288'),
(6, 'MMB FILIAL MURTINHO CATIVA', 'MIGUEL BURNIER MMB - FILIAL MURTINHO', '11', '-20.43262010', '-43.7739670', '-20.5673860', '-43.8096640', '288'),
(7, 'MMB-BCOC', 'MIGUEL BURNIER MMB - BR-ML-BARAO DE COCAIS-BCOC', '14', '-20.43262010', '-43.7739670', '-19.9369310', '-43.4774470', '307'),
(8, 'MMB-DIV', 'MIGUEL BURNIER MMB - BR-ML-DIVINOPOLIS-DIV', '46', '-20.43262010', '-43.7739670', '-20.1539580', '-44.8757300', '304'),
(9, 'MMB-GSEL SPOT', 'MIGUEL BURNIER MMB - BR-ME-GUSA SETE LAGOAS-GSEL', '158', '-20.43262010', '-43.7739670', '-19.4705890', '44.2945090', '310'),
(10, 'MMB-LGA SPOT', 'MIGUEL BURNIER MMB - LGA', '52', '-20.43262010', '-43.7739670', '-20.5378820', '-43.8015110', '290'),
(11, 'MMB-PAM SPOT', 'MIGUEL BURNIER MMB - PAM PRODUTOS AUXILIARES METALURGICOS', '16', '-20.43262010', '-43.7739670', '-20.0626250', '-44.2832110', '306'),
(12, 'MMB-PATRAG', 'MIGUEL BURNIER MMB - TERMINAL PATRAG', '31', '-20.43262010', '-43.7739670', '-20.4970300', '-43.7754620', '294'),
(13, 'MMB-PATRAG CATIVO', 'MIGUEL BURNIER MMB - TERMINAL PATRAG', '38', '-20.43262010', '-43.7739670', '-20.4970300', '-43.7754620', '294'),
(14, 'MMB-PATRAG SPOT', 'MIGUEL BURNIER MMB - TERMINAL PATRAG', '9', '-20.43262010', '-43.7739670', '-20.4970300', '-43.7754620', '294'),
(15, 'MMB-SCOF', 'MIGUEL BURNIER MMB - TERMINAL SCOF', '29', '-20.43262010', '-43.7739670', '-20.5673860', '-43.8096640', '288'),
(16, 'MMB-SCOF CATIVO', 'MIGUEL BURNIER MMB - TERMINAL SCOF', '10', '-20.43262010', '-43.7739670', '-20.5673860', '-43.8096640', '288'),
(17, 'MMB-UOB', 'MIGUEL BURNIER MMB - OURO BRANCO', '62', '-20.43262010', '-43.7739670', '-20.5378500', '-43.7598820', '252'),
(18, 'MMB-UOB CATIVA', 'MIGUEL BURNIER MMB - OURO BRANCO', '63', '-20.43262010', '-43.7739670', '-20.5378500', '-43.7598820', '252'),
(19, 'MMB-UOB P6', 'MIGUEL BURNIER MMB - OURO BRANCO P6', '17', '-20.43262010', '-43.7739670', '-20.5378500', '-43.7598820', '252'),
(20, 'MMB-UOB P6 CATIVA', 'MIGUEL BURNIER MMB - OURO BRANCO P6', '189', '-20.43262010', '-43.7739670', '-20.5378500', '-43.7598820', '252'),
(21, 'MMB-UOB SPOT', 'MIGUEL BURNIER MMB - OURO BRANCO', '8', '-20.43262010', '-43.7739670', '-20.5378500', '-43.7598820', '252'),
(22, 'MMB-VALE', 'MIGUEL BURNIER MMB - VALE S A', '58', '-20.43262010', '-43.7739670', '-20.1834680', ' -43.8735230', '302'),
(23, 'MMB-VALE CATIVO', 'MIGUEL BURNIER MMB - VALE S A', '190', '-20.43262010', '-43.7739670', '-20.1834680', ' -43.8735230', '302'),
(24, 'MMB-VALE PATRAG CATIVO', 'MIGUEL BURNIER MMB - VALE SA', '179', '-20.43262010', '-43.7739670', '-20.1834680', ' -43.8735230', '302'),
(25, 'MMB-VALE PATRAG SPOT', 'MIGUEL BURNIER MMB - VALE SA', '28', '-20.43262010', '-43.7739670', '-20.1834680', ' -43.8735230', '302'),
(26, 'MMB-VSB', 'MIGUEL BURNIER MMB - VSB', '30', '-20.43262010', '-43.7739670', '-20.5952210', '-43.9598000', '287'),
(27, 'MMB-VSB CATIVO', 'MIGUEL BURNIER MMB - VSB', '27', '-20.43262010', '-43.7739670', '-20.5952210', '-43.9598000', '287'),
(28, 'MMB-VSB SPOT', 'MIGUEL BURNIER MMB - VSB', '206', '-20.43262010', '-43.7739670', '-20.5952210', '-43.9598000', '287'),
(29, 'MVL - CSN CATIVO', 'VÁRZEA DO LOPES MVL - CSN MINERACAO', '227', '-20.2955510', '-43.9386160', '-20.4869490', '-43.8954450', '297'),
(30, 'MVL - GERDAU WG CATIVO', 'VÁRZEA DO LOPES MVL - GERDAU WG', '226', '-20.2955510', '-43.9386160', '-20.4990150', '-43.7750280', '293'),
(31, 'MVL - HERCULANO CATIVO', 'VÁRZEA DO LOPES MVL - HERCULANO', '48', '-20.2955510', '-43.9386160', '-20.2535580', '-43.9267590', '300'),
(32, 'MVL - SAFM', 'VÁRZEA DO LOPES MVL - SAFM', '225', '-20.2955510', '-43.9386160', '-20.2690110', '-43.8951580', '298'),
(33, 'MVL - SAFM CATIVO', 'VÁRZEA DO LOPES MVL - SAFM', '67', '-20.2955510', '-43.9386160', '-20.2690110', '-43.8951580', '298'),
(34, 'MVL FILIAL MURTINHO', 'VÁRZEA DO LOPES MVL - FILIAL MURTINHO', '69', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(35, 'MVL FILIAL MURTINHO CATIVA', 'VÁRZEA DO LOPES MVL - FILIAL MURTINHO', '237', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(36, 'MVL FILIAL MURTINHO SPOT', 'VÁRZEA DO LOPES MVL - FILIAL MURTINHO', '20', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(37, 'MVL- CSN', 'VÁRZEA DO LOPES MVL - CSN MINERACAO', '5', '-20.2955510', '-43.9386160', '-20.4869490', '-43.8954450', '297'),
(38, 'MVL- SCOF FROTA CATIVA', 'VÁRZEA DO LOPES MVL - TERMINAL SCOF', '13', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(39, 'MVL-BCOC SPOT', 'VÁRZEA DO LOPES MVL - BR-ML-BARAO DE COCAIS-BCOC', '12', '-20.2955510', '-43.9386160', '-19.9369310', '-43.4774470', '308'),
(40, 'MVL-DIV SPOT', 'VÁRZEA DO LOPES MVL - BR-ML-DIVINOPOLIS-DIV', '170', '-20.2955510', '-43.9386160', '-20.1539580', '-44.8757300', '305'),
(41, 'MVL-GERDAU WG', 'VÁRZEA DO LOPES MVL - GERDAU WG', '171', '-20.2955510', '-43.9386160', '-20.4990150', '-43.7750280', '293'),
(42, 'MVL-GERDAU WG SPOT', 'VÁRZEA DO LOPES MVL - GERDAU WG', '45', '-20.2955510', '-43.9386160', '-20.4990150', '-43.7750280', '293'),
(43, 'MVL-GSEL SPOT', 'VÁRZEA DO LOPES MVL - BR-ME-GUSA SETE LAGOAS-GSEL', '18', '-20.2955510', '-43.9386160', '-19.4705890', '44.2945090', '311'),
(44, 'MVL - CSN CATIVO', 'VÁRZEA DO LOPES MVL - CSN MINERACAO', '206', '-20.2955510', '-43.9386160', '-20.4869490', '-43.8954450', '297'),
(45, 'MVL - GERDAU WG CATIVO', 'VÁRZEA DO LOPES MVL - GERDAU WG', '227', '-20.2955510', '-43.9386160', '-20.4990150', '-43.7750280', '293'),
(46, 'MVL - HERCULANO CATIVO', 'VÁRZEA DO LOPES MVL - HERCULANO', '226', '-20.2955510', '-43.9386160', '-20.2535580', '-43.9267590', '300'),
(47, 'MVL - SAFM', 'VÁRZEA DO LOPES MVL - SAFM', '48', '-20.2955510', '-43.9386160', '-20.2690110', '-43.8951580', '298'),
(48, 'MVL - SAFM CATIVO', 'VÁRZEA DO LOPES MVL - SAFM', '225', '-20.2955510', '-43.9386160', '-20.2690110', '-43.8951580', '298'),
(49, 'MVL FILIAL MURTINHO', 'VÁRZEA DO LOPES MVL - FILIAL MURTINHO', '67', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(50, 'MVL FILIAL MURTINHO CATIVA', 'VÁRZEA DO LOPES MVL - FILIAL MURTINHO', '69', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(51, 'MVL FILIAL MURTINHO SPOT', 'VÁRZEA DO LOPES MVL - FILIAL MURTINHO', '237', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(52, 'MVL- CSN', 'VÁRZEA DO LOPES MVL - CSN MINERACAO', '20', '-20.2955510', '-43.9386160', '-20.4869490', '-43.8954450', '297'),
(53, 'MVL- SCOF FROTA CATIVA', 'VÁRZEA DO LOPES MVL - TERMINAL SCOF', '5', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(54, 'MVL-BCOC SPOT', 'VÁRZEA DO LOPES MVL - BR-ML-BARAO DE COCAIS-BCOC', '13', '-20.2955510', '-43.9386160', '-19.9369310', '-43.4774470', '308'),
(55, 'MVL-DIV SPOT', 'VÁRZEA DO LOPES MVL - BR-ML-DIVINOPOLIS-DIV', '12', '-20.2955510', '-43.9386160', '-20.1539580', '-44.8757300', '305'),
(56, 'MVL-GERDAU WG', 'VÁRZEA DO LOPES MVL - GERDAU WG', '170', '-20.2955510', '-43.9386160', '-20.4990150', '-43.7750280', '293'),
(57, 'MVL-GERDAU WG SPOT', 'VÁRZEA DO LOPES MVL - GERDAU WG', '171', '-20.2955510', '-43.9386160', '-20.4990150', '-43.7750280', '293'),
(58, 'MVL-GSEL SPOT', 'VÁRZEA DO LOPES MVL - BR-ME-GUSA SETE LAGOAS-GSEL', '45', '-20.2955510', '-43.9386160', '-19.4705890', '44.2945090', '311'),
(59, 'MVL-HERCULANO', 'VÁRZEA DO LOPES MVL - HERCULANO', '18', '-20.2955510', '-43.9386160', '-20.2535580', '-43.9267590', '300'),
(60, 'MVL-LGA', 'VÁRZEA DO LOPES MVL - LGA', '4', '-20.2955510', '-43.9386160', '-20.5378820', '-43.8015110', '250'),
(61, 'MVL-LGA CATIVA', 'VÁRZEA DO LOPES MVL - LGA', '59', '-20.2955510', '-43.9386160', '-20.5378820', '-43.8015110', '250'),
(62, 'MVL-LGA SPOT', 'VÁRZEA DO LOPES MVL - LGA', '236', '-20.2955510', '-43.9386160', '-20.5378820', '-43.8015110', '250'),
(63, 'MVL-MMB', 'VÁRZEA DO LOPES MVL - MIGUEL BURNIER MMB', '1', '-20.2955510', '-43.9386160', '-20.43262010', '-43.7739670', '249'),
(64, 'MVL-MMB FROTA CATIVA', 'VÁRZEA DO LOPES MVL - MIGUEL BURNIER MMB', '2', '-20.2955510', '-43.9386160', '-20.43262010', '-43.7739670', '249'),
(65, 'MVL-MMB SPOT', 'VÁRZEA DO LOPES MVL - MIGUEL BURNIER MMB', '240', '-20.2955510', '-43.9386160', '-20.43262010', '-43.7739670', '249'),
(66, 'MVL-PATRAG', 'VÁRZEA DO LOPES MVL - PATRAG', '22', '-20.2955510', '-43.9386160', '-20.4970300', '-43.7754620', '295'),
(67, 'MVL-SAFM SPOT', 'VÁRZEA DO LOPES MVL - SAFM', '49', '-20.2955510', '-43.9386160', '-20.2690110', '-43.8951580', '298'),
(68, 'MVL-SCOF', 'VÁRZEA DO LOPES MVL - TERMINAL SCOF', '6', '-20.2955510', '-43.9386160', '-20.5673860', '-43.8096640', '289'),
(69, 'MVL-TECNOSINTER SPOT', 'VÁRZEA DO LOPES MVL - TECNOSINTER', '224', '-20.2955510', '-43.9386160', '-19.9852750', '-43.9465560', '999'),
(70, 'MVL-UOB', 'VÁRZEA DO LOPES MVL - OURO BRANCO', '64', '-20.2955510', '-43.9386160', '-20.5378500', '-43.7598820', '292'),
(71, 'MVL-UOB CATIVA', 'VÁRZEA DO LOPES MVL - OURO BRANCO', '3', '-20.2955510', '-43.9386160', '-20.5378500', '-43.7598820', '292'),
(72, 'MVL-UOB P6', 'VÁRZEA DO LOPES MVL - OURO BRANCO P6', '15', '-20.2955510', '-43.9386160', '-20.5378500', '-43.7598820', '292'),
(73, 'MVL-UOB P6 CATIVA', 'VÁRZEA DO LOPES MVL - OURO BRANCO P6', '61', '-20.2955510', '-43.9386160', '-20.5378500', '-43.7598820', '292'),
(74, 'MVL-UOB SPOT', 'VÁRZEA DO LOPES MVL - OURO BRANCO', '238', '-20.2955510', '-43.9386160', '-20.5378500', '-43.7598820', '292'),
(75, 'MVL-USIMINAS', 'VÁRZEA DO LOPES MVL - USIMINAS', '37', '-20.2955510', '-43.9386160', '-19.4784830', '-42.5309970', '309'),
(76, 'MVL-USIMINAS SPOT', 'VÁRZEA DO LOPES MVL - USIMINAS', '36', '-20.2955510', '-43.9386160', '-19.4784830', '-42.5309970', '309'),
(77, 'MVL-VALE', 'VÁRZEA DO LOPES MVL - VALE S A', '7', '-20.2955510', '-43.9386160', '-20.1834680', ' -43.8735230', '303'),
(78, 'MVL-VALE PATRAG SPOT', 'VÁRZEA DO LOPES MVL - VALE SA', '185', '-20.2955510', '-43.9386160', '-20.1834680', ' -43.8735230', '303'),
(79, 'VLN - HERCULANO', 'VÁRZEA LESTE NORTE VLN - HERCULANO', '187', '-20.2868660', '-43.9014540', '-20.2535580', '-43.9267590', '301'),
(80, 'VLN - HERCULANO CATIVO', 'VÁRZEA LESTE NORTE VLN - HERCULANO', '183', '-20.2868660', '-43.9014540', '-20.2535580', '-43.9267590', '301'),
(81, 'VLN - LGA', 'VÁRZEA LESTE NORTE VLN - LGA', '188', '-20.2868660', '-43.9014540', '-20.5378820', '-43.8015110', '291'),
(82, 'VLN - LGA SPOT', 'VÁRZEA LESTE NORTE VLN - LGA', '184', '-20.2868660', '-43.9014540', '-20.5378820', '-43.8015110', '291'),
(83, 'VLN - SAFM', 'VÁRZEA LESTE NORTE VLN - SAFM', '182', '-20.2868660', '-43.9014540', '-20.2690110', '-43.8951580', '299'),
(84, 'VLN - SAFM CATIVO', 'VÁRZEA LESTE NORTE VLN - SAFM', '186', '-20.2868660', '-43.9014540', '-20.2690110', '-43.8951580', '299'),
(85, 'UTM1-LGA', 'MIGUEL BURNIER MMB - LGA', '117', '-20.43262010', '-43.7739670', '-20.5378820', '-43.8015110', '290'),
(86, 'UTM1-LGA CATIVO', 'MIGUEL BURNIER MMB - LGA', '118', '-20.43262010', '-43.7739670', '-20.5378820', '-43.8015110', '290');

-- --------------------------------------------------------

--
-- Estrutura da tabela `saida_automacoes`
--

CREATE TABLE `saida_automacoes` (
  `id` int(11) NOT NULL,
  `epc_carreta` varchar(30) DEFAULT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `veiculo` varchar(20) DEFAULT NULL,
  `data_leitura` varchar(20) DEFAULT NULL,
  `dia` varchar(10) DEFAULT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `ano` varchar(5) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL,
  `confirmacao` varchar(20) DEFAULT NULL,
  `tempo_confirmacao` varchar(10) DEFAULT NULL,
  `motivo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sincronizar_dados`
--

CREATE TABLE `sincronizar_dados` (
  `id` int(11) NOT NULL,
  `id_lidar` varchar(10) DEFAULT NULL,
  `id_cheio_vazio` varchar(10) DEFAULT NULL,
  `id_historico` varchar(10) DEFAULT NULL,
  `epc_carreta` varchar(30) DEFAULT NULL,
  `placa_carreta` varchar(20) DEFAULT NULL,
  `epc_cavalo` varchar(30) DEFAULT NULL,
  `placa_cavalo` varchar(20) DEFAULT NULL,
  `dlc` varchar(10) DEFAULT NULL,
  `dtc` varchar(10) DEFAULT NULL,
  `alerta2` varchar(30) DEFAULT NULL,
  `veiculo` varchar(20) DEFAULT NULL,
  `condicao_veiculo` varchar(30) DEFAULT NULL,
  `api_cheio_vazio` varchar(30) DEFAULT NULL,
  `data_leitura` varchar(20) DEFAULT NULL,
  `dia` varchar(10) DEFAULT NULL,
  `mes` varchar(10) DEFAULT NULL,
  `ano` varchar(5) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `transportadoras`
--

CREATE TABLE `transportadoras` (
  `id` int(11) NOT NULL,
  `sigla` varchar(30) NOT NULL,
  `nome` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Extraindo dados da tabela `transportadoras`
--

INSERT INTO `transportadoras` (`id`, `sigla`, `nome`) VALUES
(1, 'BVC', 'BVC TRANSPORTES LTDA'),
(2, 'LL', 'L L TRANSPORTES LTDA'),
(3, 'D Paula', 'DE PAULA TRANSPORTADORA LTDA'),
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
(14, 'FJX', 'FJX TRANSPORTES LTDA '),
(15, 'FERTRAN', 'FERTRAN TRANSPORTES LTDA ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `registro` varchar(20) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `alterar` varchar(5) DEFAULT NULL,
  `justificativas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `registro`, `senha`, `alterar`, `justificativas`) VALUES
(1, 'Bruno Gonçalves', '37063378', 'gerdau', '0', '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `validacoes_feitas_tora_fjx`
--

CREATE TABLE `validacoes_feitas_tora_fjx` (
  `id` int(11) NOT NULL,
  `placa_ou_tag` varchar(30) DEFAULT NULL,
  `placa_cavalo` varchar(12) DEFAULT NULL,
  `data_insercao` varchar(12) DEFAULT NULL,
  `hora_insercao` varchar(12) DEFAULT NULL,
  `validado` varchar(20) DEFAULT NULL,
  `data_validacao` varchar(12) DEFAULT NULL,
  `hora_validacao` varchar(10) DEFAULT NULL,
  `origem_latitude` varchar(20) DEFAULT NULL,
  `origem_longitude` varchar(20) DEFAULT NULL,
  `destino_latitude` varchar(20) DEFAULT NULL,
  `destino_longitude` varchar(20) DEFAULT NULL,
  `cod_hh2risk` varchar(10) DEFAULT NULL,
  `resposta_hh2risk` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `validacoes_socket`
--

CREATE TABLE `validacoes_socket` (
  `id` int(11) NOT NULL,
  `epc_carreta` varchar(30) DEFAULT NULL,
  `data_leitura` varchar(20) DEFAULT NULL,
  `hora_leitura` varchar(20) DEFAULT NULL,
  `condicao` varchar(50) DEFAULT NULL,
  `data_tratado` varchar(20) DEFAULT NULL,
  `hora_tratado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estrutura da tabela `validacoes_tags_tora_fjx`
--

CREATE TABLE `validacoes_tags_tora_fjx` (
  `id` int(11) NOT NULL,
  `placa_ou_tag` varchar(30) DEFAULT NULL,
  `validado` varchar(20) DEFAULT NULL,
  `data_validacao` varchar(12) DEFAULT NULL,
  `hora_validacao` varchar(12) DEFAULT NULL,
  `sigla` varchar(30) DEFAULT NULL
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
-- Índices para tabela `atualizacao`
--
ALTER TABLE `atualizacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `atualizacao_services`
--
ALTER TABLE `atualizacao_services`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `display_balanca1`
--
ALTER TABLE `display_balanca1`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `hh2risk_cadastro_motoristas`
--
ALTER TABLE `hh2risk_cadastro_motoristas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `hh2risk_cadastro_placas`
--
ALTER TABLE `hh2risk_cadastro_placas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_display`
--
ALTER TABLE `historico_display`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_leituras`
--
ALTER TABLE `historico_leituras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_lora`
--
ALTER TABLE `historico_lora`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_match`
--
ALTER TABLE `historico_match`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_recebido_python`
--
ALTER TABLE `historico_recebido_python`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_socket`
--
ALTER TABLE `historico_socket`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `lidar_excesso`
--
ALTER TABLE `lidar_excesso`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `lista_tags`
--
ALTER TABLE `lista_tags`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mensagens_lora`
--
ALTER TABLE `mensagens_lora`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pendente_saida_automacoes`
--
ALTER TABLE `pendente_saida_automacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `rotas`
--
ALTER TABLE `rotas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `saida_automacoes`
--
ALTER TABLE `saida_automacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sincronizar_dados`
--
ALTER TABLE `sincronizar_dados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `validacoes_feitas_tora_fjx`
--
ALTER TABLE `validacoes_feitas_tora_fjx`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `validacoes_socket`
--
ALTER TABLE `validacoes_socket`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `validacoes_tags_tora_fjx`
--
ALTER TABLE `validacoes_tags_tora_fjx`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alerta_antenas`
--
ALTER TABLE `alerta_antenas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `atualizacao`
--
ALTER TABLE `atualizacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `atualizacao_services`
--
ALTER TABLE `atualizacao_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `display_balanca1`
--
ALTER TABLE `display_balanca1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `hh2risk_cadastro_motoristas`
--
ALTER TABLE `hh2risk_cadastro_motoristas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `hh2risk_cadastro_placas`
--
ALTER TABLE `hh2risk_cadastro_placas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `historico_display`
--
ALTER TABLE `historico_display`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_leituras`
--
ALTER TABLE `historico_leituras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_lora`
--
ALTER TABLE `historico_lora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_match`
--
ALTER TABLE `historico_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_recebido_python`
--
ALTER TABLE `historico_recebido_python`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_socket`
--
ALTER TABLE `historico_socket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lidar_excesso`
--
ALTER TABLE `lidar_excesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT de tabela `lista_tags`
--
ALTER TABLE `lista_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1740;

--
-- AUTO_INCREMENT de tabela `mensagens_lora`
--
ALTER TABLE `mensagens_lora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pendente_saida_automacoes`
--
ALTER TABLE `pendente_saida_automacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rotas`
--
ALTER TABLE `rotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de tabela `saida_automacoes`
--
ALTER TABLE `saida_automacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sincronizar_dados`
--
ALTER TABLE `sincronizar_dados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `validacoes_feitas_tora_fjx`
--
ALTER TABLE `validacoes_feitas_tora_fjx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `validacoes_socket`
--
ALTER TABLE `validacoes_socket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `validacoes_tags_tora_fjx`
--
ALTER TABLE `validacoes_tags_tora_fjx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
