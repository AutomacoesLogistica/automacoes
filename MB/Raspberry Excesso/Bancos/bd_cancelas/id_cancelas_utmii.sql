-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Nov-2022 às 16:36
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
-- Estrutura da tabela `id_cancelas_utmii`
--

CREATE TABLE `id_cancelas_utmii` (
  `id` int(11) NOT NULL,
  `nomecancela` varchar(50) NOT NULL,
  `codigo_lora` varchar(10) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `condicao` varchar(20) NOT NULL,
  `tag_lida` varchar(24) NOT NULL,
  `info` varchar(80) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_utmii`
--

INSERT INTO `id_cancelas_utmii` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`) VALUES
(1, 'Entrada UTMII', '02', 'Miguel Burnier - UTMII', 'can1_mb', 'Fechada!', '', '', '24/10/2020', '15:00:39'),
(2, 'Saída UTMII', '03', 'Miguel Burnier - UTMII', 'can2_mb', 'Fechada!', '', '', '14/07/2020', '13:33:23'),
(3, 'Entrada Recebimento ROM', '04', 'Miguel Burnier - UTMII', 'can3_mb', 'Fechada!', '', '', '14/07/2020', '13:33:23'),
(4, 'Saída Recebimento ROM', '05', 'Miguel Burnier - UTMII', 'can4_mb', 'Aberta!', '', '</br>17/11/2020 - 14:57:13', '17/11/2020', '14:57:13'),
(5, 'Saída Alt. Recebimento ROM', '06', 'Miguel Burnier - UTMII', 'can5_mb', 'Aberta!', '', '</br>20/11/2020 - 13:11:23', '20/11/2020', '13:11:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `id_cancelas_utmii`
--
ALTER TABLE `id_cancelas_utmii`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `id_cancelas_utmii`
--
ALTER TABLE `id_cancelas_utmii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;