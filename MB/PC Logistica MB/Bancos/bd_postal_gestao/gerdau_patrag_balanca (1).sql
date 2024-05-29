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
-- Estrutura para tabela `gerdau_patrag_balanca`
--

CREATE TABLE `gerdau_patrag_balanca` (
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
-- Despejando dados para a tabela `gerdau_patrag_balanca`
--

INSERT INTO `gerdau_patrag_balanca` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(1, 'PC Balanca entrada', '10.43.78.43', '10.50.4.15', '255.255.255.0', 'PC', 'PC', 'Hostname = EACO0113 IP antigo = 10.50.4.51', 'Sim', 'Online', 'admin', 'Gerdau10', 'Não', 'BRUNO GONCALVES', '05/06/2023', '10:10:16'),
(2, 'ADAM Balança de entrada', '10.43.78.45', '10.50.4.15', '255.255.255.0', 'ADAM GPIO', 'ADAM', 'IP antigo = 10.50.4.52\nDI0 = sensor de saida = sensor1 banco gerdau\nDI1 = sensor de entrada = sensor2 banco gerdau\nDO0 = Semáforo vermelho entrada / DO1 = Semáforo vermelho saída\nDO2 = Semáforo verde entrada / DO2 = Semáforo verde saída', 'Sim', 'Online', 'admin', '000000000', 'Não', 'BRUNO GONCALVES', '05/06/2023', '14:59:21'),
(3, 'Leitor RFID Balanca de entrada', '10.43.78.46', '10.50.4.15', '255.255.255.0', 'Honeywell IF1', 'Leitor RFID', 'IP antigo = 10.50.4.53\nHoneywell IF1 Balanca de Entrada', 'Sim', 'Online', 'admin', 'intermec', 'Não', 'BRUNO GONCALVES', '05/06/2023', '10:32:00'),
(4, 'Display Balança de entrada', '10.43.78.79', '10.50.4.15', '255.255.255.0', 'Display', 'Display TCP/IP', 'IP antigo = 10.50.4.54\nDisplay TCP/IP da Spyder', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(5, 'Impressora', '10.43.78.84', '10.50.4.15', '255.255.255.0', 'Impressora', 'Impressora', 'IP antigo = 10.50.4.108', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(6, 'PC Balança saída', '10.43.78.85', '10.50.4.15', '255.255.255.0', 'PC', 'PC', 'Hostname = EACO0258\nIP antigo = 10.50.4.55', 'Sim', 'Online', 'admin', 'Gerdau10', 'Não', 'BRUNO GONCALVES', '05/06/2023', '10:32:00'),
(7, 'ADAM Balança saída', '10.43.78.86', '10.50.4.15', '255.255.255.0', 'ADAM GPIO', 'ADAM', 'IP antigo = 10.50.4.56\nDI0 = sensor de saida = sensor1 banco gerdau\nDI1 = sensor de entrada = sensor2 banco gerdau\nDO0 = Semáforo vermelho entrada / DO1 = Semáforo vermelho saída\nDO2 = Semáforo verde entrada / DO2 = Semáforo verde saída', 'Sim', 'Online', 'admin', '000000000', 'Não', 'BRUNO GONCALVES', '05/06/2023', '14:59:21'),
(8, 'Leitor RFID Balanca de saída', '10.43.78.87', '10.50.4.15', '255.255.255.0', 'Honeywell IF1', 'Leitor RFID', '10.50.4.57', 'Sim', 'Online', 'admin', 'intermec', 'Não', 'BRUNO GONCALVES', '05/06/2023', '10:32:00'),
(9, 'Impressora saída', '10.43.78.88', '10.50.4.15', '255.255.255.0', 'Impressora', 'Impressora', 'IP antigo = 10.50.4.58\nNão instalada fisicamente', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(10, 'Display Balança de saída', '10.43.78.89', '10.50.4.15', '255.255.255.0', 'Display', 'Display TCP/IP', 'IP antigo = 10.50.4.59', 'Sim', 'Online', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(11, 'Access Point', ' 10.43.78.90', '10.50.4.15', '255.255.255.0', 'Access Point', 'Access Point', 'IP antigo = 10.50.4.60\nNão instalado em campo!', 'Sim', 'Offline', 'admin', 'admin', 'Não', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(12, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(13, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(14, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(15, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(16, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(17, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(18, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(19, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(20, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(21, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(22, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(23, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(24, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(25, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(26, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(27, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(28, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(29, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(30, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(31, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(32, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(33, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(34, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(35, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(36, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(37, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(38, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(39, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(40, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(41, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(42, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(43, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(44, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(45, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(46, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(47, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(48, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(49, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(50, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(51, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(52, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(53, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(54, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(55, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(56, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(57, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(58, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(59, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(60, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(61, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(62, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(63, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(64, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(65, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(66, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(67, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(68, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(69, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(70, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(71, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(72, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(73, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(74, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(75, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(76, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(77, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(78, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(79, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(80, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(81, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(82, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(83, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(84, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(85, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(86, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(87, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(88, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(89, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(90, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(91, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(92, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(93, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(94, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(95, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(96, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(97, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(98, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(99, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(100, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(101, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(102, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(103, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(104, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(105, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(106, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(107, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(108, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(109, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(110, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(111, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(112, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(113, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(114, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(115, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(116, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(117, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(118, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(119, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(120, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(121, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(122, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(123, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(124, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(125, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(126, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(127, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(128, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(129, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(130, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(131, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(132, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(133, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(134, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(135, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(136, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(137, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(138, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(139, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(140, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(141, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(142, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(143, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(144, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(145, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(146, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(147, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(148, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(149, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(150, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(151, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(152, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(153, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(154, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(155, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(156, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(157, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(158, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(159, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(160, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(161, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(162, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(163, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(164, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(165, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(166, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(167, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(168, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(169, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(170, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(171, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(172, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(173, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(174, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(175, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(176, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(177, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(178, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(179, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(180, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(181, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(182, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(183, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(184, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(185, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(186, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(187, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(188, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(189, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(190, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(191, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(192, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(193, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(194, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(195, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(196, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(197, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(198, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(199, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(200, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(201, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(202, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(203, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(204, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(205, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(206, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(207, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(208, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(209, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(210, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(211, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(212, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(213, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(214, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(215, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(216, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(217, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(218, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(219, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(220, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(221, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(222, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(223, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(224, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(225, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(226, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(227, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(228, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(229, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(230, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(231, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(232, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(233, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(234, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(235, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(236, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(237, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(238, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00');
INSERT INTO `gerdau_patrag_balanca` (`id`, `nome`, `ip`, `gateway`, `mascara`, `modelo`, `tipo`, `informacao_adicional`, `ativo`, `status`, `usuario`, `senha`, `disponivel`, `editado_por`, `data`, `hora`) VALUES
(239, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(240, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(241, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(242, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(243, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(244, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(245, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(246, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(247, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(248, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(249, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(250, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(251, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(252, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(253, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00'),
(254, 'IP disponivel para utlização', '0.0.0.0', '0.0.0.0', '255.255.255.0', 'N/A', 'N/A', 'Sem dados complementares', 'Não', 'Offline', 'admin', 'admin', 'Sim', 'BRUNO GONCALVES', '22/05/2023', '15:52:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `gerdau_patrag_balanca`
--
ALTER TABLE `gerdau_patrag_balanca`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `gerdau_patrag_balanca`
--
ALTER TABLE `gerdau_patrag_balanca`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
