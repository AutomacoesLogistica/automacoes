-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 29-Nov-2021 às 12:11
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
-- Estrutura da tabela `lista_readers`
--

CREATE TABLE `lista_readers` (
  `id` int(11) NOT NULL,
  `ca` varchar(10) NOT NULL,
  `excesso` varchar(3) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `alocada_em` varchar(100) NOT NULL,
  `funcao` varchar(60) NOT NULL,
  `antena` varchar(1) NOT NULL,
  `tipo_antena` varchar(20) NOT NULL,
  `operador` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_readers`
--

INSERT INTO `lista_readers` (`id`, `ca`, `excesso`, `local_instalacao`, `alocada_em`, `funcao`, `antena`, `tipo_antena`, `operador`) VALUES
(1, 'CA16002793', '', 'Miguel Burnier', '', 'Entrada Portaria Pires', '0', '', ''),
(2, 'CA16002793', '', 'Miguel Burnier', '', 'Entrada Portaria Pires', '1', '', ''),
(3, 'CA16002793', '', 'Miguel Burnier', '', 'Saída Portaria Pires', '2', '', ''),
(4, 'CA16002793', '', 'Miguel Burnier', '', 'Saída Portaria Pires', '3', '', ''),
(5, 'KA17005930', '', 'Miguel Burnier', '', 'Entrada UTMII', '0', 'Cavalo e Carro', ''),
(6, 'KA17005930', '', 'Miguel Burnier', '', 'Entrada UTMII', '1', 'Carreta', ''),
(7, 'KA17005930', '', 'Miguel Burnier', '', 'Saída UTMII', '2', 'Cavalo e Carro', ''),
(8, 'KA17005930', '', 'Miguel Burnier', '', 'Saída UTMII', '3', 'Carreta', ''),
(9, 'CA16002841', '', 'Miguel Burnier', '', 'Abertura Processo 01 UTMII', '0', '', ''),
(10, 'CA16002841', '', 'Miguel Burnier', '', 'Abertura Processo 01 UTMII', '1', '', ''),
(11, 'CA16003023', '', 'Miguel Burnier', '', 'Abertura Processo 02 UTMII', '0', '', ''),
(12, 'CA16003023', '', 'Miguel Burnier', '', 'Abertura Processo 02 UTMII', '1', '', ''),
(13, 'KB16005363', '', 'Miguel Burnier', '', 'Amostragem UTMII - Pátio Produto', '0', '', ''),
(14, 'KB16005363', '', 'Miguel Burnier', '', 'Amostragem UTMII - Pátio Produto', '1', '', ''),
(15, 'CA16003055', '', 'Miguel Burnier', '', 'Entrada Recebimento ROM - UTMII', '0', '', ''),
(16, 'CA16003055', '', 'Miguel Burnier', '', 'Entrada Recebimento ROM - UTMII', '1', '', ''),
(17, 'CA16003055', '', 'Miguel Burnier', '', 'Saída Recebimento ROM - UTMII', '2', '', ''),
(18, 'CA16003055', '', 'Miguel Burnier', '', 'Saída Recebimento ROM - UTMII', '3', '', ''),
(19, 'KA17005936', '', 'Miguel Burnier', '', 'Saída Alternativa Recebimento ROM - UTMII', '0', '', ''),
(20, 'KA17005936', '', 'Miguel Burnier', '', 'Saída Alternativa Recebimento ROM - UTMII', '1', '', ''),
(21, 'CA16002838', '', 'Miguel Burnier', '', 'Saída Portaria MG-030 - Balança 01', '0', '', ''),
(22, 'CA16002838', '', 'Miguel Burnier', '', 'Saída Portaria MG-030 - Fora da Balança 01', '1', '', ''),
(23, 'KB16004395', '', 'Várzea do Lopes', '', 'Entrada Belo Horizonte', '0', '', ''),
(24, 'KB16004395', '', 'Várzea do Lopes', '', 'Entrada Belo Horizonte', '1', '', ''),
(25, 'CA16002837', '', 'Várzea do Lopes', '', 'Entrada Congonhas', '0', '', ''),
(26, 'CA16002837', '', 'Várzea do Lopes', '', 'Entrada Congonhas', '1', '', ''),
(27, 'CA16002919', '', 'Várzea do Lopes', '', 'Abertura Processo 01 VL', '0', '', ''),
(28, 'CA16002919', '', 'Várzea do Lopes', '', 'Abertura Processo 01 VL', '1', '', ''),
(29, 'CA16002832', '', 'Várzea do Lopes', '', 'Abertura Processo 02 VL', '0', '', ''),
(30, 'CA16002832', '', 'Várzea do Lopes', '', 'Abertura Processo 02 VL', '1', '', ''),
(31, 'CA16003058', '', 'Várzea do Lopes', '', 'Abertura Processo 03 VL', '0', '', ''),
(32, 'CA16003058', '', 'Várzea do Lopes', '', 'Abertura Processo 03 VL', '1', '', ''),
(33, 'CA16002794', '', 'Várzea do Lopes', '', 'Abertura Processo Frota Cativa VL', '0', '', ''),
(34, 'CA16002794', '', 'Várzea do Lopes', '', 'Abertura Processo Frota Cativa VL', '1', '', ''),
(35, 'KA16006118', '', 'Várzea do Lopes', '', 'Amostragem VL', '0', '', ''),
(36, 'KA16006118', '', 'Várzea do Lopes', '', 'Amostragem VL', '1', '', ''),
(37, 'CA16002792', '', 'Várzea do Lopes', '', 'Saída 01 Congonhas', '0', '', ''),
(38, 'CA16002792', '', 'Várzea do Lopes', '', 'Saída 01 Congonhas', '1', '', ''),
(39, 'CA16002792', '', 'Várzea do Lopes', '', 'Saída 02 Congonhas', '2', '', ''),
(40, 'CA16002792', '', 'Várzea do Lopes', '', 'Saída 02 Congonhas', '3', '', ''),
(41, 'CA16002848', '', 'Várzea do Lopes', '', 'Saída Belo Horizonte', '0', '', ''),
(42, 'CA16002848', '', 'Várzea do Lopes', '', 'Saída Belo Horizonte', '1', '', ''),
(43, 'CA16002931', '', 'Patrag', '', 'Entrada Patrag', '0', '', ''),
(44, 'CA16002931', '', 'Patrag', '', 'Entrada Patrag', '1', '', ''),
(45, 'CA16002931', '', 'Patrag', '', 'Saída Patrag', '2', '', ''),
(46, 'CA16002931', '', 'Patrag', '', 'Saída Patrag', '3', '', ''),
(47, 'KB16005457', '', 'Usina Ouro Branco', '', 'Entrada 01 UOB', '0', '', ''),
(48, 'KB16005457', '', 'Usina Ouro Branco', '', 'Entrada 01 UOB', '1', '', ''),
(49, 'KB16005311', '', 'Usina Ouro Branco', '', 'Entrada 02 UOB', '0', '', ''),
(50, 'KB16005311', '', 'Usina Ouro Branco', '', 'Entrada 02 UOB', '1', '', ''),
(51, 'KB16005311', '', 'Usina Ouro Branco', '', 'Saída 01 UOB', '2', '', ''),
(52, 'KB16005311', '', 'Usina Ouro Branco', '', 'Saída 01 UOB', '3', '', ''),
(53, 'KB16005289', '', 'Usina Ouro Branco', '', 'Saída 02 UOB', '0', '', ''),
(54, 'KB16005289', '', 'Usina Ouro Branco', '', 'Saída 02 UOB', '1', '', ''),
(55, 'KB16006203', '', 'Terminal do Murtinho', '', 'Entrada TCM', '0', '', ''),
(56, 'KB16006203', '', 'Terminal do Murtinho', '', 'Entrada TCM', '1', '', ''),
(57, 'KB16006203', '', 'Terminal do Murtinho', '', 'Saída TCM', '2', '', ''),
(58, 'KB16006203', '', 'Terminal do Murtinho', '', 'Saída TCM', '3', '', ''),
(59, 'CA16002791', '', 'Pá Carregadeira', '', 'PC-02.001', '0', '', ''),
(60, 'CA16002791', '', 'Pá Carregadeira', '', 'PC-02.001', '1', '', ''),
(61, 'CA16002840', '', 'Pá Carregadeira', '', 'PC-02.002', '0', '', ''),
(62, 'CA16002840', '', 'Pá Carregadeira', '', 'PC-02.002', '1', '', ''),
(63, 'KB16005335', '', 'Pá Carregadeira', '', 'PC-02.003', '0', '', ''),
(64, 'KB16005335', '', 'Pá Carregadeira', '', 'PC-02.003', '1', '', ''),
(65, 'CA16002981', '', 'Pá Carregadeira', '', 'PC-02.004', '0', '', ''),
(66, 'CA16002981', '', 'Pá Carregadeira', '', 'PC-02.004', '1', '', ''),
(67, 'CA16002833', '', 'Pá Carregadeira', '', 'PC-02.005', '0', '', ''),
(68, 'CA16002833', '', 'Pá Carregadeira', '', 'PC-02.005', '1', '', ''),
(69, 'CA16002783', '', 'Pá Carregadeira', '', 'PC-02.006', '0', '', ''),
(70, 'CA16002783', '', 'Pá Carregadeira', '', 'PC-02.006', '1', '', ''),
(71, 'CA16002796', '', 'Pá Carregadeira', '', 'PC-02.007', '0', '', ''),
(72, 'CA16002796', '', 'Pá Carregadeira', '', 'PC-02.007', '1', '', ''),
(73, 'XXXXXXXX', '', 'Pá Carregadeira', '', 'PC-02.008', '0', '', ''),
(74, 'XXXXXXXX', '', 'Pá Carregadeira', '', 'PC-02.008', '1', '', ''),
(75, 'CA16002907', '', 'Pá Carregadeira', '', 'PC-02.009', '0', '', ''),
(76, 'CA16002907', '', 'Pá Carregadeira', '', 'PC-02.009', '1', '', ''),
(77, 'CB16001157', '', 'Pá Carregadeira', '', 'PC-02.010', '0', '', ''),
(78, 'CB16001157', '', 'Pá Carregadeira', '', 'PC-02.010', '1', '', ''),
(79, 'CA16003066', '', 'Reader Teste', '', 'Testes MQTT', '0', '', ''),
(80, 'CA16003066', '', 'Reader Teste', '', 'Testes MQTT', '1', '', ''),
(84, 'CA16002802', 'sim', 'Miguel Burnier', '', 'Carregadeira Excesso 01', '0', 'Carreta', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_readers`
--
ALTER TABLE `lista_readers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_readers`
--
ALTER TABLE `lista_readers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
