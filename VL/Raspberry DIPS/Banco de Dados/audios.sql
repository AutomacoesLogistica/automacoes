-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Out-2022 às 16:20
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
-- Estrutura da tabela `audios`
--

CREATE TABLE `audios` (
  `id` int(11) NOT NULL,
  `audio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `audios`
--

INSERT INTO `audios` (`id`, `audio`) VALUES
(2980, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2981, './audios/ROM/Saiu_carregado_saida_normal.mp3'),
(2982, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2983, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2984, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2985, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2986, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2987, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2988, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2989, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2990, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2991, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2992, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2993, './audios/ROM/Saiu_carregado_saida_normal.mp3'),
(2994, './audios/ROM/Saiu_carregado_saida_normal.mp3'),
(2995, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2996, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2997, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2998, './audios/CCL_MB/Pessoa_detectada.mp3'),
(2999, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3000, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3001, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3002, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3003, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3004, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3005, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3006, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3007, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3008, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3009, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3010, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3011, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3012, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3013, './audios/ROM/Saiu_carregado_saida_normal.mp3'),
(3014, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3015, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3016, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3017, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3018, './audios/ROM/Saiu_carregado_saida_normal.mp3'),
(3019, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3020, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3021, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3022, './audios/CCL_MB/Pessoa_detectada.mp3'),
(3023, './audios/CCL_MB/Pessoa_detectada.mp3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audios`
--
ALTER TABLE `audios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audios`
--
ALTER TABLE `audios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3024;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
