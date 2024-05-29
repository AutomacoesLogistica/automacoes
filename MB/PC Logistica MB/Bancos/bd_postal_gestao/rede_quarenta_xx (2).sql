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
-- Estrutura para tabela `rede_quarenta_xx`
--

CREATE TABLE `rede_quarenta_xx` (
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
-- Despejando dados para a tabela `rede_quarenta_xx`
--

INSERT INTO `rede_quarenta_xx` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(1, 'RB2011 Balanca', '192.168.40.01', '192.168.40.1', '255.255.255.0', 'RB2011', 'RB2011', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(2, 'NVR Balanca 1', '192.168.40.02', '192.168.40.1', '255.255.255.0', 'MHDX1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(3, 'Câmera Balanca Saida/ETE    - Rota OK', '192.168.40.03', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(4, 'Câmera Carregamento Patio 2  - Rota OK', '192.168.40.04', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(5, 'Câmera Báscula Balanca - Rota OK', '192.168.40.05', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(6, 'Câmera Carregamento Patio 1 - Rota OK', '192.168.40.06', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(7, 'Câmera Entrada Balanca - Rota OK', '192.168.40.07', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(8, 'IP disponivel para utlização', '192.168.40.08', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(9, 'IP disponivel para utlização', '192.168.40.09', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(10, 'IP disponivel para utlização', '192.168.40.10', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(11, 'Câmera Placa Balanca - Rota OK', '192.168.40.11', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(12, 'IP disponivel para utlização', '192.168.40.12', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(13, 'IP disponivel para utlização', '192.168.40.13', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(14, 'Mikrotik VLN_Balanca/Saida', '192.168.40.14', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'Patch PoE2/Lan4 cc-057   Porta 12 TPLINK 16  ptp_Balanca/Saida', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(15, 'MikroTik VLN_Saida/Balanca - No poste', '192.168.40.15', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca/Saida', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(16, 'Reader Saida VLN', '192.168.40.16', '192.168.40.1', '255.255.255.0', 'ALR-F800', 'Reader', 'KA19004813', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(17, 'RB750 Saida Cancelas', '192.168.40.17', '192.168.40.1', '255.255.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(18, 'Camera Bascula Saida Esquerda - Rota OK', '192.168.40.18', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(19, 'Camera Visao Rua - Rota OK', '192.168.40.19', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(20, 'Camera Rua Saida visao sentido parceiros - Rota OK', '192.168.40.20', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(21, 'Camera Bascula Saida Direita - Rota OK', '192.168.40.21', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(22, 'Camera Visao Posto/Carregamento - Rota OK', '192.168.40.22', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(23, 'Camera visao Carretamento/Saida - Rota OK', '192.168.40.23', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(24, 'Câmera Placa Saida Esquerda', '192.168.40.24', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(25, 'Camera Placa Saida Direita', '192.168.40.25', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(26, 'IP disponivel para utlização', '192.168.40.26', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(27, 'PTP Para poste        VLN_SXT_Balanca_Poste', '192.168.40.27', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'Patch PoE3/Lan3 cc-060', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(28, 'VLN_SXT_PosteVLN/Balanca', '192.168.40.28', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(29, 'VLN_SXT_Poste/CA', '192.168.40.29', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(30, 'IP disponivel para utlização', '192.168.40.30', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(31, 'NVR VLN - K-house', '192.168.40.31', '192.168.40.32', '255.255.255.0', 'MHDX1116', 'NVR', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'log123@@', 'Não', 'BRUNO GONCALVES', '09/06/2023', '08:23:24'),
(32, 'VLN_RB750_K-House', '192.168.40.32', '192.168.40.250', '255.255.255.0', 'RB750', 'Switch Gerenciavel', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '09/06/2023', '08:23:24'),
(33, 'CIP850 VLN', '192.168.40.33', '192.168.40.1', '255.255.255.0', 'CIP850', 'CIP', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(34, 'TIP 425 Balanca', '192.168.40.34', '192.168.40.1', '255.255.255.0', 'TIP', 'TIP', 'logistica2020@', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(35, 'IP disponivel para utlização', '192.168.40.35', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(36, 'Reader Entrada VLN', '192.168.40.36', '192.168.40.1', '255.255.255.0', 'ALR-F800', 'Reader', 'Ainda não instalado!', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(37, 'IP disponivel para utlização', '192.168.40.37', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(38, 'IP disponivel para utlização', '192.168.40.38', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(39, 'IP disponivel para utlização', '192.168.40.39', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(40, 'VLN_ptp_Balanca_para_TorreIluminacao', '192.168.40.40', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_TorreIluminacao', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(41, 'VLN_ptp_TorreIluminacao_para_Balanca', '192.168.40.41', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_TorreIluminacao', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(42, 'VLN_RB750_TorreIluminacao', '192.168.40.42', '192.168.40.1', '255.255.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(43, 'CameraVisaoFilas', '192.168.40.43', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(44, 'CameraVisaoEstoque', '192.168.40.44', '192.168.40.1', '255.255.255.0', 'VIP1020B', 'Câmera', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(45, 'IP disponivel para utlização', '192.168.40.45', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(46, 'IP disponivel para utlização', '192.168.40.46', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(47, 'IP disponivel para utlização', '192.168.40.47', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(48, 'Raspberry K-House Keep Traking', '192.168.40.48', '192.168.40.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(49, 'VLN_GAGF_K-HouseVL', '192.168.40.49', '192.168.40.250', '255.255.255.0', 'A52-Hpn', 'Groove', 'Rede wifi : 192.168.45.1\nWIFI: WIFI_VLN Senha wifi: logistica_vln', 'Sim', 'Online', 'admin', 'logistica2019@@', 'Não', 'BRUNO GONCALVES', '09/06/2023', '08:23:24'),
(50, 'Cria Rede Escritorio para Balanca', '192.168.40.50', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(51, 'ESTA COM BALANCA/Ecritorio mais ta travado ', '192.168.40.51', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'Patch PoE1/Lan1 cc-056 Porta 10 TPLINK 16', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(52, 'NVR Mesa Paloma', '192.168.40.52', '192.168.40.1', '255.255.255.0', 'MHDX1004', 'NVR', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(53, 'VLN_ptp_Balanca_para_EscritorioAntigo', '192.168.40.53', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', '(Cria rede) ptp_Balanca_para_EscritorioAntigo', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(54, 'IP disponivel para utlização', '192.168.40.54', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(55, 'IP disponivel para utlização', '192.168.40.55', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(56, 'IP disponivel para utlização', '192.168.40.56', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(57, 'IP disponivel para utlização', '192.168.40.57', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(58, 'IP disponivel para utlização', '192.168.40.58', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(59, 'NVR Carga Balanca', '192.168.40.59', '192.168.40.1', '255.255.255.0', 'MHDX1004', 'NVR', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(60, 'VLN_ptp_Balanca_para_CA', '192.168.40.60', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_CA logistica2019@', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(61, 'VLN_ptp_CA_para_Balanca', '192.168.40.61', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_CA logistica2019@', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(62, 'VLN_ptp_Balanca_para_Cancelas1(_Do_Meio_)', '192.168.40.62', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_Cancelas1', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(63, 'VLN_ptp_Cancelas1_para_Balanca(_Do_Alto_)', '192.168.40.63', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_Cancelas1', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(64, 'VLN_ptp_Balanca_para_Cancelas2(_Mais_Alto_)', '192.168.40.64', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_Cancelas2', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(65, 'VLN_ptp_Cancelas2_para_Balanca(_Do_Painel_)', '192.168.40.65', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_Cancelas2', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(66, 'VLN_ptp_Balanca_para_SalaBranca', '192.168.40.66', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', '( Cria ) ptp_Balanca_para_SalaBranca', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(67, 'VLN_ptp_SalaBranca_para_Balanca', '192.168.40.67', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'ptp_Balanca_para_SalaBranca', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(68, 'IP disponivel para utlização', '192.168.40.68', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(69, 'GAGF Balanca VLN', '192.168.40.69', '192.168.40.1', '255.255.255.0', 'A52-Hpn', 'Groove', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(70, 'VLN_RB750_ControleAcesso', '192.168.40.70', '192.168.40.1', '255.255.255.0', 'RB750', 'RB750', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(71, 'Raspberry CA Lado Esquerdo', '192.168.40.71', '192.168.40.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(72, 'Raspberry CA Lado Direito', '192.168.40.72', '192.168.40.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(73, 'Reader CA Lado Esquerdo', '192.168.40.73', '192.168.40.1', '255.255.255.0', 'ALR-F800', 'Reader', 'KA19004812', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(74, 'Reader CA Lado Direito', '192.168.40.74', '192.168.40.1', '255.255.255.0', 'ALR-F800', 'Reader', 'KA19004799', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(75, 'ATA LD Ramal 404', '192.168.40.75', '192.168.40.1', '255.255.255.0', 'ATA200', 'ATA', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(76, 'ATA LE Ramal 403', '192.168.40.76', '192.168.40.1', '255.255.255.0', 'ATA200', 'ATA', 'logistica2020@@', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(77, 'IP disponivel para utlização', '192.168.40.77', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(78, 'IP disponivel para utlização', '192.168.40.78', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(79, 'IP disponivel para utlização', '192.168.40.79', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(80, 'VLN_ptp_K-House_para_VLN', '192.168.40.80', '192.168.40.1', '255.255.255.0', 'SXT5', 'SXT', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '09/06/2023', '08:23:24'),
(81, 'IP disponivel para utlização', '192.168.40.81', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(82, 'IP disponivel para utlização', '192.168.40.82', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(83, 'IP disponivel para utlização', '192.168.40.83', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(84, 'IP disponivel para utlização', '192.168.40.84', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(85, 'IP disponivel para utlização', '192.168.40.85', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(86, 'IP disponivel para utlização', '192.168.40.86', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(87, 'IP disponivel para utlização', '192.168.40.87', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(88, 'IP disponivel para utlização', '192.168.40.88', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(89, 'IP disponivel para utlização', '192.168.40.89', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(90, 'IP disponivel para utlização', '192.168.40.90', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(91, 'IP disponivel para utlização', '192.168.40.91', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(92, 'IP disponivel para utlização', '192.168.40.92', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(93, 'IP disponivel para utlização', '192.168.40.93', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(94, 'IP disponivel para utlização', '192.168.40.94', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(95, 'IP disponivel para utlização', '192.168.40.95', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(96, 'IP disponivel para utlização', '192.168.40.96', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(97, 'IP disponivel para utlização', '192.168.40.97', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(98, 'IP disponivel para utlização', '192.168.40.98', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(99, 'IP disponivel para utlização', '192.168.40.99', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(100, 'IP disponivel para utlização', '192.168.40.100', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(101, 'IP disponivel para utlização', '192.168.40.101', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(102, 'IP disponivel para utlização', '192.168.40.102', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(103, 'IP disponivel para utlização', '192.168.40.103', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(104, 'IP disponivel para utlização', '192.168.40.104', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(105, 'IP disponivel para utlização', '192.168.40.105', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(106, 'IP disponivel para utlização', '192.168.40.106', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(107, 'RaspberryPortal', '192.168.40.107', '192.168.40.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(108, 'BaseBox_ptp_VLN_para_VL', '192.168.40.108', '192.168.40.1', '255.255.255.0', 'Base Box', 'Base Box', 'Patch PoE4/Lan4 cc-062 Porta 8 TPLINK 16', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(109, 'IP disponivel para utlização', '192.168.40.109', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(110, 'IP disponivel para utlização', '192.168.40.110', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(111, 'IP disponivel para utlização', '192.168.40.111', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(112, 'IP disponivel para utlização', '192.168.40.112', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(113, 'IP disponivel para utlização', '192.168.40.113', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(114, 'IP disponivel para utlização', '192.168.40.114', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(115, 'IP disponivel para utlização', '192.168.40.115', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(116, 'IP disponivel para utlização', '192.168.40.116', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(117, 'IP disponivel para utlização', '192.168.40.117', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(118, 'IP disponivel para utlização', '192.168.40.118', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(119, 'IP disponivel para utlização', '192.168.40.119', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(120, 'IP disponivel para utlização', '192.168.40.120', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(121, 'IP disponivel para utlização', '192.168.40.121', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(122, 'IP disponivel para utlização', '192.168.40.122', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(123, 'IP disponivel para utlização', '192.168.40.123', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(124, 'IP disponivel para utlização', '192.168.40.124', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(125, 'IP disponivel para utlização', '192.168.40.125', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(126, 'IP disponivel para utlização', '192.168.40.126', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(127, 'IP disponivel para utlização', '192.168.40.127', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(128, 'IP disponivel para utlização', '192.168.40.128', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(129, 'IP disponivel para utlização', '192.168.40.129', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(130, 'IP disponivel para utlização', '192.168.40.130', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(131, 'IP disponivel para utlização', '192.168.40.131', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(132, 'IP disponivel para utlização', '192.168.40.132', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(133, 'IP disponivel para utlização', '192.168.40.133', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(134, 'IP disponivel para utlização', '192.168.40.134', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(135, 'IP disponivel para utlização', '192.168.40.135', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(136, 'IP disponivel para utlização', '192.168.40.136', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(137, 'IP disponivel para utlização', '192.168.40.137', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(138, 'IP disponivel para utlização', '192.168.40.138', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(139, 'IP disponivel para utlização', '192.168.40.139', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(140, 'IP disponivel para utlização', '192.168.40.140', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(141, 'IP disponivel para utlização', '192.168.40.141', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(142, 'IP disponivel para utlização', '192.168.40.142', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(143, 'IP disponivel para utlização', '192.168.40.143', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(144, 'IP disponivel para utlização', '192.168.40.144', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(145, 'IP disponivel para utlização', '192.168.40.145', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(146, 'IP disponivel para utlização', '192.168.40.146', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(147, 'IP disponivel para utlização', '192.168.40.147', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(148, 'IP disponivel para utlização', '192.168.40.148', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(149, 'IP disponivel para utlização', '192.168.40.149', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(150, 'IP disponivel para utlização', '192.168.40.150', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(151, 'IP disponivel para utlização', '192.168.40.151', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(152, 'IP disponivel para utlização', '192.168.40.152', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(153, 'IP disponivel para utlização', '192.168.40.153', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(154, 'IP disponivel para utlização', '192.168.40.154', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(155, 'IP disponivel para utlização', '192.168.40.155', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(156, 'IP disponivel para utlização', '192.168.40.156', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(157, 'IP disponivel para utlização', '192.168.40.157', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(158, 'IP disponivel para utlização', '192.168.40.158', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(159, 'IP disponivel para utlização', '192.168.40.159', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(160, 'IP disponivel para utlização', '192.168.40.160', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(161, 'IP disponivel para utlização', '192.168.40.161', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(162, 'IP disponivel para utlização', '192.168.40.162', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(163, 'IP disponivel para utlização', '192.168.40.163', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(164, 'IP disponivel para utlização', '192.168.40.164', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(165, 'IP disponivel para utlização', '192.168.40.165', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(166, 'IP disponivel para utlização', '192.168.40.166', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(167, 'IP disponivel para utlização', '192.168.40.167', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(168, 'IP disponivel para utlização', '192.168.40.168', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(169, 'IP disponivel para utlização', '192.168.40.169', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(170, 'IP disponivel para utlização', '192.168.40.170', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(171, 'IP disponivel para utlização', '192.168.40.171', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(172, 'IP disponivel para utlização', '192.168.40.172', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(173, 'IP disponivel para utlização', '192.168.40.173', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(174, 'IP disponivel para utlização', '192.168.40.174', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(175, 'IP disponivel para utlização', '192.168.40.175', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(176, 'IP disponivel para utlização', '192.168.40.176', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(177, 'IP disponivel para utlização', '192.168.40.177', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(178, 'IP disponivel para utlização', '192.168.40.178', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(179, 'IP disponivel para utlização', '192.168.40.179', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(180, 'IP disponivel para utlização', '192.168.40.180', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(181, 'IP disponivel para utlização', '192.168.40.181', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(182, 'IP disponivel para utlização', '192.168.40.182', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(183, 'IP disponivel para utlização', '192.168.40.183', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(184, 'IP disponivel para utlização', '192.168.40.184', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(185, 'IP disponivel para utlização', '192.168.40.185', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(186, 'IP disponivel para utlização', '192.168.40.186', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(187, 'IP disponivel para utlização', '192.168.40.187', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(188, 'IP disponivel para utlização', '192.168.40.188', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(189, 'IP disponivel para utlização', '192.168.40.189', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(190, 'IP disponivel para utlização', '192.168.40.190', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(191, 'IP disponivel para utlização', '192.168.40.191', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(192, 'IP disponivel para utlização', '192.168.40.192', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(193, 'IP disponivel para utlização', '192.168.40.193', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(194, 'IP disponivel para utlização', '192.168.40.194', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(195, 'IP disponivel para utlização', '192.168.40.195', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(196, 'IP disponivel para utlização', '192.168.40.196', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(197, 'IP disponivel para utlização', '192.168.40.197', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(198, 'IP disponivel para utlização', '192.168.40.198', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(199, 'IP disponivel para utlização', '192.168.40.199', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(200, 'IP disponivel para utlização', '192.168.40.200', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(201, 'IP disponivel para utlização', '192.168.40.201', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(202, 'IP disponivel para utlização', '192.168.40.202', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(203, 'IP disponivel para utlização', '192.168.40.203', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(204, 'IP disponivel para utlização', '192.168.40.204', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(205, 'IP disponivel para utlização', '192.168.40.205', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(206, 'IP disponivel para utlização', '192.168.40.206', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(207, 'IP disponivel para utlização', '192.168.40.207', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(208, 'IP disponivel para utlização', '192.168.40.208', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(209, 'IP disponivel para utlização', '192.168.40.209', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(210, 'PC 3 Logistica', '192.168.40.210', '192.168.40.1', '255.255.255.0', 'PC', 'PC', 'Sem dados complementares', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(211, 'IP disponivel para utlização', '192.168.40.211', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(212, 'IP disponivel para utlização', '192.168.40.212', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(213, 'IP disponivel para utlização', '192.168.40.213', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(214, 'IP disponivel para utlização', '192.168.40.214', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(215, 'IP disponivel para utlização', '192.168.40.215', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(216, 'IP disponivel para utlização', '192.168.40.216', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(217, 'IP disponivel para utlização', '192.168.40.217', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(218, 'IP disponivel para utlização', '192.168.40.218', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(219, 'IP disponivel para utlização', '192.168.40.219', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(220, 'IP disponivel para utlização', '192.168.40.220', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(221, 'IP disponivel para utlização', '192.168.40.221', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(222, 'IP disponivel para utlização', '192.168.40.222', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(223, 'IP disponivel para utlização', '192.168.40.223', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(224, 'IP disponivel para utlização', '192.168.40.224', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(225, 'IP disponivel para utlização', '192.168.40.225', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(226, 'IP disponivel para utlização', '192.168.40.226', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00');
INSERT INTO `rede_quarenta_xx` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(227, 'IP disponivel para utlização', '192.168.40.227', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(228, 'IP disponivel para utlização', '192.168.40.228', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(229, 'IP disponivel para utlização', '192.168.40.229', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(230, 'IP disponivel para utlização', '192.168.40.230', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(231, 'IP disponivel para utlização', '192.168.40.231', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(232, 'IP disponivel para utlização', '192.168.40.232', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(233, 'IP disponivel para utlização', '192.168.40.233', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(234, 'IP disponivel para utlização', '192.168.40.234', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(235, 'IP disponivel para utlização', '192.168.40.235', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(236, 'IP disponivel para utlização', '192.168.40.236', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(237, 'IP disponivel para utlização', '192.168.40.237', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(238, 'IP disponivel para utlização', '192.168.40.238', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(239, 'IP disponivel para utlização', '192.168.40.239', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(240, 'IP disponivel para utlização', '192.168.40.240', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(241, 'IP disponivel para utlização', '192.168.40.241', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(242, 'IP disponivel para utlização', '192.168.40.242', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(243, 'IP disponivel para utlização', '192.168.40.243', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(244, 'IP disponivel para utlização', '192.168.40.244', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(245, 'IP disponivel para utlização', '192.168.40.245', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(246, 'IP disponivel para utlização', '192.168.40.246', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(247, 'IP disponivel para utlização', '192.168.40.247', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(248, 'IP disponivel para utlização', '192.168.40.248', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(249, 'IP disponivel para utlização', '192.168.40.249', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(250, 'VLN_RB2011_K-House', '192.168.40.250', '192.168.40.1', '255.255.255.0', 'RB2011', 'RB2011', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(251, 'Raspberry Automações cancelas de saida', '192.168.40.251', '192.168.40.1', '255.255.255.0', 'PI3 B+', 'Raspberry/TV', 'Sem dados complementares', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(252, 'IP disponivel para utlização', '192.168.40.252', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(253, 'IP disponivel para utlização', '192.168.40.253', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(254, 'IP disponivel para utlização', '192.168.40.254', '192.168.40.1', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Bloqueado', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `rede_quarenta_xx`
--
ALTER TABLE `rede_quarenta_xx`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `rede_quarenta_xx`
--
ALTER TABLE `rede_quarenta_xx`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
