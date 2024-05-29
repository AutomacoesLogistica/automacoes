-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 09-Jul-2022 às 18:50
-- Versão do servidor: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_dashboard`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tempo_medio`
--

CREATE TABLE `tempo_medio` (
  `id` int(11) NOT NULL,
  `referencia` varchar(50) DEFAULT NULL,
  `v_turno_a` varchar(20) DEFAULT NULL,
  `v_turno_b` varchar(20) DEFAULT NULL,
  `v_turno_c` varchar(20) DEFAULT NULL,
  `v_turno_d` varchar(20) DEFAULT NULL,
  `v_dia` varchar(20) DEFAULT NULL,
  `u_v_dia` varchar(20) DEFAULT NULL,
  `v_mes` varchar(20) DEFAULT NULL,
  `v_ano` varchar(20) DEFAULT NULL,
  `limite` varchar(20) DEFAULT NULL,
  `data_atualizacao` varchar(20) DEFAULT NULL,
  `hora_atualizacao` varchar(20) DEFAULT NULL,
  `u_v_turno_a` varchar(20) DEFAULT NULL,
  `u_v_turno_b` varchar(20) DEFAULT NULL,
  `u_v_turno_c` varchar(20) DEFAULT NULL,
  `u_v_turno_d` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tempo_medio`
--

INSERT INTO `tempo_medio` (`id`, `referencia`, `v_turno_a`, `v_turno_b`, `v_turno_c`, `v_turno_d`, `v_dia`, `u_v_dia`, `v_mes`, `v_ano`, `limite`, `data_atualizacao`, `hora_atualizacao`, `u_v_turno_a`, `u_v_turno_b`, `u_v_turno_c`, `u_v_turno_d`) VALUES
(1, 'entradas_a_controles', '02.6', '04.8', '04.7', '01.6', '01.7', '04.1', '01.7', '01', '10.1', '09/07/2022', '18:47:08', '0', '0', '02.3', '0'),
(2, 'entradas_a_saidas', '51.5', '39.1', '72.4', '26.4', '30.4', '33.8', '40.1', '42.5', '85.2', '01/12/2021', '12:00:00', '0', '37.1', '34.7', '25.7'),
(3, 'controles_a_saidas', '64.3', '54.7', '60.2', '29.9', '30.2', '26.3', '29.9', '31.3', '52.3', '01/12/2021', '12:00:00', '51.5', '26.3', '72.4', '25.7'),
(4, 'controles_a_balancas', '24.8', '25.2', '20.2', '22.5', '18.8', '21.8', '23.5', '24.1', '25.7', '01/12/2021', '12:00:00', '0', '0', '0', '0'),
(5, 'balancas_a_saidas', '03.5', '02.9', '03.3', '03.7', '03.9', '0', '03.8', '03.2', '03.9', '01/12/2021', '12:00:00', '0', '0', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tempo_medio`
--
ALTER TABLE `tempo_medio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tempo_medio`
--
ALTER TABLE `tempo_medio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
