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
-- Estrutura da tabela `lista_punicoes_motoristas`
--

CREATE TABLE `lista_punicoes_motoristas` (
  `id` int(11) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_punicao` varchar(10) NOT NULL,
  `hora_ocorrencia` varchar(8) NOT NULL,
  `planta` varchar(100) NOT NULL,
  `local` varchar(100) NOT NULL,
  `observacao_bloqueio` varchar(300) NOT NULL,
  `data_retorno` varchar(10) NOT NULL,
  `reincidencia` varchar(2) NOT NULL,
  `pontos_perdidos` varchar(2) NOT NULL,
  `infracao` varchar(100) NOT NULL,
  `bloqueio_lancado_por` varchar(50) NOT NULL,
  `nome_transportadora` varchar(100) NOT NULL,
  `desbloqueio_lancado_por` varchar(100) NOT NULL,
  `data_desbloqueio` varchar(10) NOT NULL,
  `observacao_desbloqueio` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_punicoes_motoristas`
--
ALTER TABLE `lista_punicoes_motoristas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_punicoes_motoristas`
--
ALTER TABLE `lista_punicoes_motoristas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
