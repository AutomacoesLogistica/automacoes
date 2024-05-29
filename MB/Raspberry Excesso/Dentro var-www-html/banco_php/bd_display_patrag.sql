-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2020 às 16:44
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
-- Banco de dados: `bd_display_patrag`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `balanca_01`
--

CREATE TABLE `balanca_01` (
  `id` int(11) NOT NULL,
  `mensagem1` varchar(20) NOT NULL,
  `mensagem2` varchar(20) NOT NULL,
  `peso` varchar(6) NOT NULL,
  `semaforo_entrada` varchar(20) NOT NULL,
  `semaforo_saida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `balanca_01`
--

INSERT INTO `balanca_01` (`id`, `mensagem1`, `mensagem2`, `peso`, `semaforo_entrada`, `semaforo_saida`) VALUES
(1, '     BALANCA 01     ', '  PATRAG - GERDAU   ', '041032', 'avancar', 'parar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `balanca_02`
--

CREATE TABLE `balanca_02` (
  `id` int(11) NOT NULL,
  `mensagem1` varchar(20) NOT NULL,
  `mensagem2` varchar(20) NOT NULL,
  `peso` varchar(6) NOT NULL,
  `semaforo_entrada` varchar(20) NOT NULL,
  `semaforo_saida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `balanca_01`
--
ALTER TABLE `balanca_01`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `balanca_02`
--
ALTER TABLE `balanca_02`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `balanca_01`
--
ALTER TABLE `balanca_01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `balanca_02`
--
ALTER TABLE `balanca_02`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
