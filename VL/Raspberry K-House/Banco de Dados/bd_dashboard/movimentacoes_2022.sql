-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 09-Jul-2022 às 18:49
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
-- Estrutura da tabela `movimentacoes_2022`
--

CREATE TABLE `movimentacoes_2022` (
  `id` int(11) NOT NULL,
  `mes` varchar(2) NOT NULL,
  `ttp_mes` varchar(6) DEFAULT NULL,
  `ttp_mes_entrada` varchar(6) DEFAULT NULL,
  `quantidade` varchar(5) NOT NULL,
  `v_1` varchar(3) NOT NULL,
  `v_2` varchar(3) NOT NULL,
  `v_3` varchar(3) NOT NULL,
  `v_4` varchar(3) NOT NULL,
  `v_5` varchar(3) NOT NULL,
  `v_6` varchar(3) NOT NULL,
  `v_7` varchar(3) NOT NULL,
  `v_8` varchar(3) NOT NULL,
  `v_9` varchar(3) NOT NULL,
  `v_10` varchar(3) NOT NULL,
  `v_11` varchar(3) NOT NULL,
  `v_12` varchar(3) NOT NULL,
  `v_13` varchar(3) NOT NULL,
  `v_14` varchar(3) NOT NULL,
  `v_15` varchar(3) NOT NULL,
  `v_16` varchar(3) NOT NULL,
  `v_17` varchar(3) NOT NULL,
  `v_18` varchar(3) NOT NULL,
  `v_19` varchar(3) NOT NULL,
  `v_20` varchar(3) NOT NULL,
  `v_21` varchar(3) NOT NULL,
  `v_22` varchar(3) NOT NULL,
  `v_23` varchar(3) NOT NULL,
  `v_24` varchar(3) NOT NULL,
  `v_25` varchar(3) NOT NULL,
  `v_26` varchar(3) NOT NULL,
  `v_27` varchar(3) NOT NULL,
  `v_28` varchar(3) NOT NULL,
  `v_29` varchar(3) NOT NULL,
  `v_30` varchar(3) NOT NULL,
  `v_31` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `movimentacoes_2022`
--

INSERT INTO `movimentacoes_2022` (`id`, `mes`, `ttp_mes`, `ttp_mes_entrada`, `quantidade`, `v_1`, `v_2`, `v_3`, `v_4`, `v_5`, `v_6`, `v_7`, `v_8`, `v_9`, `v_10`, `v_11`, `v_12`, `v_13`, `v_14`, `v_15`, `v_16`, `v_17`, `v_18`, `v_19`, `v_20`, `v_21`, `v_22`, `v_23`, `v_24`, `v_25`, `v_26`, `v_27`, `v_28`, `v_29`, `v_30`, `v_31`) VALUES
(1, '01', '0', '0', '00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, '02', '0', '0', '00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, '03', '0', '0', '755', '26', '148', '126', '86', '88', '25', '66', '38', '3', '13', '6', '4', '13', '41', '0', '3', '7', '8', '1', '0', '6', '9', '13', '13', '0', '0', '0', '0', '2', '5', '5'),
(4, '04', '0', '0', '7230', '323', '251', '268', '308', '425', '339', '383', '129', '286', '330', '341', '336', '285', '269', '216', '215', '56', '346', '453', '413', '444', '296', '7', '0', '0', '0', '0', '16', '210', '254', '0'),
(5, '05', '0', '0', '15121', '323', '364', '371', '329', '350', '263', '336', '255', '374', '330', '321', '391', '416', '373', '322', '400', '412', '455', '616', '845', '694', '530', '760', '455', '628', '999', '995', '889', '669', '645', '16'),
(6, '06', '36.8', '48.1', '20134', '650', '412', '433', '448', '533', '845', '845', '762', '842', '763', '577', '281', '639', '698', '696', '754', '755', '616', '485', '567', '805', '850', '869', '784', '578', '547', '897', '890', '839', '475', '0'),
(7, '07', '33.0', '43.0', '5492', '395', '615', '346', '638', '700', '927', '558', '505', '376', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(8, '08', '0', '0', '00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(9, '09', '0', '0', '00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(10, '10', '0', '0', '00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(11, '11', '0', '0', '00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(12, '12', '0', '0', '00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movimentacoes_2022`
--
ALTER TABLE `movimentacoes_2022`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movimentacoes_2022`
--
ALTER TABLE `movimentacoes_2022`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
