-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 29-Nov-2021 às 12:10
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
-- Estrutura da tabela `divergencia_mb_vl_gagf`
--

CREATE TABLE `divergencia_mb_vl_gagf` (
  `id` int(11) NOT NULL,
  `data` varchar(10) NOT NULL,
  `mes` varchar(2) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `id_processo_gscs` varchar(12) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `tipo_veiculo` varchar(100) NOT NULL,
  `tara` varchar(6) NOT NULL,
  `tipo_operacao` varchar(30) NOT NULL,
  `peso_bruto_mb` varchar(6) NOT NULL,
  `peso_bruto_vl` varchar(6) NOT NULL,
  `diferenca_quilos` varchar(6) NOT NULL,
  `diferenca_percentual` varchar(6) NOT NULL,
  `transportadora` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `divergencia_mb_vl_gagf`
--

INSERT INTO `divergencia_mb_vl_gagf` (`id`, `data`, `mes`, `ano`, `id_processo_gscs`, `placa`, `estado`, `tipo_veiculo`, `tara`, `tipo_operacao`, `peso_bruto_mb`, `peso_bruto_vl`, `diferenca_quilos`, `diferenca_percentual`, `transportadora`) VALUES
(1, '14/02/2020', '02', '2020', '4899078', 'QQS-1574', 'MG', 'CARRETA-5EIXOS-41,5T', '15040', 'INTERFACE', '40920', '0', '0', '0', 'COOPERATIVA DE CONSUMO TRANSPORTE R ARIO E LOCACAO LTDA'),
(2, '14/02/2020', '02', '2020', '4899088', 'HOH-6102', 'MG', 'CARRETA-5EIXOS-41,5T', '16200', 'INTERFACE', '41460', '0', '0', '0', 'BVC TRANSPORTES LTDA'),
(3, '14/02/2020', '02', '2020', '4899152', 'OUF-9266', 'BA', 'CARRETA TRUCADA-6EIXOS-16M-45T', '17340', 'INTERFACE', '45000', '0', '0', '0', 'TORA TRANSPORTES INDUSTRIAIS LTDA'),
(4, '14/02/2020', '02', '2020', '4899209', 'PRT-5421', 'GO', 'CARRETA TRUCADA-6EIXOS-16M-45T', '17140', 'INTERFACE', '45000', '0', '0', '0', 'TORA TRANSPORTES INDUSTRIAIS LTDA'),
(5, '14/02/2020', '02', '2020', '4899242', 'PRT-5301', 'GO', 'CARRETA TRUCADA-6EIXOS-16M-45T', '17180', 'INTERFACE', '45000', '0', '0', '0', 'TORA TRANSPORTES INDUSTRIAIS LTDA'),
(6, '14/02/2020', '02', '2020', '4899313', 'OLG-7792', 'BA', 'CARRETA TRUCADA-6EIXOS-16M-45T', '18100', 'INTERFACE', '43920', '0', '0', '0', 'TORA TRANSPORTES INDUSTRIAIS LTDA'),
(7, '14/02/2020', '02', '2020', '4899347', 'OWY-3549', 'MG', 'CARRETA TRUCADA-6EIXOS-16M-45T', '17360', 'INTERFACE', '44620', '0', '0', '0', 'COOPERATIVA MISTA DE TRANSPORTE DE PASSAGEIROS E CONSUMO DO ESTADO DE'),
(8, '14/02/2020', '02', '2020', '4899388', 'PRU-6095', 'GO', 'CARRETA TRUCADA-6EIXOS-16M-45T', '17600', 'INTERFACE', '43860', '0', '0', '0', 'TORA TRANSPORTES INDUSTRIAIS LTDA'),
(9, '14/02/2020', '02', '2020', '4899954', 'GXA-3389', 'MG', 'CARRETA-5EIXOS-41,5T', '16040', 'INTERFACE', '40840', '0', '0', '0', 'COOPERATIVA MISTA DE TRANSPORTE DE PASSAGEIROS E CONSUMO DO ESTADO DE'),
(10, '14/02/2020', '02', '2020', '4900009', 'QOE-2071', 'MG', 'CARRETA-5EIXOS-41,5T', '15460', 'INTERFACE', '41260', '0', '0', '0', 'SILVANO SANTOS DA ROCHA EIRELI'),
(11, '14/02/2020', '02', '2020', '4900065', 'PRU-5945', 'GO', 'CARRETA TRUCADA-6EIXOS-16M-45T', '17520', 'INTERFACE', '44320', '0', '0', '0', 'TORA TRANSPORTES INDUSTRIAIS LTDA'),
(12, '14/02/2020', '02', '2020', '4900097', 'HCI-3862', 'MG', 'CARRETA-5EIXOS-41,5T', '17000', 'INTERFACE', '41500', '0', '0', '0', 'COMERCIAL SERRA DA PEDRA LTDA'),
(13, '14/02/2020', '02', '2020', '4900137', 'OQJ-6242', 'MG', 'CARRETA-5EIXOS-41,5T', '15640', 'INTERFACE', '41500', '0', '0', '0', 'COOPERATIVA MISTA DE TRANSPORTE DE PASSAGEIROS E CONSUMO DO ESTADO DE'),
(14, '14/02/2020', '02', '2020', '4900207', 'OPR-4000', 'MG', 'CARRETA TRUCADA-6EIXOS-16M-45T', '17420', 'INTERFACE', '45000', '0', '0', '0', 'COOPERATIVA MISTA DE TRANSPORTE DE PASSAGEIROS E CONSUMO DO ESTADO DE');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `divergencia_mb_vl_gagf`
--
ALTER TABLE `divergencia_mb_vl_gagf`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `divergencia_mb_vl_gagf`
--
ALTER TABLE `divergencia_mb_vl_gagf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
