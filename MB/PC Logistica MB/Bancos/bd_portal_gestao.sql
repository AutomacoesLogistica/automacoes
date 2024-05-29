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
-- Banco de dados: `bd_portal_gestao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `rede_dez_xx`
--

CREATE TABLE `rede_dez_xx` (
  `id` int NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `ip` varchar(20) DEFAULT NULL,
  `gateway` varchar(20) DEFAULT NULL,
  `mascara` varchar(20) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `informacao_adicional` varchar(400) DEFAULT NULL,
  `ativo` varchar(5) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `usuario` varchar(10) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `disponivel` varchar(5) DEFAULT NULL,
  `editado_por` varchar(100) DEFAULT NULL,
  `data` varchar(20) DEFAULT NULL,
  `hora` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `rede_dez_xx`
--

INSERT INTO `rede_dez_xx` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(1, 'UTMI_RB2011_01 - Sala Log', '192.168.10.01', '10.10.25.1', '255.255.255.0', 'RB2011', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(2, 'UTMI_RB2011_02 - Sala Log', '192.168.10.02', '192.168.10.1', '255.255.255.0', 'RB2011', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(3, 'UTMI_RB2011_03 - Sala Log', '192.168.10.03', '192.168.10.1', '255.255.255.0', 'RB2011', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(4, 'Raspberry Portal CCL UTMI', '192.168.10.04', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(5, 'Raspberry Dashboard UTMI', '192.168.10.05', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(6, 'Mesa PTZ CCL UTMI', '192.168.10.06', '192.168.10.1', '255.255.255.0', 'PTZ', 'PTZ', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(7, 'CIP850 CCL UTMI', '192.168.10.07', '192.168.10.1', '255.255.255.0', 'CIP850', 'CIP', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(8, 'TIP450 Mesa CCL UTMI', '192.168.10.08', '192.168.10.1', '255.255.255.0', 'TIP', 'TIP', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(9, 'NVR TV 1 CCL UTMI', '192.168.10.09', '192.168.10.1', '255.255.255.0', 'NVR', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(10, 'NVR TV 2 CCL UTMI', '192.168.10.10', '192.168.10.1', '255.255.255.0', 'NVR', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(11, 'NVR TV 3 CCL UTMI', '192.168.10.11', '192.168.10.1', '255.255.255.0', 'NVR', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(12, 'NVR TV 4 CCL UTMI', '192.168.10.12', '192.168.10.1', '255.255.255.0', 'NVR', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(13, 'NVR TV 7 CCL UTMI', '192.168.10.13', '192.168.10.1', '255.255.255.0', 'NVR', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(14, 'NVR TV 8 CCL UTMI', '192.168.10.14', '192.168.10.1', '255.255.255.0', 'NVR', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(15, 'UTMI_RB750_Mesa_Bruno', '192.168.10.15', '192.168.10.1', '255.255.255.0', 'RB750', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(16, 'UTMI_RB750_Painel_Escada', '192.168.10.16', '192.168.10.1', '255.255.255.0', 'RB750', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(17, 'IP disponivel para utlização', '192.168.10.17', '192.168.10.135', '255.255.255.0', 'MHDX1116', 'NVR', 'NVR para usar na sala do pablo dhjaishdkjash dhaskj dhaskj', 'Não', 'Offline', 'admin', 'Pablo123@#', 'Não', 'BRUNO GONCALVES', '12/05/2023', '14:39:45'),
(18, 'Reader Patio Excesso', '192.168.10.18', '192.168.10.1', '255.255.255.0', 'ALR-F800', 'Reader', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(19, 'Câmera Placa Excesso', '192.168.10.19', '192.168.10.1', '255.255.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(20, 'Raspberry Excesso', '192.168.10.20', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(21, 'Raspaberry Controle de Acesso UTMI', '192.168.10.21', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(22, 'IP disponivel para utlização', '192.168.10.22', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(23, 'IP disponivel para utlização', '192.168.10.23', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(24, 'UTMI_Groove_EscritorioLog', '192.168.10.24', '192.168.10.1', '255.255.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(25, 'IP disponivel para utlização', '192.168.10.25', '192.168.10.1', '255.255.255.0', 'Não definido', 'Não definido', 'Sem dados complementares', 'nao', 'Offline', 'admin', 'Logistica2019@@', 'Sim', 'BRUNO GONCALVES', '11/05/2023', '16:25:22'),
(26, 'STX ptp_UTMI_para_Bal2', '192.168.10.26', '192.168.10.1', '255.255.255.0', 'SXT', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(27, 'SXT ptp_Balanca2_para_UTMI', '192.168.10.27', '192.168.10.1', '255.255.255.0', 'SXT', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(28, 'RB750 Balanca 2', '192.168.10.28', '192.168.10.1', '255.255.255.0', 'RB750', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(29, 'Câmera bascula balanca 2', '192.168.10.29', '192.168.10.1', '255.255.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(30, 'Câmera bascula balanca 1', '192.168.10.30', '192.168.10.1', '255.255.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(31, 'NVR Logistica TV1', '192.168.10.31', '192.168.10.1', '255.255.255.0', 'MHDX1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(32, 'NVR Logistica TV2', '192.168.10.32', '192.168.10.1', '255.255.255.0', 'MHDX1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(33, 'ATA Sala Logistica', '192.168.10.33', '192.168.10.1', '255.255.255.0', 'Não definido', 'ATA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(34, 'Raspberry CA UTM1', '192.168.10.34', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(35, 'ROCK PI Automação Poste Saida balança 1', '192.168.10.35', '192.168.10.1', '255.255.255.0', 'ROCK PI', 'ROCK PI', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(36, 'Raspberry Automacoes Segur Pro Saida Balanca 1', '192.168.10.36', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(37, 'Reader denise', '192.168.10.37', '192.168.10.1', '255.255.255.0', 'ALR-F800', 'Reader', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(38, 'IP disponivel para utlização', '192.168.10.38', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(39, 'Radio Wifi Manutenção Radar', '192.168.10.39', '192.168.10.1', '255.255.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(40, 'Radio Recebe link Radar Restaurante 2.4', '192.168.10.40', '192.168.10.1', '255.255.255.0', 'SXT', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(41, 'CAM Placa Radar Restaurante MB', '192.168.10.41', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(42, 'Raspberry Radar Restaurante MB', '192.168.10.42', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(43, 'Camera Pátio UTMI', '192.168.10.43', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(44, 'ATA CA_UTMI - RAMAL 211   SENHA : logistica2020@@', '192.168.10.44', '192.168.10.1', '255.255.255.0', 'ATA200', 'ATA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(45, 'Reader CA UTMI', '192.168.10.45', '192.168.10.1', '255.255.255.0', 'ALR-F800', 'Reader', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(46, 'Camera Sala Logistica', '192.168.10.46', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(47, 'Radio CA_UTMI/SalaLog', '192.168.10.47', '192.168.10.1', '255.255.255.0', 'SXT', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(48, 'RB750 CA_UTMI', '192.168.10.48', '192.168.10.1', '255.255.255.0', 'Não definido', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(49, 'Camera CA UTMI Placa', '192.168.10.49', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(50, 'Radio UTMI para Poste Bal 1', '192.168.10.50', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(51, 'Radio Poste Bal 1 para UTMI', '192.168.10.51', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(52, 'Radio Poste Bal 1 para Bal 1', '192.168.10.52', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(53, 'Radio Bal 1 para Poste Bal 1', '192.168.10.53', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(54, 'UTMI_ptp_PosteBalanca1_para_SegurPro', '192.168.10.54', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(55, 'UTMI_ptp_SegurPro_para_PosteBalanca1', '192.168.10.55', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(56, 'UTMI_ptp_Balanca1_para_SegurPro', '192.168.10.56', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(57, 'UTMI_ptp_SegurPro_para_Balanca1', '192.168.10.57', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(58, 'Radio Poste Restaurante UTMI para Poste Bal 2 ( 2.4 )', '192.168.10.58', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(59, 'Radio Poste Bal2 para Poste Restaurante UTMI ( 2.4 )', '192.168.10.59', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(60, 'UTMI_ptp_PosteBal2_para_SalaLog', '192.168.10.60', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(61, 'UTMI_ptp_SalaLog_CA_UTMI', '192.168.10.61', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(62, 'UTMI_ptp_PosteBal2_para_Excesso', '192.168.10.62', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(63, 'Radio patio de Excesso para Poste Bal 2', '192.168.10.63', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(64, 'Radio Patio de Excesso para Poste Patio LGA', '192.168.10.64', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(65, 'Radio Poste Patio LGA para Excesso', '192.168.10.65', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(66, 'Radio Poste LGA para Sala Logistica', '192.168.10.66', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(67, 'UTMI_ptp_SalaLog_PosteBal2', '192.168.10.67', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(68, 'UTMI_ptp_SalaLog_para_UTMI', '192.168.10.68', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(69, 'IP disponivel para utlização', '192.168.10.69', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(70, 'Radio UTMI para Excesso ( Hoje esta pelo groove )', '192.168.10.70', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(71, 'Câmera Placa Poste Saida Bal 1', '192.168.10.71', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(72, 'Câmera Báscula Poste Saida Bal 1', '192.168.10.72', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(73, 'Câmera Visão Poste saida Bal 1', '192.168.10.73', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(74, 'ATA 200 Poste Saida Bal 1', '192.168.10.74', '192.168.10.1', '255.255.255.0', 'Não definido', 'ATA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(75, 'Mikrotik UMTI/Automacao', '192.168.10.75', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(76, 'Câmera Placa Poste Segur Pro', '192.168.10.76', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(77, 'Câmera Báscula Poste Segur Pro', '192.168.10.77', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(78, 'RB750 Poste Saida Bal 1', '192.168.10.78', '192.168.10.1', '255.255.255.0', 'Não definido', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(79, 'RB750 Poste Segur Pro', '192.168.10.79', '192.168.10.1', '255.255.255.0', 'Não definido', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(80, 'UTMI_RB750_Balanca01', '192.168.10.80', '192.168.10.1', '255.255.255.0', 'Não definido', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(81, 'Câmera Visão Saida Poste Segur Pro', '192.168.10.81', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(82, 'UTMI_RB750_PosteBal2', '192.168.10.82', '192.168.10.1', '255.255.255.0', 'Não definido', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(83, 'RB750 Patio Excesso-Link1-PosteBalanca2', '192.168.10.83', '192.168.10.1', '255.255.255.0', 'Não definido', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(84, 'Câmera Visão Patio LGA 1', '192.168.10.84', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(85, 'Câmera Visão Patio LGA 2', '192.168.10.85', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(86, 'Câmera Visão Excesso Patio LGA', '192.168.10.86', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(87, 'Câmera Visão Entrada Balança 1', '192.168.10.87', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(88, 'Câmera Balanca 2 Visao 1\n', '192.168.10.88', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(89, 'Câmera Balanca 2 Visao 2', '192.168.10.89', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(90, 'Módulo SVA Balanca 01', '192.168.10.90', '192.168.10.1', '255.255.255.0', 'Não definido', 'SVA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(91, 'Lidar SVA Siada Balanca 01', '192.168.10.91', '192.168.10.1', '255.255.255.0', 'Não definido', 'SVA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(92, 'IP disponivel para utlização', '192.168.10.92', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(93, 'Servidor Balanca 1 LIDAR+Video Analitico', '192.168.10.93', '192.168.10.1', '255.255.255.0', 'Não definido', 'SVA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(94, 'Reader Poste Saida Bal 1', '192.168.10.94', '192.168.10.1', '255.255.255.0', 'Não definido', 'Reader', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(95, 'Servidor Balanca 1 - CheioVazio+Placa', '192.168.10.95', '192.168.10.1', '255.255.255.0', 'Não definido', 'SVA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(96, 'Computador Logistica', '192.168.10.96', '192.168.10.1', '255.255.255.0', 'PC', 'PC', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(97, 'UTMI_ptp_CFTV_PatioExcesso_SalaLog', '192.168.10.97', '192.168.10.1', '255.255.255.0', 'SXT5', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(98, 'Raspberry Dashboard UTMI', '192.168.10.98', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(99, 'IP disponivel para utlização', '192.168.10.99', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(100, 'Display Automacoes Saida Poste Balanca 1', '192.168.10.100', '192.168.10.1', '255.255.255.0', 'Display', 'Display TCP/IP', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(101, 'Câmera visão display poste saida balanca 1', '192.168.10.101', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(102, 'Raspberry Balanca 1', '192.168.10.102', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(103, 'IP disponivel para utlização', '192.168.10.103', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(104, 'IP disponivel para utlização', '192.168.10.104', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(105, 'UTMI_GAGF_Patio_UTMI_NOVO', '192.168.10.105', '192.168.10.1', '255.255.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(106, 'UTMI_RB750_Painel_UTMI_Patio', '192.168.10.106', '192.168.10.1', '255.255.255.0', 'RB750', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(107, 'Camera_UTMI_Visao1 - Direita ( visao lado cemiterio )', '192.168.10.107', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(108, 'Camera_UTMI_Visao2 - Esquerda ( visao cancelas utm1)', '192.168.10.108', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(109, 'UTMI_ptp_Painel_UTMI_Patio_para_CA_UTMI', '192.168.10.109', '192.168.10.1', '255.255.255.0', 'SXT', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(110, 'UTMI_ptp_CA_UTMI_para_Painel_UTMI_Patio', '192.168.10.110', '192.168.10.1', '255.255.255.0', 'SXT', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(111, 'IP disponivel para utlização', '192.168.10.111', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(112, 'IP disponivel para utlização', '192.168.10.112', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(113, 'Câmera Patio Excesso UTMI  -   554', '192.168.10.113', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(114, 'IP disponivel para utlização', '192.168.10.114', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(115, 'IP disponivel para utlização', '192.168.10.115', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(116, 'IP disponivel para utlização', '192.168.10.116', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(117, 'UTMI_ptp_PostaBal1_para_Antenas', '192.168.10.117', '192.168.10.1', '255.255.255.0', 'LHG XL 2', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(118, 'IP disponivel para utlização', '192.168.10.118', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(119, 'IP disponivel para utlização', '192.168.10.119', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(120, 'IP disponivel para utlização', '192.168.10.120', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(121, 'IP disponivel para utlização', '192.168.10.121', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(122, 'IP disponivel para utlização', '192.168.10.122', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(123, 'RB750 UTMI para automacao', '192.168.10.123', '192.168.10.1', '255.255.255.0', 'RB750', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(124, 'IP disponivel para utlização', '192.168.10.124', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(125, 'IP disponivel para utlização', '192.168.10.125', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(126, 'IP disponivel para utlização', '192.168.10.126', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(127, 'IP disponivel para utlização', '192.168.10.127', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(128, 'IP disponivel para utlização', '192.168.10.128', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(129, 'IP disponivel para utlização', '192.168.10.129', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(130, 'IP disponivel para utlização', '192.168.10.130', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(131, 'IP disponivel para utlização', '192.168.10.131', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(132, 'IP disponivel para utlização', '192.168.10.132', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(133, 'IP disponivel para utlização', '192.168.10.133', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(134, 'IP disponivel para utlização', '192.168.10.134', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(135, 'IP disponivel para utlização', '192.168.10.135', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(136, 'IP disponivel para utlização', '192.168.10.136', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(137, 'IP disponivel para utlização', '192.168.10.137', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(138, 'GAGF Recebe Link Patio UTMI para Excesso', '192.168.10.138', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(139, 'IP disponivel para utlização', '192.168.10.139', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(140, 'IP disponivel para utlização', '192.168.10.140', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(141, 'IP disponivel para utlização', '192.168.10.141', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(142, 'IP disponivel para utlização', '192.168.10.142', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(143, 'Cria Link Poste ROM UTMI/ Poste Vista Lateral', '192.168.10.143', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(144, 'IP disponivel para utlização', '192.168.10.144', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(145, 'IP disponivel para utlização', '192.168.10.145', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(146, 'IP disponivel para utlização', '192.168.10.146', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(147, 'IP disponivel para utlização', '192.168.10.147', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(148, 'IP disponivel para utlização', '192.168.10.148', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(149, 'IP disponivel para utlização', '192.168.10.149', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(150, 'IP disponivel para utlização', '192.168.10.150', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(151, 'IP disponivel para utlização', '192.168.10.151', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(152, 'IP disponivel para utlização', '192.168.10.152', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(153, 'IP disponivel para utlização', '192.168.10.153', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(154, 'IP disponivel para utlização', '192.168.10.154', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(155, 'IP disponivel para utlização', '192.168.10.155', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(156, 'IP disponivel para utlização', '192.168.10.156', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(157, 'IP disponivel para utlização', '192.168.10.157', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(158, 'IP disponivel para utlização', '192.168.10.158', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(159, 'GAGF Poste ROM UTMI', '192.168.10.159', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(160, 'IP disponivel para utlização', '192.168.10.160', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(161, 'IP disponivel para utlização', '192.168.10.161', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(162, 'IP disponivel para utlização', '192.168.10.162', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(163, 'IP disponivel para utlização', '192.168.10.163', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(164, 'IP disponivel para utlização', '192.168.10.164', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(165, 'IP disponivel para utlização', '192.168.10.165', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(166, 'IP disponivel para utlização', '192.168.10.166', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(167, 'IP disponivel para utlização', '192.168.10.167', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(168, 'IP disponivel para utlização', '192.168.10.168', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(169, 'IP disponivel para utlização', '192.168.10.169', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(170, 'IP disponivel para utlização', '192.168.10.170', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(171, 'IP disponivel para utlização', '192.168.10.171', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(172, 'IP disponivel para utlização', '192.168.10.172', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(173, 'UTMI_ptp_SalaLog_para_CFTV_Excesso', '192.168.10.173', '192.168.10.1', '255.255.255.0', 'SXT', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(174, 'IP disponivel para utlização', '192.168.10.174', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(175, 'IP disponivel para utlização', '192.168.10.175', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(176, 'IP disponivel para utlização', '192.168.10.176', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(177, 'NVR Operação Mina', '192.168.10.177', '192.168.10.1', '255.255.255.0', 'MHDX1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(178, 'UTMI Patio ROM 1', '192.168.10.178', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(179, 'UTMI Patio ROM 2', '192.168.10.179', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(180, 'IP disponivel para utlização', '192.168.10.180', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(181, 'IP disponivel para utlização', '192.168.10.181', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(182, 'IP disponivel para utlização', '192.168.10.182', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(183, 'IP disponivel para utlização', '192.168.10.183', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(184, 'IP disponivel para utlização', '192.168.10.184', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(185, 'Swtich UTMI', '192.168.10.185', '192.168.10.1', '255.255.255.0', 'Não definido', 'Modem', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(186, 'IP disponivel para utlização', '192.168.10.186', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(187, 'IP disponivel para utlização', '192.168.10.187', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(188, 'PROVISIORIO RADIO SAIDA MB PARA ANTENA - 118', '192.168.10.188', '192.168.10.1', '255.255.255.0', 'Não definido', 'Não definido', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(189, 'IP disponivel para utlização', '192.168.10.189', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(190, 'IP disponivel para utlização', '192.168.10.190', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(191, 'NVR Balanca 1', '192.168.10.191', '192.168.10.1', '255.255.255.0', 'MHDX10004', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(192, 'NVR Balanca 2', '192.168.10.192', '192.168.10.1', '255.255.255.0', 'MHDX10004', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(193, 'IP disponivel para utlização', '192.168.10.193', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(194, 'IP disponivel para utlização', '192.168.10.194', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(195, 'IP disponivel para utlização', '192.168.10.195', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(196, 'IP disponivel para utlização', '192.168.10.196', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(197, 'Radio Provisorio Display', '192.168.10.197', '192.168.10.1', '255.255.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(198, 'Camera Provisoria display escritorio utm1', '192.168.10.198', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(199, 'Camera Escritorio Logistica UTMI', '192.168.10.199', '192.168.10.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(200, 'Raspberry Automação Logística', '192.168.10.200', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(201, 'IP disponivel para utlização', '192.168.10.201', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(202, 'IP disponivel para utlização', '192.168.10.202', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(203, 'PC 01 LOG', '192.168.10.203', '192.168.10.1', '255.255.255.0', 'Não definido', 'Não definido', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(204, 'Raspberry Lidar Sala Logistica', '192.168.10.204', '192.168.10.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(205, 'IP disponivel para utlização', '192.168.10.205', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(206, 'IP disponivel para utlização', '192.168.10.206', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(207, 'IP disponivel para utlização', '192.168.10.207', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(208, 'IP disponivel para utlização', '192.168.10.208', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(209, 'IP disponivel para utlização', '192.168.10.209', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(210, 'IP disponivel para utlização', '192.168.10.210', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(211, 'IP disponivel para utlização', '192.168.10.211', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(212, 'IP disponivel para utlização', '192.168.10.212', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(213, 'IP disponivel para utlização', '192.168.10.213', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(214, 'IP disponivel para utlização', '192.168.10.214', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(215, 'IP disponivel para utlização', '192.168.10.215', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(216, 'IP disponivel para utlização', '192.168.10.216', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(217, 'IP disponivel para utlização', '192.168.10.217', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(218, 'IP disponivel para utlização', '192.168.10.218', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(219, 'IP disponivel para utlização', '192.168.10.219', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(220, 'IP disponivel para utlização', '192.168.10.220', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(221, 'IP disponivel para utlização', '192.168.10.221', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(222, 'IP disponivel para utlização', '192.168.10.222', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(223, 'IP disponivel para utlização', '192.168.10.223', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(224, 'UTMI_ptp_SalaLog_para_RecRom', '192.168.10.224', '192.168.10.1', '255.255.255.0', 'SXT5', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00');
INSERT INTO `rede_dez_xx` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(225, 'UTMI_ptp_RecRom_para_SalaLog', '192.168.10.225', '192.168.10.1', '255.255.255.0', 'SXT5', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(226, 'UTMI_RB750_PatioRecROM', '192.168.10.226', '192.168.10.1', '255.255.255.0', 'RB750', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(227, 'UTMI_Groove_PatioRecROM', '192.168.10.227', '192.168.10.1', '255.255.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(228, 'UTMI_ptp_SalaLog_para_Patrimonial', '192.168.10.228', '192.168.10.1', '255.255.255.0', 'SXT', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(229, 'UTMI_ptp_Patrimonial_para_SalaLog', '192.168.10.229', '192.168.10.1', '255.255.255.0', 'SXT', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(230, 'NVR_Patrimonia1', '192.168.10.230', '192.168.10.1', '255.255.255.0', 'NVR', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(231, 'IP disponivel para utlização', '192.168.10.231', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(232, 'IP disponivel para utlização', '192.168.10.232', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(233, 'UTMI_GAGF_Patio_UTMI', '192.168.10.233', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(234, 'IP disponivel para utlização', '192.168.10.234', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(235, 'IP disponivel para utlização', '192.168.10.235', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(236, 'IP disponivel para utlização', '192.168.10.236', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(237, 'IP disponivel para utlização', '192.168.10.237', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(238, 'IP disponivel para utlização', '192.168.10.238', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(239, 'IP disponivel para utlização', '192.168.10.239', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(240, 'IP disponivel para utlização', '192.168.10.240', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(241, 'IP disponivel para utlização', '192.168.10.241', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(242, 'IP disponivel para utlização', '192.168.10.242', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(243, 'IP disponivel para utlização', '192.168.10.243', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(244, 'IP disponivel para utlização', '192.168.10.244', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(245, 'IP disponivel para utlização', '192.168.10.245', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(246, 'IP disponivel para utlização', '192.168.10.246', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(247, 'IP disponivel para utlização', '192.168.10.247', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(248, 'IP disponivel para utlização', '192.168.10.248', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(249, 'IP disponivel para utlização', '192.168.10.249', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(250, 'MikroTik_Automacao_UTMI', '192.168.10.250', '192.168.10.1', '255.255.255.0', 'Não definido', 'Rede', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(251, 'MikroTik_Automacao_UTMI', '192.168.10.251', '192.168.10.1', '255.255.255.0', 'Não definido', 'Não definido', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(252, 'IP disponivel para utlização', '192.168.10.252', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(253, 'Tablet Excesso MB', '192.168.10.253', '192.168.10.1', '255.255.255.0', 'Tablet', 'Tablet', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '10/05/2023', '10:30:00'),
(254, 'IP disponivel para utlização', '192.168.10.254', '192.168.10.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '10/05/2023', '10:30:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `rede_quarenta_xx`
--

CREATE TABLE `rede_quarenta_xx` (
  `id` int NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modelo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ativo` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `disponivel` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `editado_por` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hora` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rede_trinta_xx`
