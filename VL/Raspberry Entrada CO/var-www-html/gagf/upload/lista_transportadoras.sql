-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 29-Nov-2021 às 12:12
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
-- Estrutura da tabela `lista_transportadoras`
--

CREATE TABLE `lista_transportadoras` (
  `id` int(11) NOT NULL,
  `nome_transportadora` varchar(100) NOT NULL,
  `tipo_frota` varchar(10) NOT NULL,
  `status_transportadora` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_transportadoras`
--

INSERT INTO `lista_transportadoras` (`id`, `nome_transportadora`, `tipo_frota`, `status_transportadora`) VALUES
(1, 'AREMINAS SERVICOS E TRANSPORTES LTD', 'xxx', 'xxx'),
(2, 'BELOSANTA TRANSPORTES E SERVICOS LT DA', 'xxx', 'xxx'),
(3, 'BVC TRANSPORTES LTDA', 'CATIVA', 'xxx'),
(4, 'COMERCIAL E TRANSPORTADORA VALINHAS EIRELI', 'xxx', 'xxx'),
(5, 'COMERCIAL SERRA DA PEDRA LTDA', 'xxx', 'xxx'),
(6, 'COOPERATIVA DE CONSUMO TRANSPORTE R ARIO E LOCACAO LTDA', 'xxx', 'xxx'),
(7, 'COOPERATIVA MISTA DE TRANSPORTE DE PASSAGEIROS E CONSUMO DO ESTADO DE', 'xxx', 'xxx'),
(8, 'COOPERATIVA OTIMIZAR LOGISTICA LTDA', 'xxx', 'xxx'),
(9, 'D GRANEL TRANSPORTES E COMERCIO LTD', 'xxx', 'xxx'),
(10, 'DE PAULA TRANSPORTADORA LTDA ME', 'xxx', 'xxx'),
(11, 'DUDA TRANSPORTES LTDA', 'xxx', 'xxx'),
(12, 'EH TRANSPORTES E LOGISTICA EIRELI E', 'xxx', 'xxx'),
(13, 'EXPRESSO MARVIVA LTDA ME', 'xxx', 'xxx'),
(14, 'EXPRESSO TRANSPORTE E SOLUCAO EM LO CA LTDA', 'xxx', 'xxx'),
(15, 'FERTRAN TRANSPORTES LTDA', 'xxx', 'xxx'),
(16, 'G2L LOGISTICA LTDA', 'xxx', 'xxx'),
(17, 'GILBERTO TRANSPORTES LTDA', 'xxx', 'xxx'),
(18, 'IR CARGO TRANSPORTES LTDA EPP', 'xxx', 'xxx'),
(19, 'L L TRANSPORTES LTDA', 'xxx', 'xxx'),
(20, 'LENARGE TRANSPORTES E SERVICOS LTDA', 'xxx', 'xxx'),
(21, 'MGV TRANSPORTES E COMERCIO LTDA', 'xxx', 'xxx'),
(22, 'ORGANIZACAO SANTA BARBARA LTDA', 'xxx', 'xxx'),
(23, 'PRIME LOGISTICA E SERVICOS LTDA', 'xxx', 'xxx'),
(24, 'PRP TRANSPORTES SERVICOS E LOCACAO QUINAS EIRELI EPP', 'xxx', 'xxx'),
(25, 'REITRAN TRANSPORTES LTDA', 'xxx', 'xxx'),
(26, 'REVAL TRANSPORTES LTDA EPP', 'xxx', 'xxx'),
(27, 'RLR TRANSPORTES LTDA', 'xxx', 'xxx'),
(28, 'RODOART TRANSPORTES LOCACAO COMERCI ERVICOS LTDA', 'xxx', 'xxx'),
(29, 'SILVANO SANTOS DA ROCHA EIRELI', 'xxx', 'xxx'),
(30, 'TERRA MINAS TERRAPLENAGEM MATIAS BA LTDA', 'xxx', 'xxx'),
(31, 'TORA TRANSPORTES INDUSTRIAIS LTDA', 'CATIVA', 'xxx'),
(32, 'TRANSALBINO TRANSPORTES LTDA ME', 'xxx', 'xxx'),
(33, 'TRANSBATISTA LTDA', 'xxx', 'xxx'),
(34, 'TRANSCOACO TRANSPORTE E COMERCIO DE ACO LTDA', 'xxx', 'xxx'),
(35, 'TRANSMAQ TRANSPORTES LTDA', 'xxx', 'xxx'),
(36, 'TRANSNIEL TRANSPORTES LTDA ME', 'xxx', 'xxx'),
(37, 'TRANSPORTADORA MACHADO JUNIOR LTDA', 'xxx', 'xxx'),
(38, 'TRANSPORTADORA SEMPRE VOLTA LTDA', 'xxx', 'xxx'),
(39, 'TRANSPORTES DEBISA LTDA', 'xxx', 'xxx'),
(40, 'VITRAN TRANSPORTES LTDA', 'xxx', 'xxx'),
(41, 'VOLTRAN TRANSPORTES LTDA', 'xxx', 'xxx'),
(42, 'WALMAR TRANSPORTES E LOCACOES LTDA ME', 'xxx', 'xxx'),
(43, 'WJA SERVICOS E LOCACOES LTDA  EPP', 'xxx', 'xxx'),
(44, 'YUSSEF TRANSPORTES EIRELI EPP', 'xxx', 'xxx'),
(274, 'LOGISTICA', 'xxx', 'xxx');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_transportadoras`
--
ALTER TABLE `lista_transportadoras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_transportadoras`
--
ALTER TABLE `lista_transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
