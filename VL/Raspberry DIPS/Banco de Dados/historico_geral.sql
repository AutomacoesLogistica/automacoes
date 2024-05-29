-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Out-2022 às 16:22
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
-- Estrutura da tabela `historico_geral`
--

CREATE TABLE `historico_geral` (
  `id` int(11) NOT NULL,
  `tipo_evento` varchar(10) NOT NULL,
  `media_server_id` varchar(10) NOT NULL,
  `detected_at` varchar(80) NOT NULL,
  `text` varchar(100) NOT NULL,
  `camera_id` varchar(20) NOT NULL,
  `caminho` varchar(200) NOT NULL,
  `caminho_video` varchar(200) NOT NULL,
  `caminho_imagem` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historico_geral`
--
ALTER TABLE `historico_geral`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historico_geral`
--
ALTER TABLE `historico_geral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
