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
-- Estrutura da tabela `lista_funcao_readers`
--

CREATE TABLE `lista_funcao_readers` (
  `id` int(11) NOT NULL,
  `funcao` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_funcao_readers`
--

INSERT INTO `lista_funcao_readers` (`id`, `funcao`) VALUES
(1, 'Abertura Processo 01 UTMII'),
(2, 'Abertura Processo 01 VL'),
(3, 'Abertura Processo 02 UTMII'),
(4, 'Abertura Processo 02 VL'),
(5, 'Abertura Processo 03 VL'),
(6, 'Abertura Processo Frota Cativa VL'),
(7, 'Amostragem UTMII - Pátio Produto'),
(8, 'Amostragem VL'),
(9, 'Entrada 01 UOB'),
(10, 'Entrada 02 UOB'),
(11, 'Entrada Belo Horizonte'),
(12, 'Entrada Congonhas'),
(13, 'Entrada Patrag'),
(14, 'Entrada Portaria Pires'),
(15, 'Entrada Recebimento ROM - UTMII'),
(16, 'Entrada TCM'),
(17, 'Entrada UTMII'),
(18, 'PC-02.001'),
(19, 'PC-02.002'),
(20, 'PC-02.003'),
(21, 'PC-02.004'),
(22, 'PC-02.005'),
(23, 'PC-02.006'),
(24, 'PC-02.007'),
(25, 'PC-02.008'),
(26, 'PC-02.009'),
(27, 'PC-02.010'),
(28, 'Saída 01 Congonhas'),
(29, 'Saída 01 UOB'),
(30, 'Saída 02 Congonhas'),
(31, 'Saída 02 UOB'),
(32, 'Saída Alternativa Recebimento ROM - UTMII'),
(33, 'Saída Belo Horizonte'),
(34, 'Saída  Patrag'),
(35, 'Saída Portaria MG-030 - Balança 01'),
(36, 'Saída Portaria MG-030 - Fora da Balança 01'),
(37, 'Saída Portaria Pires'),
(38, 'Saída Recebimento ROM - UTMII'),
(39, 'Saída TCM'),
(40, 'Saída UTMII'),
(41, 'Testes MQTT');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_funcao_readers`
--
ALTER TABLE `lista_funcao_readers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_funcao_readers`
--
ALTER TABLE `lista_funcao_readers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
