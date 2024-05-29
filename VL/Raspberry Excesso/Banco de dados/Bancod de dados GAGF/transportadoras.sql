-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 27/10/2022 às 13:10
-- Versão do servidor: 10.3.27-MariaDB-0+deb10u1
-- Versão do PHP: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estrutura para tabela `transportadoras`
--

CREATE TABLE `transportadoras` (
  `id` int(11) NOT NULL,
  `sigla` varchar(30) NOT NULL,
  `nome` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `transportadoras`
--

INSERT INTO `transportadoras` (`id`, `sigla`, `nome`) VALUES
(1, 'BVC', 'BVC TRANSPORTES LTDA'),
(2, 'LL', 'L L TRANSPORTES LTDA'),
(3, 'D\' Paula', 'DE PAULA TRANSPORTADORA LTDA'),
(4, 'Tora', 'TORA TRANSPORTES LTDA'),
(5, 'Silvano', 'SILVANO SANTOS DA ROCHA EIRELI'),
(6, 'Terra Minas', 'TERRA MINAS TERRAPLENAGEM MATIAS BA LTDA'),
(7, 'Vitran', 'VITRAN TRANSPORTES LTDA'),
(8, 'Cooperauto', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA'),
(9, 'Cotracargem', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA'),
(10, 'TSL', 'TRANSPORTES SARZEDO LTDA');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `transportadoras`
--
ALTER TABLE `transportadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
