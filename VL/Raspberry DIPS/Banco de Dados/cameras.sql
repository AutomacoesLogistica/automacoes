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
-- Estrutura da tabela `cameras`
--

CREATE TABLE `cameras` (
  `id` int(11) NOT NULL,
  `camera_id` varchar(20) NOT NULL,
  `data_leitura` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cameras`
--

INSERT INTO `cameras` (`id`, `camera_id`, `data_leitura`, `hora`) VALUES
(1, 'ms0742-cam00', '26/10/2022', '16:16:47'),
(2, 'ms0742-cam01', '26/10/2022', '15:19:41'),
(3, 'ms0742-cam02', '26/10/2022', '16:15:35'),
(4, 'ms0742-cam03', '17/07/2022', '13:09:37'),
(5, 'ms0742-cam04', '01/01/2021', '18:54:24'),
(6, 'ms0742-cam05', '18/10/2022', '15:14:20'),
(7, 'ms0742-cam06', '17/09/2022', '20:30:43'),
(8, 'ms0742-cam07', '13/10/2022', '11:36:11'),
(9, 'ms0742-cam08', '24/10/2022', '15:06:09'),
(10, 'ms0742-cam09', '01/01/2021', '18:54:24'),
(11, 'ms0742-cam10', '01/01/2021', '18:54:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cameras`
--
ALTER TABLE `cameras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