--

CREATE TABLE `rede_trinta_xx` (
  `id` int NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modelo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ativo` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `disponivel` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `editado_por` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hora` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `rede_vinte_xx`
--

CREATE TABLE `rede_vinte_xx` (
  `id` int NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modelo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ativo` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usuario` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `disponivel` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `editado_por` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hora` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_equipamentos`
--

CREATE TABLE `tabela_equipamentos` (
  `id` int NOT NULL,
  `ponto` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_rede` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip_externo` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_backup` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_foto_equipamento` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_foto_instalacao` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `condicao` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tabela_equipamentos`
--

INSERT INTO `tabela_equipamentos` (`id`, `ponto`, `nome_rede`, `ip`, `ip_externo`, `caminho_backup`, `caminho_foto_equipamento`, `caminho_foto_instalacao`, `condicao`) VALUES
(1, 'Rack Logistica', 'UTMI_RB2011_SalaLog', '192.168.10.1', 'http://138.0.77.80:3000', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_RB2011_SalaLog.rar', '/gagf/images/portal_gestao/tipo/tipo_RB2011.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_RB2011_SalaLog.PNG', 'online'),
(2, 'Rack Logistica', 'UTMI_RB2011_02_SalaLog', '192.168.10.2', 'http://138.0.77.80:3335', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_RB2011_02_SalaLog.rar', '/gagf/images/portal_gestao/tipo/tipo_RB2011.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_RB2011_02_SalaLog.PNG', 'online'),
(3, 'Rack Logistica', 'UTMI_ptp_SalaLog_para_UTMI', '192.168.10.68', 'http://138.0.77.80:3585', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_ptp_SalaLog_para_UTMI.rar', '/gagf/images/portal_gestao/tipo/tipo_SXT.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_ptp_SalaLog_para_UTMI.png', 'online'),
(4, 'Rack Logistica', 'UTMI_ptp_SalaLog_CA_UTMI', '192.168.10.61', 'http://138.0.77.80:3024', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_ptp_SalaLog_CA_UTMI.rar', '/gagf/images/portal_gestao/tipo/tipo_SXT.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_ptp_SalaLog_CA_UTMI.png', 'online'),
(5, 'Rack Logistica', 'UTMI_ptp_SalaLog_PosteBal2', '192.168.10.67', 'http://138.0.77.80:3560', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_ptp_SalaLog_PosteBal2.rar', '/gagf/images/portal_gestao/tipo/tipo_SXT.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_ptp_SalaLog_PosteBal2.png', 'online'),
(6, 'Rack Logistica', 'UTMI_ptp_SalaLog_para_CFTV_Excesso', '192.168.10.173', 'http://138.0.77.80:3013', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_ptp_SalaLog_para_CFTV_Excesso.rar', '/gagf/images/portal_gestao/tipo/tipo_SXT.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_ptp_SalaLog_para_CFTV_Excesso.png', 'online'),
(7, 'Rack Logistica', 'UTMI_ptp_SalaLog_para_Rom', '192.168.10.224', 'http://138.0.77.80:3604', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_ptp_SalaLog_para_RecRom.rar', '/gagf/images/portal_gestao/tipo/tipo_SXT.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_ptp_SalaLog_para_RecRom.png', 'online'),
(8, 'Rack Logistica', 'UTMI_ptp_SalaLog_para_Patrimonial', '192.168.10.228', 'http://138.0.77.80:3605', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_ptp_SalaLog_para_Patrimonial.rar', '/gagf/images/portal_gestao/tipo/tipo_SXT.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_ptp_SalaLog_para_Patrimonial.png', 'online'),
(9, 'Rack Logistica', 'UTMI_ptp_SalaLog_NVR32', '192.168.10.24', 'http://138.0.77.80:3483', '/gagf/gerenciador/mb/arquivos/backup/Rack Logistica/UTMI_ptp_SalaLog_NVR32.rar', '/gagf/images/portal_gestao/tipo/tipo_Groove.PNG', '/gagf/images/portal_gestao/Rack Logistica/instalacao_UTMI_ptp_SalaLog_NVR32.PNG', 'online');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_modelo`
--

CREATE TABLE `tabela_modelo` (
  `id` int NOT NULL,
  `modelo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tabela_modelo`
--

INSERT INTO `tabela_modelo` (`id`, `modelo`) VALUES
(1, 'A52-Hpn'),
(2, 'ALR-F800'),
(3, 'ATA200'),
(4, 'CIP850'),
(5, 'Display'),
(6, 'LHG XL 2'),
(7, 'MHDX10004'),
(8, 'MHDX1116'),
(9, 'N/A'),
(10, 'Não definido'),
(11, 'NVR'),
(12, 'PC'),
(13, 'PI3 B+'),
(14, 'PTZ'),
(15, 'RB2011'),
(16, 'RB750'),
(17, 'ROCK PI'),
(18, 'SXT'),
(19, 'SXT5'),
(20, 'SXT2'),
(21, 'Tablet'),
(22, 'TIP'),
(23, 'VIP1020B');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_referencia`
--

CREATE TABLE `tabela_referencia` (
  `id` int NOT NULL,
  `ponto` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `area` varchar(70) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_foto1` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_foto2` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_foto3` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao1` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tabela_referencia`
--

INSERT INTO `tabela_referencia` (`id`, `ponto`, `site`, `area`, `caminho_foto1`, `caminho_foto2`, `caminho_foto3`, `descricao1`) VALUES
(1, 'Rack Logistica', 'Miguel Burnier', 'Logística', '/gagf/images/portal_gestao/Rack Logistica/rack_logistica.PNG', '/gagf/images/portal_gestao/Rack Logistica/rack_logistica2.PNG', '/gagf/images/portal_gestao/Rack Logistica/rack logistica_mapa.PNG', 'Equipamento instalado no rack da sala da logística e contem diversos equipamentos. O link externo da RGTECH entra por este painel'),
(2, 'Rede 192.168.10.XX', 'Miguel Burnier_UTMI', 'Logística', '/gagf/images/portal_gestao/Rack Logistica/rack_logistica.PNG', '/gagf/images/portal_gestao/Rack Logistica/rack_logistica2.PNG', '/gagf/images/portal_gestao/Rack Logistica/rack logistica_mapa.PNG', 'Rede utilizada na UTMI para equipamentos da logística'),
(3, 'Rede 192.168.20.XX', 'Miguel Burnier_UTMII', 'Logística', '/gagf/images/portal_gestao/Rack Logistica/rack_logistica.PNG', '/gagf/images/portal_gestao/Rack Logistica/rack_logistica2.PNG', '/gagf/images/portal_gestao/Rack Logistica/rack logistica_mapa.PNG', 'Rede utilizada na UTMII para equipamentos da logística. Alguns pontos\r\n</BR>* Rede Patrag\r\n</BR>* Rede Torre Radios\r\n</BR>* Rede Bocâina');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_tipo`
--

CREATE TABLE `tabela_tipo` (
  `id` int NOT NULL,
  `tipo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tabela_tipo`
--

INSERT INTO `tabela_tipo` (`id`, `tipo`) VALUES
(1, 'ATA'),
(2, 'Câmera'),
(3, 'CIP'),
(4, 'Display TCP/IP'),
(5, 'Groove'),
(6, 'Modem'),
(7, 'N/A'),
(8, 'Não definido'),
(9, 'NVR'),
(10, 'PC'),
(11, 'PTZ'),
(12, 'Raspberry/TV'),
(13, 'Reader'),
(14, 'Rede'),
(15, 'Rádio'),
(16, 'ROCK PI'),
(17, 'SVA'),
(18, 'Switch Gerenciavel'),
(19, 'SXT'),
(20, 'Tablet'),
(21, 'TIP');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `rede_dez_xx`
--
ALTER TABLE `rede_dez_xx`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `rede_quarenta_xx`
--
ALTER TABLE `rede_quarenta_xx`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `rede_trinta_xx`
--
ALTER TABLE `rede_trinta_xx`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `rede_vinte_xx`
--
ALTER TABLE `rede_vinte_xx`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tabela_equipamentos`
--
ALTER TABLE `tabela_equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tabela_modelo`
--
ALTER TABLE `tabela_modelo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tabela_referencia`
--
ALTER TABLE `tabela_referencia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tabela_tipo`
--
ALTER TABLE `tabela_tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rede_dez_xx`
--
ALTER TABLE `rede_dez_xx`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT de tabela `rede_quarenta_xx`
--
ALTER TABLE `rede_quarenta_xx`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rede_trinta_xx`
--
ALTER TABLE `rede_trinta_xx`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `rede_vinte_xx`
--
ALTER TABLE `rede_vinte_xx`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tabela_equipamentos`
--
ALTER TABLE `tabela_equipamentos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tabela_modelo`
--
ALTER TABLE `tabela_modelo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tabela_referencia`
--
ALTER TABLE `tabela_referencia`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tabela_tipo`
--
ALTER TABLE `tabela_tipo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
