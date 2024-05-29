-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Out-2022 às 16:23
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
-- Estrutura da tabela `referencia_audios`
--

CREATE TABLE `referencia_audios` (
  `id` int(11) NOT NULL,
  `ref_audio` varchar(80) NOT NULL,
  `audio` varchar(200) NOT NULL,
  `status` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `parecer` varchar(200) NOT NULL,
  `historico` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `referencia_audios`
--

INSERT INTO `referencia_audios` (`id`, `ref_audio`, `audio`, `status`, `nome`, `parecer`, `historico`) VALUES
(1, 'entrada_vazio_rom', './audios/ROM/Entrou_vazio.mp3', 'Ativado', '--', '--', '18/10/2021 08:10:36<b>(T)</b>'),
(2, 'saida_cheio_saida_rom', './audios/ROM/Saiu_carregado_saida_normal.mp3', 'Ativado', '--', '--', '27/10/2021 13:36:34<b>(T)</b>'),
(3, 'saida_cheio_saida_alternativa_rom', './audios/ROM/Saiu_carregado_saida_alternativa.mp3', 'Ativado', '--', '--', '15/10/2021 07:47:19<b>(T)</b>'),
(4, 'erro_gscs', './audios/ROM/Erro_gscs.mp3', 'Ativado', '--', '--', '27/10/2021 13:37:26<b>(T)</b>'),
(5, 'erro_sva', './audios/ROM/Erro_sva.mp3', 'Ativado', '--', '--', '27/10/2021 13:37:40<b>(T)</b>'),
(6, 'sirene_ccl_mb', './audios/CCL_MB/Pessoa_detectada.mp3', 'Ativado', '--', '--', '27/10/2021 13:37:54<b>(T)</b>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `referencia_audios`
--
ALTER TABLE `referencia_audios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `referencia_audios`
--
ALTER TABLE `referencia_audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
