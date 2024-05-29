-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Out-2022 às 16:24
-- Versão do servidor: 10.3.34-MariaDB-0+deb10u1
-- PHP Version: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_sva`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `registro` varchar(8) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `area` varchar(50) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `criptografia` varchar(20) NOT NULL,
  `primeiro_acesso` varchar(1) NOT NULL,
  `acesso_portal` int(10) NOT NULL,
  `acesso_excesso` int(10) NOT NULL,
  `acesso_aciona_cancela` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `registro`, `senha`, `area`, `tipo_usuario`, `criptografia`, `primeiro_acesso`, `acesso_portal`, `acesso_excesso`, `acesso_aciona_cancela`) VALUES
(1, 'BRUNO GONÇALVES', '37063378', 'gerdau', 'Logística MB', 'Desenvolvedor', '55595067', '1', 29, 0, 0),
(2, 'ADRIANO MIRANDA LUPPI', '37063200', 'gerdau10', 'Logística VL', 'Administrador', '55594800', '1', 0, 0, 0),
(3, 'DENISE ALOMA DE ALMEIDA BRITO', '37063201', 'denise', 'Logística MB', 'Gestão GAGF', '55594801.5', '0', 0, 0, 0),
(4, 'ALEXANDRE BALDOINO', '37077902', 'Alebal', 'Logística MB', 'Operador CCL MB', '55616853', '1', 0, 0, 0),
(5, 'AMANDA APARECIDA XAVIER', '37071407', 'GERDAU2023', 'Logística MB', 'Operador CCL MB', '55607110.5', '1', 0, 0, 0),
(6, 'BEATRIZ ELUISE BITTENCOURT LOBO', '37080627', '37080627', 'Logística MB', 'Gestão CCL MB', '55620940.5', '0', 0, 0, 0),
(7, 'CAROLINA BEATRIZ DOS SANTOS SILVA', '37081503', 'bELLOC@09', 'Logística MB', 'Operador CCL MB', '55622254.5', '1', 0, 0, 0),
(8, 'ELIMAR LUCAS ELEOTERIO NEVES', '37077887', '37077887', 'Logística MB', 'Operador CCL MB', '55616830.5', '0', 0, 0, 0),
(9, 'ERICK FABIANE PACHECO', '37078311', '37078311', 'Logística MB', 'Operador CCL MB', '55617466.5', '0', 0, 0, 0),
(10, 'GERVESOM ALVES LIMA', '37080458', '495681', 'Logística MB', 'Operador CCL MB', '55620687', '1', 0, 0, 0),
(11, 'HUIGO FILIPE LOBO BARBOSA', '37077598', '70936', 'Logística MB', 'Operador CCL MB', '55616397', '1', 0, 0, 0),
(12, 'JOSE CARLOS GUIMARÃES', '37078567', '37078567', 'Logística MB', 'Gestão CCL MB', '55617850.5', '0', 0, 0, 0),
(13, 'LORRANE APARECIDA DE JESUS PEREIRA', '37080260', '37080260', 'Logística MB', 'Operador CCL MB', '55620390', '0', 0, 0, 0),
(14, 'PABLO ANTONIO NAVAIS ALVES', '37072078', '37072078', 'Logística MB', 'Operador CCL MB', '55608117', '0', 0, 0, 0),
(15, 'PABLO GARCIA BARBOSA', '37077894', 'p@blim15', 'Logística MB', 'Operador CCL MB', '55616841', '1', 0, 0, 0),
(16, 'PHAGNER PHILIPE DE OLIVEIRA TEIXEIRA', '37077592', 'gerdau&129', 'Logística MB', 'Operador CCL MB', '55616388', '1', 0, 0, 0),
(17, 'THAIS APARECIDA COIMBRA DE QUEIRÓS TEIXEIRA', '37096468', 'zero1921', 'Logística MB', 'Operador CCL MB', '55644702', '1', 0, 0, 0),
(18, 'YANEZ ELVIO SANTOS SILVA', '37077594', '37077594', 'Logística MB', 'Operador CCL MB', '55616391', '0', 0, 0, 0),
(19, 'ROMULO CEZAR APARECIDO TAVARES', '37085870', 'RTAVARE1', 'Logística MB', 'Operador CCL MB', '55628805', '1', 0, 0, 0),
(20, 'AMANDA DA MATA CASTILIO', '37106411', '37106411', 'Logística MB', 'Operador CCL MB', '55659616.5', '0', 0, 0, 0),
(21, 'SIMONE APARECIDA DA SILVA', '37095811', 'Gerdau16', 'Logística MB', 'Operador CCL MB', '55643716.5', '1', 0, 0, 0),
(22, 'ROBSON CESAR TEIXEIRA', '37095778', 'iphone2022', 'Logística MB', 'Operador CCL MB', '55643667', '1', 0, 0, 0),
(23, 'SVATECH', '20162016', 'svatech', 'Equipe SVATECH', 'SUPORTE', '30243024', '1', 29, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;