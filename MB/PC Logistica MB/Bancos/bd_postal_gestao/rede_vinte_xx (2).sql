-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 13/06/2023 às 14:18
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
-- Estrutura para tabela `rede_vinte_xx`
--

CREATE TABLE `rede_vinte_xx` (
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
-- Despejando dados para a tabela `rede_vinte_xx`
--

INSERT INTO `rede_vinte_xx` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(1, 'RB2011 CCL', '192.168.20.01', '192.168.20.1', '255.2555.255.0', 'RB2011', 'RB2011', '3000/8291', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(2, 'IP disponivel para utlização', '192.168.20.02', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(3, 'UTMII_ptp_CCL/PosteCCL', '192.168.20.03', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(4, 'UTMII_ptp_PosteCCL/CCL', '192.168.20.04', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(5, 'IP disponivel para utlização', '192.168.20.05', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(6, 'IP disponivel para utlização', '192.168.20.06', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(7, 'UTMII_GAGF_PatioCCL', '192.168.20.07', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(8, 'UTMII_ptp_PosteCCL/ROM', '192.168.20.08', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(9, 'IP disponivel para utlização', '192.168.20.09', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(10, 'IP disponivel para utlização', '192.168.20.10', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(11, 'IP disponivel para utlização', '192.168.20.11', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(12, 'IP disponivel para utlização', '192.168.20.12', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(13, 'PATRAG_ptp_Patrag_para_Torre1', '192.168.20.13', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_Patrag_para_Torre1 ptp Bridge', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(14, 'PATRAG_PN_para_Patrag', '192.168.20.14', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(15, 'IP disponivel para utlização', '192.168.20.15', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(16, 'IP disponivel para utlização', '192.168.20.16', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(17, 'IP disponivel para utlização', '192.168.20.17', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(18, 'ATA200 Balanca 3 ( ramal 208 ) logistica2020@@', '192.168.20.18', '192.168.20.1', '255.2555.255.0', 'ATA200', 'ATA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(19, 'IP disponivel para utlização', '192.168.20.19', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(20, 'UTMII_GAGF_CCL', '192.168.20.20', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(21, 'Raspberry CCL - Portal ', '192.168.20.21', '192.168.20.1', '255.2555.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(22, 'IP disponivel para utlização', '192.168.20.22', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(23, 'Raspberry/TV VA Pessoas', '192.168.20.23', '192.168.20.1', '255.2555.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(24, 'IP disponivel para utlização', '192.168.20.24', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(25, 'IP disponivel para utlização', '192.168.20.25', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(26, 'IP disponivel para utlização', '192.168.20.26', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(27, 'TIP425 CCL UTMII 1', '192.168.20.27', '192.168.20.1', '255.2555.255.0', 'TIP', 'TIP', 'SIP: logistica2020@@', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(28, 'CIP850 CCL', '192.168.20.28', '192.168.20.1', '255.2555.255.0', 'CIP850', 'CIP', 'SIP: logistica2020@@', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(29, 'IP disponivel para utlização', '192.168.20.29', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(30, 'IP disponivel para utlização', '192.168.20.30', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(31, 'PATRAG_Patrag_para_Torre2', '192.168.20.31', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'PATRAG_Patrag_para_Torre2 AP', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(32, 'UTMII_ptp_Bal3/Novo_ROM', '192.168.20.32', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_Bal3/Novo_ROM  ptp Brige', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(33, 'IP disponivel para utlização', '192.168.20.33', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(34, 'IP disponivel para utlização', '192.168.20.34', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(35, 'IP disponivel para utlização', '192.168.20.35', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(36, 'IP disponivel para utlização', '192.168.20.36', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(37, 'Câmera Balanca 3 - Visao ccl', '192.168.20.37', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(38, 'RB750 Balanca3', '192.168.20.38', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(39, 'UTMII_ptp_Bal3/CCL', '192.168.20.39', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_CCL/Bal3  CPE', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(40, 'UTMII_ptp_CCL/Bal3', '192.168.20.40', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_CCL/Bal3  ptp Bridge', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(41, 'IP disponivel para utlização', '192.168.20.41', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(42, 'Raspberry TV Novo ROM', '192.168.20.42', '192.168.20.1', '255.2555.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(43, 'IP disponivel para utlização', '192.168.20.43', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(44, 'IP disponivel para utlização', '192.168.20.44', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(45, 'UTMII_ptp_CCL_para_TorreRadio', '192.168.20.45', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_CCL/TorreRadio', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(46, 'UTMII_ptp_TorreRadio_CCL', '192.168.20.46', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_CCL/TorreRadio', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(47, 'UTMII_ptp_TorreRadio_Patrag', '192.168.20.47', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_TorreRadio/Patrag    5300', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(48, 'UTMII_ptp_Patrag_TorreRadio - Vai SAIR', '192.168.20.48', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_TorreRadio/Patrag  5300', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(49, 'Reader Patrag', '192.168.20.49', '192.168.20.1', '255.2555.255.0', 'ALR-F800', 'Reader', 'CA = CA16002931', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(50, 'CAM Entrada - Visão Entrada Balança', '192.168.20.50', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', '8050 / 37050 / 554', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(51, 'CAM Entrada - Visão Saida Balança', '192.168.20.51', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', '8051 / 37051 / 554', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(52, 'CAM Saida - Visão Entrada Balança', '192.168.20.52', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', '8052 / 37052 / 554', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(53, 'CAM Saida - Visão Saida Balança', '192.168.20.53', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', '8053 / 37053 / 554', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(54, 'RB750 Patrag Painel Reader', '192.168.20.54', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(55, 'NVR Patrag 1', '192.168.20.55', '192.168.20.1', '255.2555.255.0', 'MHDX1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(56, 'Raspberry TV Entrada Patrag', '192.168.20.56', '192.168.20.1', '255.2555.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(57, 'ATA 200 Entrada Patrag', '192.168.20.57', '192.168.20.1', '255.2555.255.0', 'ATA200', 'ATA', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(58, 'ATA 200 Saida Patrag', '192.168.20.58', '192.168.20.1', '255.2555.255.0', 'ATA200', 'ATA', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(59, 'IP disponivel para utlização', '192.168.20.59', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(60, 'IP disponivel para utlização', '192.168.20.60', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(61, 'IP disponivel para utlização', '192.168.20.61', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(62, 'IP disponivel para utlização', '192.168.20.62', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(63, 'IP disponivel para utlização', '192.168.20.63', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(64, 'IP disponivel para utlização', '192.168.20.64', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(65, 'IP disponivel para utlização', '192.168.20.65', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(66, 'IP disponivel para utlização', '192.168.20.66', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(67, 'TIP425 Patrag', '192.168.20.67', '192.168.20.1', '255.2555.255.0', 'TIP', 'TIP', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(68, 'IP disponivel para utlização', '192.168.20.68', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(69, 'IP disponivel para utlização', '192.168.20.69', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(70, 'UTMII_RB750_TorreRadio', '192.168.20.70', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(71, 'UTMII_ptp_TorreRadio_para_CancelasUTMII', '192.168.20.71', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(72, 'UTMII_ptp_CancelasUTMII_para_TorreRadio', '192.168.20.72', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(73, 'Câmera Visão estrada cancelas atual UTMII', '192.168.20.73', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(74, 'IP disponivel para utlização', '192.168.20.74', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(75, 'IP disponivel para utlização', '192.168.20.75', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(76, 'IP disponivel para utlização', '192.168.20.76', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(77, 'IP disponivel para utlização', '192.168.20.77', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(78, 'IP disponivel para utlização', '192.168.20.78', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(79, 'IP disponivel para utlização', '192.168.20.79', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(80, 'IP disponivel para utlização', '192.168.20.80', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(81, 'Camera Visao Sala Patrag', '192.168.20.81', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Roteamento externo: rtsp://admin:logistica2019@@@138.0.77.80:5033/cam/realmonitor?channel=1&subtype=0', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(82, 'IP disponivel para utlização', '192.168.20.82', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(83, 'IP disponivel para utlização', '192.168.20.83', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(84, 'IP disponivel para utlização', '192.168.20.84', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(85, 'IP disponivel para utlização', '192.168.20.85', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(86, 'IP disponivel para utlização', '192.168.20.86', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(87, 'UTMII_ptp_Patrag_PosteVA', '192.168.20.87', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(88, 'UTMII_ptpPosteVA_Patrag', '192.168.20.88', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(89, 'UTMII_ptp_PosteBalancaEntrada_para_EstradaAcesso', '192.168.20.89', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(90, 'UTMII_ptp_EstradaAcesso_para_PosteBalancaEntrada', '192.168.20.90', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(91, 'UTMII_RB750_PosteVA', '192.168.20.91', '192.168.20.1', '255.2555.255.0', 'RB750', '', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(92, 'IP disponivel para utlização', '192.168.20.92', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(93, 'IP disponivel para utlização', '192.168.20.93', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(94, 'Camera_Báscula_Entrada', '192.168.20.94', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(95, 'Camera_Báscula_Saida', '192.168.20.95', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(96, 'IP disponivel para utlização', '192.168.20.96', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(97, 'UTMII_RB750_EstradaAcesso', '192.168.20.97', '192.168.20.1', '255.2555.255.0', 'RB750', '', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(98, 'UTMII_GAGF_EstradaAcesso', '192.168.20.98', '192.168.20.1', '255.2555.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(99, 'Camera_EstradaAcessoPatrag_Visao1', '192.168.20.99', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(100, 'Camera_EstradaAcessoPatrag_Visao2', '192.168.20.100', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(101, 'Raspberry TV Automacoes Entrada Acesso Semaforos_Patrag', '192.168.20.101', '192.168.20.1', '255.2555.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(102, 'ATA EstradaAcessoPatrag_GERDAU', '192.168.20.102', '192.168.20.1', '255.2555.255.0', 'ATA200', 'ATA', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(103, 'ATA EstradaAcessoPatrag_VALE', '192.168.20.103', '192.168.20.1', '255.2555.255.0', 'ATA200', 'ATA', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(104, 'Camera placa Balanca Entrada Patrag', '192.168.20.104', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(105, 'Camera placa Balanca Saida Patrag', '192.168.20.105', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(106, 'NVR Balança 03', '192.168.20.106', '192.168.20.1', '255.2555.255.0', 'MHDX1004', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(107, 'Câmera Bascula Balanca 03', '192.168.20.107', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(108, 'NVR Patrag 2', '192.168.20.108', '192.168.20.1', '255.2555.255.0', 'MHDX1004', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(109, 'IP disponivel para utlização', '192.168.20.109', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(110, 'IP disponivel para utlização', '192.168.20.110', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(111, 'IP disponivel para utlização', '192.168.20.111', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(112, 'IP disponivel para utlização', '192.168.20.112', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(113, 'IP disponivel para utlização', '192.168.20.113', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(114, 'IP disponivel para utlização', '192.168.20.114', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(115, 'IP disponivel para utlização', '192.168.20.115', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(116, 'IP disponivel para utlização', '192.168.20.116', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(117, 'Computador SVA Automações PATRAG', '192.168.20.117', '192.168.20.1', '255.2555.255.0', 'PC', 'SVA', 'http://138.0.77.80:5010/api/v1/index.html\n', 'Sim', 'Online', 'admin', '123456789012345', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(118, 'IP disponivel para utlização', '192.168.20.118', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(119, 'IP disponivel para utlização', '192.168.20.119', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(120, 'IP disponivel para utlização', '192.168.20.120', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(121, 'IP disponivel para utlização', '192.168.20.121', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(122, 'IP disponivel para utlização', '192.168.20.122', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(123, 'IP disponivel para utlização', '192.168.20.123', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(124, 'Câmera PTZ patio patrag', '192.168.20.124', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'PTZ', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '31/05/2023', '09:00:44'),
(125, 'PATRAG_ptp_Patrag_Torre', '192.168.20.125', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(126, 'PATRAG_ptp_Torre_Patrag', '192.168.20.126', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(127, 'Câmera Visão 1 Patio Patrag (Central)', '192.168.20.127', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(128, 'Câmera Visão 2 Patio Patrag (direita vale)', '192.168.20.128', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(129, 'Câmera Visão 3 Patio Patrag esquerda (entrada patrag)', '192.168.20.129', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(130, 'Groove Torre Patio Patrag', '192.168.20.130', '192.168.20.1', '255.2555.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(131, 'PATRAG_GrooveManutencao', '192.168.20.131', '192.168.20.1', '255.2555.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(132, 'RB750_Poste_LinkPatrag', '192.168.20.132', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(133, 'TABLET Patrag Equipe Logistica', '192.168.20.133', '192.168.20.1', '255.2555.255.0', 'Tablet', 'Tablet', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(134, 'Tablet Patrag Provisorio Cameras Patriomonial(SalaBranca)', '192.168.20.134', '192.168.20.1', '255.2555.255.0', 'Tablet', 'Tablet', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(135, 'Tablet Patrag Provisorio cameras Thais', '192.168.20.135', '192.168.20.1', '255.2555.255.0', 'Tablet', 'Tablet', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(136, 'Placa GPIO PATRAG', '192.168.20.136', '192.168.20.1', '255.2555.255.0', 'Modulo GPIO', 'SVA', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(137, 'IP disponivel para utlização', '192.168.20.137', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(138, 'IP disponivel para utlização', '192.168.20.138', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(139, 'NVR CCL - Ver numero (ROM)', '192.168.20.139', '192.168.20.1', '255.2555.255.0', 'MHXD1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(140, 'IP disponivel para utlização', '192.168.20.140', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(141, 'IP disponivel para utlização', '192.168.20.141', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(142, 'NVR CCL -  TV07', '192.168.20.142', '192.168.20.1', '255.2555.255.0', 'MHXD1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(143, 'NVR CCL -  TV', '192.168.20.143', '192.168.20.1', '255.2555.255.0', 'MHXD1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(144, 'PATRAG_RB750_PosteBalancaEntrada', '192.168.20.144', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(145, 'PATRAG_RB750_PosteBalancaSaida  - (Verificar em campo se pegou o IP )', '192.168.20.145', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(146, 'Camera visao acesso entrada patrag', '192.168.20.146', '192.168.20.1', '255.2555.255.0', 'VIP3240 IA', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(147, 'Camera visao Patio - poste entrada', '192.168.20.147', '192.168.20.1', '255.2555.255.0', 'VIP3240 IA', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(148, 'Visao Entrada do Patrag - Poste Balanca Saida', '192.168.20.148', '192.168.20.1', '255.2555.255.0', 'VIP3240 IA', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(149, 'Visao Patio - Poste Saida', '192.168.20.149', '192.168.20.1', '255.2555.255.0', 'VIP3240 IA', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(150, 'IP disponivel para utlização', '192.168.20.150', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(151, 'PATRAG_ptp_Patrag_para_BalVale', '192.168.20.151', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_Patrag_BalVale', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(152, 'IP disponivel para utlização', '192.168.20.152', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(153, 'IP disponivel para utlização', '192.168.20.153', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(154, 'IP disponivel para utlização', '192.168.20.154', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(155, 'IP disponivel para utlização', '192.168.20.155', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(156, 'UTMII_Hap_MesaCCL', '192.168.20.156', '192.168.20.1', '255.2555.255.0', 'Hap', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(157, 'IP disponivel para utlização', '192.168.20.157', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(158, 'IP disponivel para utlização', '192.168.20.158', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(159, 'IP disponivel para utlização', '192.168.20.159', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(160, 'IP disponivel para utlização', '192.168.20.160', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(161, 'IP disponivel para utlização', '192.168.20.161', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(162, 'IP disponivel para utlização', '192.168.20.162', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(163, 'PATRAG Camera PN', '192.168.20.163', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(164, 'IP disponivel para utlização', '192.168.20.164', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(165, 'IP disponivel para utlização', '192.168.20.165', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(166, 'PATRAG Camera PN Visao Patrag', '192.168.20.166', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(167, 'PATRAG_RB750_PainelPN', '192.168.20.167', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(168, 'IP disponivel para utlização', '192.168.20.168', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(169, 'IP disponivel para utlização', '192.168.20.169', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(170, 'IP disponivel para utlização', '192.168.20.170', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(171, 'IP disponivel para utlização', '192.168.20.171', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(172, 'IP disponivel para utlização', '192.168.20.172', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(173, 'IP disponivel para utlização', '192.168.20.173', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(174, 'Camera Visao Lavador de Bascula UTMII', '192.168.20.174', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(175, 'Câmera Patio CCL UMTII', '192.168.20.175', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(176, 'Câmera Abertura 1 e 2 UTMII CCL', '192.168.20.176', '192.168.20.1', '255.2555.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(177, 'IP disponivel para utlização', '192.168.20.177', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(178, 'IP disponivel para utlização', '192.168.20.178', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(179, 'IP disponivel para utlização', '192.168.20.179', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(180, 'IP disponivel para utlização', '192.168.20.180', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(181, 'IP disponivel para utlização', '192.168.20.181', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(182, 'IP disponivel para utlização', '192.168.20.182', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(183, 'IP disponivel para utlização', '192.168.20.183', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(184, 'PATRAG_RB2011_CCL', '192.168.20.184', '192.168.20.1', '255.2555.255.0', 'RB2011', 'RB2011', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(185, 'PATRAG_RB750_Automacoes', '192.168.20.185', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(186, 'PATRAG_RB750_CFTV', '192.168.20.186', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(187, 'PATRAG_CIP_850', '192.168.20.187', '192.168.20.1', '255.2555.255.0', 'CIP850', 'CIP', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(188, 'UTMII_RB750_TorreRadio2', '192.168.20.188', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(189, 'UTMII_RB750_TorreRadio', '192.168.20.189', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(190, 'UTMII_ptp_TorreRadio_para_PatioProdutoUTMII', '192.168.20.190', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_TorreRadio_para_PatioProduto', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(191, 'PATRAG_ptp_Patrag_para_PN', '192.168.20.191', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_Patrag_para_PN', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(192, 'PATRAG_CameraVisao_WG', '192.168.20.192', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(193, 'PATRAG_CameraVisaoAcessoSubida', '192.168.20.193', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(194, 'PATRAG_CameraVisaoEntrada', '192.168.20.194', '192.168.20.1', '255.2555.255.0', 'VIP1130B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(195, 'IP disponivel para utlização', '192.168.20.195', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(196, 'PATRAG_ptp_Patrag_para_TorreCancela', '192.168.20.196', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_Patrag_para_TorreCancela', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(197, 'UTMII_RB750_PatioProduto', '192.168.20.197', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(198, 'IP disponivel para utlização', '192.168.20.198', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(199, 'IP disponivel para utlização', '192.168.20.199', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(200, 'Meu notebook', '192.168.20.200', '192.168.20.1', '255.2555.255.0', 'Notebook', 'Notebook', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(201, 'Notebook Willian', '192.168.20.201', '192.168.20.1', '255.2555.255.0', 'Notebook', 'Notebook', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(202, 'IP disponivel para utlização', '192.168.20.202', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(203, 'IP disponivel para utlização', '192.168.20.203', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(204, 'UTMII_ptp_TorreRadio_para_P6', '192.168.20.204', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(205, 'UTMII_ptp_P6_para_TorreRadio', '192.168.20.205', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(206, 'UTMII_GAGF_Antenas', '192.168.20.206', '192.168.20.1', '255.2555.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(207, 'UTMII_ptp_Antenas_para_PosteBalanca1', '192.168.20.207', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'CPE - ptp_PostaBal_para_Antenas', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(208, 'UTMII_ptp_Antenas_para_NovoCCL', '192.168.20.208', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'CPE- ptp_NovoCCL_para_Antenas', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(209, 'UTMII_ptp_TorreRadios_para_Antenas', '192.168.20.209', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'AP- ptp_TorreRadios_para_Antenas', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(210, 'UTMII_ptp_Antenas_para_TorreRadio', '192.168.20.210', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'CPE - ptp_TorreRadios_para_Antenas', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(211, 'UTMII_ptp_NovoCCL_para_Antenas', '192.168.20.211', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'Ap- ptp_NovoCCL_para_Antenas', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(212, 'UTMII_RB750_Antenas', '192.168.20.212', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(213, 'IP disponivel para utlização', '192.168.20.213', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(214, 'UTMII_ptp_PosteBalanca1_para_Antenas', '192.168.20.214', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'AP - ptp_PostaBal_para_Antenas', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(215, 'UTMII_RB750_PosteBalanca1', '192.168.20.215', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(216, 'UTMII_RB2011_NovoCCL', '192.168.20.216', '192.168.20.1', '255.2555.255.0', 'RB2011', 'RB2011', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(217, 'NVR_VL_TV3', '192.168.20.217', '192.168.20.1', '255.2555.255.0', 'MHDX1116', 'NVR', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(218, 'VL_RB750_NovoCCL', '192.168.20.218', '192.168.20.1', '255.2555.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(219, 'PATRAG_ptp_TorreCancela_para_Patrag', '192.168.20.219', '192.168.20.1', '255.2555.255.0', 'SXT5', 'SXT', 'ptp_Patrag_para_TorreCancela', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(220, 'IP disponivel para utlização', '192.168.20.220', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(221, 'IP disponivel para utlização', '192.168.20.221', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(222, 'IP disponivel para utlização', '192.168.20.222', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(223, 'IP disponivel para utlização', '192.168.20.223', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(224, 'IP disponivel para utlização', '192.168.20.224', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(225, 'IP disponivel para utlização', '192.168.20.225', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(226, 'IP disponivel para utlização', '192.168.20.226', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(227, 'IP disponivel para utlização', '192.168.20.227', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(228, 'IP disponivel para utlização', '192.168.20.228', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(229, 'IP disponivel para utlização', '192.168.20.229', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00');
INSERT INTO `rede_vinte_xx` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(230, 'IP disponivel para utlização', '192.168.20.230', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(231, 'IP disponivel para utlização', '192.168.20.231', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(232, 'IP disponivel para utlização', '192.168.20.232', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(233, 'IP disponivel para utlização', '192.168.20.233', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(234, 'IP disponivel para utlização', '192.168.20.234', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(235, 'IP disponivel para utlização', '192.168.20.235', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(236, 'IP disponivel para utlização', '192.168.20.236', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(237, 'IP disponivel para utlização', '192.168.20.237', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(238, 'IP disponivel para utlização', '192.168.20.238', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(239, 'IP disponivel para utlização', '192.168.20.239', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(240, 'IP disponivel para utlização', '192.168.20.240', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(241, 'IP disponivel para utlização', '192.168.20.241', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(242, 'IP disponivel para utlização', '192.168.20.242', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(243, 'IP disponivel para utlização', '192.168.20.243', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(244, 'IP disponivel para utlização', '192.168.20.244', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(245, 'IP disponivel para utlização', '192.168.20.245', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(246, 'IP disponivel para utlização', '192.168.20.246', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(247, 'IP disponivel para utlização', '192.168.20.247', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(248, 'IP disponivel para utlização', '192.168.20.248', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(249, 'IP disponivel para utlização', '192.168.20.249', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(250, 'IP disponivel para utlização', '192.168.20.250', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(251, 'IP disponivel para utlização', '192.168.20.251', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(252, 'IP disponivel para utlização', '192.168.20.252', '-', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '30/05/2023', '11:37:41'),
(253, 'IP disponivel para utlização', '192.168.20.253', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00'),
(254, 'IP disponivel para utlização', '192.168.20.254', '192.168.20.1', '255.2555.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '11:23:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `rede_vinte_xx`
--
ALTER TABLE `rede_vinte_xx`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rede_vinte_xx`
--
ALTER TABLE `rede_vinte_xx`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
