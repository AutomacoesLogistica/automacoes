-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 25-Maio-2021 às 14:22
-- Versão do servidor: 10.3.25-MariaDB-0+deb10u1
-- PHP Version: 7.3.19-1~deb10u1

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
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `registro` varchar(8) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `area` varchar(50) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `criptografia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `registro`, `senha`, `area`, `tipo_usuario`, `criptografia`) VALUES
(1, 'Bruno Gonçalves', '37063378', 'gerdau', 'Logística MB', 'Desenvolvedor', '55595067'),
(2, 'Higor da Silva Souza', '37099636', 'gerdau19', 'Logística MB', 'Administrador', '55649454'),
(13, 'Adriano Miranda Luppi', '37063200', 'luppi', 'Logística VL', 'Administrador', '55594800'),
(14, 'Denise Aloma de Almeida Brito', '37063201', 'denise', 'Logística MB', 'Gestão GAGF', '55594801.5'),
(15, 'Beatriz Eluise Bittencourt', '37080627', '123', 'Logística MB', 'Gestão CCL MB', '55620940.5'),
(16, 'Usuarios CCL Miguel Burnier', '12345678', '12345678', 'Logística MB', 'Gestão CCL MB', '18518517');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
