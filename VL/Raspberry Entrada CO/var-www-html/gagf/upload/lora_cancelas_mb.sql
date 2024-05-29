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
-- Estrutura da tabela `lora_cancelas_mb`
--

CREATE TABLE `lora_cancelas_mb` (
  `id` int(11) NOT NULL,
  `ponto` varchar(50) NOT NULL,
  `condicao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lora_cancelas_mb`
--

INSERT INTO `lora_cancelas_mb` (`id`, `ponto`, `condicao`) VALUES
(1, 'cancela_01', 'OK'),
(2, 'cancela_02', 'normal'),
(3, 'cancela_03', 'normal'),
(4, 'cancela_04', 'normal'),
(5, 'cancela_05', 'normal'),
(6, 'cancela_06', 'OK');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lora_cancelas_mb`
--
ALTER TABLE `lora_cancelas_mb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lora_cancelas_mb`
--
ALTER TABLE `lora_cancelas_mb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
