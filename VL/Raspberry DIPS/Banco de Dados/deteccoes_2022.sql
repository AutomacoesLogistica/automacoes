-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Out-2022 às 16:21
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
-- Estrutura da tabela `deteccoes_2022`
--

CREATE TABLE `deteccoes_2022` (
  `id` varchar(2) NOT NULL,
  `dias` varchar(4) NOT NULL,
  `janeiro` varchar(4) NOT NULL,
  `fevereiro` varchar(4) NOT NULL,
  `março` varchar(4) NOT NULL,
  `abril` varchar(4) NOT NULL,
  `maio` varchar(4) NOT NULL,
  `junho` varchar(4) NOT NULL,
  `julho` varchar(4) NOT NULL,
  `agosto` varchar(4) NOT NULL,
  `setembro` varchar(4) NOT NULL,
  `outubro` varchar(4) NOT NULL,
  `novembro` varchar(4) NOT NULL,
  `dezembro` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `deteccoes_2022`
--

INSERT INTO `deteccoes_2022` (`id`, `dias`, `janeiro`, `fevereiro`, `março`, `abril`, `maio`, `junho`, `julho`, `agosto`, `setembro`, `outubro`, `novembro`, `dezembro`) VALUES
('01', '01', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('02', '02', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('03', '03', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('04', '04', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('05', '05', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('06', '06', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('07', '07', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('08', '08', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('09', '09', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('10', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('11', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('12', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('13', '13', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('14', '14', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('15', '15', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('16', '16', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('17', '17', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('18', '18', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('19', '19', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('20', '20', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('21', '21', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('22', '22', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('23', '23', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('24', '24', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('25', '25', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('26', '26', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('27', '27', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('28', '28', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('29', '29', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('30', '30', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
('31', '31', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deteccoes_2022`
--
ALTER TABLE `deteccoes_2022`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
