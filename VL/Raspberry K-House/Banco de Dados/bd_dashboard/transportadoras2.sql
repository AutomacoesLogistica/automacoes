-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 07-Jan-2023 às 08:55
-- Versão do servidor: 10.3.36-MariaDB-0+deb10u2
-- PHP Version: 7.3.31-1~deb10u1

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
-- Estrutura da tabela `transportadoras2`
--

CREATE TABLE `transportadoras2` (
  `id` int(11) NOT NULL,
  `sigla` varchar(20) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `mes1_dia_1` varchar(8) DEFAULT NULL,
  `mes1_dia_2` varchar(8) DEFAULT NULL,
  `mes1_dia_3` varchar(8) DEFAULT NULL,
  `mes1_dia_4` varchar(8) DEFAULT NULL,
  `mes1_dia_5` varchar(8) DEFAULT NULL,
  `mes1_dia_6` varchar(8) DEFAULT NULL,
  `mes1_dia_7` varchar(8) DEFAULT NULL,
  `mes1_dia_8` varchar(8) DEFAULT NULL,
  `mes1_dia_9` varchar(8) DEFAULT NULL,
  `mes1_dia_10` varchar(8) DEFAULT NULL,
  `mes1_dia_11` varchar(8) DEFAULT NULL,
  `mes1_dia_12` varchar(8) DEFAULT NULL,
  `mes1_dia_13` varchar(8) DEFAULT NULL,
  `mes1_dia_14` varchar(8) DEFAULT NULL,
  `mes1_dia_15` varchar(8) DEFAULT NULL,
  `mes1_dia_16` varchar(8) DEFAULT NULL,
  `mes1_dia_17` varchar(8) DEFAULT NULL,
  `mes1_dia_18` varchar(8) DEFAULT NULL,
  `mes1_dia_19` varchar(8) DEFAULT NULL,
  `mes1_dia_20` varchar(8) DEFAULT NULL,
  `mes1_dia_21` varchar(8) DEFAULT NULL,
  `mes1_dia_22` varchar(8) DEFAULT NULL,
  `mes1_dia_23` varchar(8) DEFAULT NULL,
  `mes1_dia_24` varchar(8) DEFAULT NULL,
  `mes1_dia_25` varchar(8) DEFAULT NULL,
  `mes1_dia_26` varchar(8) DEFAULT NULL,
  `mes1_dia_27` varchar(8) DEFAULT NULL,
  `mes1_dia_28` varchar(8) DEFAULT NULL,
  `mes1_dia_29` varchar(8) DEFAULT NULL,
  `mes1_dia_30` varchar(8) DEFAULT NULL,
  `mes1_dia_31` varchar(8) DEFAULT NULL,
  `mes2_dia_1` varchar(8) DEFAULT NULL,
  `mes2_dia_2` varchar(8) DEFAULT NULL,
  `mes2_dia_3` varchar(8) DEFAULT NULL,
  `mes2_dia_4` varchar(8) DEFAULT NULL,
  `mes2_dia_5` varchar(8) DEFAULT NULL,
  `mes2_dia_6` varchar(8) DEFAULT NULL,
  `mes2_dia_7` varchar(8) DEFAULT NULL,
  `mes2_dia_8` varchar(8) DEFAULT NULL,
  `mes2_dia_9` varchar(8) DEFAULT NULL,
  `mes2_dia_10` varchar(8) DEFAULT NULL,
  `mes2_dia_11` varchar(8) DEFAULT NULL,
  `mes2_dia_12` varchar(8) DEFAULT NULL,
  `mes2_dia_13` varchar(8) DEFAULT NULL,
  `mes2_dia_14` varchar(8) DEFAULT NULL,
  `mes2_dia_15` varchar(8) DEFAULT NULL,
  `mes2_dia_16` varchar(8) DEFAULT NULL,
  `mes2_dia_17` varchar(8) DEFAULT NULL,
  `mes2_dia_18` varchar(8) DEFAULT NULL,
  `mes2_dia_19` varchar(8) DEFAULT NULL,
  `mes2_dia_20` varchar(8) DEFAULT NULL,
  `mes2_dia_21` varchar(8) DEFAULT NULL,
  `mes2_dia_22` varchar(8) DEFAULT NULL,
  `mes2_dia_23` varchar(8) DEFAULT NULL,
  `mes2_dia_24` varchar(8) DEFAULT NULL,
  `mes2_dia_25` varchar(8) DEFAULT NULL,
  `mes2_dia_26` varchar(8) DEFAULT NULL,
  `mes2_dia_27` varchar(8) DEFAULT NULL,
  `mes2_dia_28` varchar(8) DEFAULT NULL,
  `mes2_dia_29` varchar(8) DEFAULT NULL,
  `mes2_dia_30` varchar(8) DEFAULT NULL,
  `mes2_dia_31` varchar(8) DEFAULT NULL,
  `mes3_dia_1` varchar(8) DEFAULT NULL,
  `mes3_dia_2` varchar(8) DEFAULT NULL,
  `mes3_dia_3` varchar(8) DEFAULT NULL,
  `mes3_dia_4` varchar(8) DEFAULT NULL,
  `mes3_dia_5` varchar(8) DEFAULT NULL,
  `mes3_dia_6` varchar(8) DEFAULT NULL,
  `mes3_dia_7` varchar(8) DEFAULT NULL,
  `mes3_dia_8` varchar(8) DEFAULT NULL,
  `mes3_dia_9` varchar(8) DEFAULT NULL,
  `mes3_dia_10` varchar(8) DEFAULT NULL,
  `mes3_dia_11` varchar(8) DEFAULT NULL,
  `mes3_dia_12` varchar(8) DEFAULT NULL,
  `mes3_dia_13` varchar(8) DEFAULT NULL,
  `mes3_dia_14` varchar(8) DEFAULT NULL,
  `mes3_dia_15` varchar(8) DEFAULT NULL,
  `mes3_dia_16` varchar(8) DEFAULT NULL,
  `mes3_dia_17` varchar(8) DEFAULT NULL,
  `mes3_dia_18` varchar(8) DEFAULT NULL,
  `mes3_dia_19` varchar(8) DEFAULT NULL,
  `mes3_dia_20` varchar(8) DEFAULT NULL,
  `mes3_dia_21` varchar(8) DEFAULT NULL,
  `mes3_dia_22` varchar(8) DEFAULT NULL,
  `mes3_dia_23` varchar(8) DEFAULT NULL,
  `mes3_dia_24` varchar(8) DEFAULT NULL,
  `mes3_dia_25` varchar(8) DEFAULT NULL,
  `mes3_dia_26` varchar(8) DEFAULT NULL,
  `mes3_dia_27` varchar(8) DEFAULT NULL,
  `mes3_dia_28` varchar(8) DEFAULT NULL,
  `mes3_dia_29` varchar(8) DEFAULT NULL,
  `mes3_dia_30` varchar(8) DEFAULT NULL,
  `mes3_dia_31` varchar(8) DEFAULT NULL,
  `mes4_dia_1` varchar(8) DEFAULT NULL,
  `mes4_dia_2` varchar(8) DEFAULT NULL,
  `mes4_dia_3` varchar(8) DEFAULT NULL,
  `mes4_dia_4` varchar(8) DEFAULT NULL,
  `mes4_dia_5` varchar(8) DEFAULT NULL,
  `mes4_dia_6` varchar(8) DEFAULT NULL,
  `mes4_dia_7` varchar(8) DEFAULT NULL,
  `mes4_dia_8` varchar(8) DEFAULT NULL,
  `mes4_dia_9` varchar(8) DEFAULT NULL,
  `mes4_dia_10` varchar(8) DEFAULT NULL,
  `mes4_dia_11` varchar(8) DEFAULT NULL,
  `mes4_dia_12` varchar(8) DEFAULT NULL,
  `mes4_dia_13` varchar(8) DEFAULT NULL,
  `mes4_dia_14` varchar(8) DEFAULT NULL,
  `mes4_dia_15` varchar(8) DEFAULT NULL,
  `mes4_dia_16` varchar(8) DEFAULT NULL,
  `mes4_dia_17` varchar(8) DEFAULT NULL,
  `mes4_dia_18` varchar(8) DEFAULT NULL,
  `mes4_dia_19` varchar(8) DEFAULT NULL,
  `mes4_dia_20` varchar(8) DEFAULT NULL,
  `mes4_dia_21` varchar(8) DEFAULT NULL,
  `mes4_dia_22` varchar(8) DEFAULT NULL,
  `mes4_dia_23` varchar(8) DEFAULT NULL,
  `mes4_dia_24` varchar(8) DEFAULT NULL,
  `mes4_dia_25` varchar(8) DEFAULT NULL,
  `mes4_dia_26` varchar(8) DEFAULT NULL,
  `mes4_dia_27` varchar(8) DEFAULT NULL,
  `mes4_dia_28` varchar(8) DEFAULT NULL,
  `mes4_dia_29` varchar(8) DEFAULT NULL,
  `mes4_dia_30` varchar(8) DEFAULT NULL,
  `mes4_dia_31` varchar(8) DEFAULT NULL,
  `mes5_dia_1` varchar(8) DEFAULT NULL,
  `mes5_dia_2` varchar(8) DEFAULT NULL,
  `mes5_dia_3` varchar(8) DEFAULT NULL,
  `mes5_dia_4` varchar(8) DEFAULT NULL,
  `mes5_dia_5` varchar(8) DEFAULT NULL,
  `mes5_dia_6` varchar(8) DEFAULT NULL,
  `mes5_dia_7` varchar(8) DEFAULT NULL,
  `mes5_dia_8` varchar(8) DEFAULT NULL,
  `mes5_dia_9` varchar(8) DEFAULT NULL,
  `mes5_dia_10` varchar(8) DEFAULT NULL,
  `mes5_dia_11` varchar(8) DEFAULT NULL,
  `mes5_dia_12` varchar(8) DEFAULT NULL,
  `mes5_dia_13` varchar(8) DEFAULT NULL,
  `mes5_dia_14` varchar(8) DEFAULT NULL,
  `mes5_dia_15` varchar(8) DEFAULT NULL,
  `mes5_dia_16` varchar(8) DEFAULT NULL,
  `mes5_dia_17` varchar(8) DEFAULT NULL,
  `mes5_dia_18` varchar(8) DEFAULT NULL,
  `mes5_dia_19` varchar(8) DEFAULT NULL,
  `mes5_dia_20` varchar(8) DEFAULT NULL,
  `mes5_dia_21` varchar(8) DEFAULT NULL,
  `mes5_dia_22` varchar(8) DEFAULT NULL,
  `mes5_dia_23` varchar(8) DEFAULT NULL,
  `mes5_dia_24` varchar(8) DEFAULT NULL,
  `mes5_dia_25` varchar(8) DEFAULT NULL,
  `mes5_dia_26` varchar(8) DEFAULT NULL,
  `mes5_dia_27` varchar(8) DEFAULT NULL,
  `mes5_dia_28` varchar(8) DEFAULT NULL,
  `mes5_dia_29` varchar(8) DEFAULT NULL,
  `mes5_dia_30` varchar(8) DEFAULT NULL,
  `mes5_dia_31` varchar(8) DEFAULT NULL,
  `mes6_dia_1` varchar(8) DEFAULT NULL,
  `mes6_dia_2` varchar(8) DEFAULT NULL,
  `mes6_dia_3` varchar(8) DEFAULT NULL,
  `mes6_dia_4` varchar(8) DEFAULT NULL,
  `mes6_dia_5` varchar(8) DEFAULT NULL,
  `mes6_dia_6` varchar(8) DEFAULT NULL,
  `mes6_dia_7` varchar(8) DEFAULT NULL,
  `mes6_dia_8` varchar(8) DEFAULT NULL,
  `mes6_dia_9` varchar(8) DEFAULT NULL,
  `mes6_dia_10` varchar(8) DEFAULT NULL,
  `mes6_dia_11` varchar(8) DEFAULT NULL,
  `mes6_dia_12` varchar(8) DEFAULT NULL,
  `mes6_dia_13` varchar(8) DEFAULT NULL,
  `mes6_dia_14` varchar(8) DEFAULT NULL,
  `mes6_dia_15` varchar(8) DEFAULT NULL,
  `mes6_dia_16` varchar(8) DEFAULT NULL,
  `mes6_dia_17` varchar(8) DEFAULT NULL,
  `mes6_dia_18` varchar(8) DEFAULT NULL,
  `mes6_dia_19` varchar(8) DEFAULT NULL,
  `mes6_dia_20` varchar(8) DEFAULT NULL,
  `mes6_dia_21` varchar(8) DEFAULT NULL,
  `mes6_dia_22` varchar(8) DEFAULT NULL,
  `mes6_dia_23` varchar(8) DEFAULT NULL,
  `mes6_dia_24` varchar(8) DEFAULT NULL,
  `mes6_dia_25` varchar(8) DEFAULT NULL,
  `mes6_dia_26` varchar(8) DEFAULT NULL,
  `mes6_dia_27` varchar(8) DEFAULT NULL,
  `mes6_dia_28` varchar(8) DEFAULT NULL,
  `mes6_dia_29` varchar(8) DEFAULT NULL,
  `mes6_dia_30` varchar(8) DEFAULT NULL,
  `mes6_dia_31` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `transportadoras2`
--

INSERT INTO `transportadoras2` (`id`, `sigla`, `nome`, `mes1_dia_1`, `mes1_dia_2`, `mes1_dia_3`, `mes1_dia_4`, `mes1_dia_5`, `mes1_dia_6`, `mes1_dia_7`, `mes1_dia_8`, `mes1_dia_9`, `mes1_dia_10`, `mes1_dia_11`, `mes1_dia_12`, `mes1_dia_13`, `mes1_dia_14`, `mes1_dia_15`, `mes1_dia_16`, `mes1_dia_17`, `mes1_dia_18`, `mes1_dia_19`, `mes1_dia_20`, `mes1_dia_21`, `mes1_dia_22`, `mes1_dia_23`, `mes1_dia_24`, `mes1_dia_25`, `mes1_dia_26`, `mes1_dia_27`, `mes1_dia_28`, `mes1_dia_29`, `mes1_dia_30`, `mes1_dia_31`, `mes2_dia_1`, `mes2_dia_2`, `mes2_dia_3`, `mes2_dia_4`, `mes2_dia_5`, `mes2_dia_6`, `mes2_dia_7`, `mes2_dia_8`, `mes2_dia_9`, `mes2_dia_10`, `mes2_dia_11`, `mes2_dia_12`, `mes2_dia_13`, `mes2_dia_14`, `mes2_dia_15`, `mes2_dia_16`, `mes2_dia_17`, `mes2_dia_18`, `mes2_dia_19`, `mes2_dia_20`, `mes2_dia_21`, `mes2_dia_22`, `mes2_dia_23`, `mes2_dia_24`, `mes2_dia_25`, `mes2_dia_26`, `mes2_dia_27`, `mes2_dia_28`, `mes2_dia_29`, `mes2_dia_30`, `mes2_dia_31`, `mes3_dia_1`, `mes3_dia_2`, `mes3_dia_3`, `mes3_dia_4`, `mes3_dia_5`, `mes3_dia_6`, `mes3_dia_7`, `mes3_dia_8`, `mes3_dia_9`, `mes3_dia_10`, `mes3_dia_11`, `mes3_dia_12`, `mes3_dia_13`, `mes3_dia_14`, `mes3_dia_15`, `mes3_dia_16`, `mes3_dia_17`, `mes3_dia_18`, `mes3_dia_19`, `mes3_dia_20`, `mes3_dia_21`, `mes3_dia_22`, `mes3_dia_23`, `mes3_dia_24`, `mes3_dia_25`, `mes3_dia_26`, `mes3_dia_27`, `mes3_dia_28`, `mes3_dia_29`, `mes3_dia_30`, `mes3_dia_31`, `mes4_dia_1`, `mes4_dia_2`, `mes4_dia_3`, `mes4_dia_4`, `mes4_dia_5`, `mes4_dia_6`, `mes4_dia_7`, `mes4_dia_8`, `mes4_dia_9`, `mes4_dia_10`, `mes4_dia_11`, `mes4_dia_12`, `mes4_dia_13`, `mes4_dia_14`, `mes4_dia_15`, `mes4_dia_16`, `mes4_dia_17`, `mes4_dia_18`, `mes4_dia_19`, `mes4_dia_20`, `mes4_dia_21`, `mes4_dia_22`, `mes4_dia_23`, `mes4_dia_24`, `mes4_dia_25`, `mes4_dia_26`, `mes4_dia_27`, `mes4_dia_28`, `mes4_dia_29`, `mes4_dia_30`, `mes4_dia_31`, `mes5_dia_1`, `mes5_dia_2`, `mes5_dia_3`, `mes5_dia_4`, `mes5_dia_5`, `mes5_dia_6`, `mes5_dia_7`, `mes5_dia_8`, `mes5_dia_9`, `mes5_dia_10`, `mes5_dia_11`, `mes5_dia_12`, `mes5_dia_13`, `mes5_dia_14`, `mes5_dia_15`, `mes5_dia_16`, `mes5_dia_17`, `mes5_dia_18`, `mes5_dia_19`, `mes5_dia_20`, `mes5_dia_21`, `mes5_dia_22`, `mes5_dia_23`, `mes5_dia_24`, `mes5_dia_25`, `mes5_dia_26`, `mes5_dia_27`, `mes5_dia_28`, `mes5_dia_29`, `mes5_dia_30`, `mes5_dia_31`, `mes6_dia_1`, `mes6_dia_2`, `mes6_dia_3`, `mes6_dia_4`, `mes6_dia_5`, `mes6_dia_6`, `mes6_dia_7`, `mes6_dia_8`, `mes6_dia_9`, `mes6_dia_10`, `mes6_dia_11`, `mes6_dia_12`, `mes6_dia_13`, `mes6_dia_14`, `mes6_dia_15`, `mes6_dia_16`, `mes6_dia_17`, `mes6_dia_18`, `mes6_dia_19`, `mes6_dia_20`, `mes6_dia_21`, `mes6_dia_22`, `mes6_dia_23`, `mes6_dia_24`, `mes6_dia_25`, `mes6_dia_26`, `mes6_dia_27`, `mes6_dia_28`, `mes6_dia_29`, `mes6_dia_30`, `mes6_dia_31`) VALUES
(1, 'BVC', 'BVC TRANSPORTES LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'LL', 'L L TRANSPORTES LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'D Paula', 'DE PAULA TRANSPORTADORA LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'Tora', 'TORA TRANSPORTES LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, 'Silvano', 'SILVANO SANTOS DA ROCHA EIRELI', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(6, 'Terra Minas', 'TERRA MINAS TERRAPLENAGEM MATIAS BA LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(7, 'Vitran', 'VITRAN TRANSPORTES LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(8, 'Cooperauto', 'COOPERATIVA DE CONSUMO TRANSPORTE R ODOVIARIO E LOCACAO LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(9, 'Cotracargem', 'COOPERATIVA MISTA DE TRANSPORTE DE CARGA PASSAGEIROS E CONSUMO DO ESTA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(10, 'TSL', 'TRANSPORTES SARZEDO LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(11, 'RLR', 'RLR TRANSPORTES LTDA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(12, 'Rodeiro', 'EMPREENDIMENTOS RODEIRO SA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(13, 'Rodoanel', 'RODOANEL TRANSPORTES E LOGISTICA LT DA', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(14, 'FJX', 'FJX TRANSPORTES LTDA ', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(15, 'FERTRAN', 'FERTRAN TRANSPORTES LTDA ', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transportadoras2`
--
ALTER TABLE `transportadoras2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transportadoras2`
--
ALTER TABLE `transportadoras2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
