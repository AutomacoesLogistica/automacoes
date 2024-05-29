-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 27-Out-2022 às 09:42
-- Versão do servidor: 10.3.34-MariaDB-0+deb10u1
-- PHP Version: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_cancelas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `motivos_acionamentos`
--

CREATE TABLE `motivos_acionamentos` (
  `id` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `mensagem` varchar(100) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `motivos_acionamentos`
--

INSERT INTO `motivos_acionamentos` (`id`, `motivo`, `mensagem`, `tipo`) VALUES
(5, 'Pipa da Fagundes umectando a via ', 'outro', 'entrada'),
(14, 'Validou apenas SVA', 'manter', 'entrada'),
(15, 'Validou apenas GSCS', 'manter', 'entrada'),
(18, 'SVA não validou a saída', 'saida_ccl', 'saida'),
(19, 'Saída de outro tipo de veiculo', 'outro', 'saida'),
(20, 'Entrada de outro tipo de veiculo', 'outro', 'entrada'),
(21, 'Pipa da Fagundes umectando a via ', 'outro', 'saida'),
(22, 'Troca de turno, bloqueado atento!', 'manter', 'entrada2'),
(23, 'Troca de Turno - Erro GSCS', 'manter', 'entrada');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `motivos_acionamentos`
--
ALTER TABLE `motivos_acionamentos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `motivos_acionamentos`
--
ALTER TABLE `motivos_acionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
