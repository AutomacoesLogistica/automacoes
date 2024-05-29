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
-- Estrutura da tabela `cheio_vazio`
--

CREATE TABLE `cheio_vazio` (
  `id` int(11) NOT NULL,
  `tipo_evento` varchar(10) DEFAULT NULL,
  `media_server_id` varchar(10) DEFAULT NULL,
  `detected_at` varchar(80) DEFAULT NULL,
  `data_leitura` varchar(10) DEFAULT NULL,
  `hora` varchar(8) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL,
  `camera_id` varchar(20) DEFAULT NULL,
  `caminho` varchar(200) DEFAULT NULL,
  `caminho_video` varchar(200) DEFAULT NULL,
  `imagem` mediumblob DEFAULT NULL,
  `justificado` varchar(3) DEFAULT NULL,
  `registro` varchar(20) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `justificativa` varchar(250) DEFAULT NULL,
  `placa` varchar(15) DEFAULT NULL,
  `resumo_transportadora` varchar(100) DEFAULT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `deteccao_falsa` varchar(3) DEFAULT NULL,
  `epc` varchar(30) DEFAULT NULL,
  `gagf` varchar(30) DEFAULT NULL,
  `gscs` varchar(30) DEFAULT NULL,
  `nomination` varchar(30) DEFAULT NULL,
  `material` varchar(200) DEFAULT NULL,
  `liquido` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cheio_vazio`
--
ALTER TABLE `cheio_vazio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cheio_vazio`
--
ALTER TABLE `cheio_vazio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
