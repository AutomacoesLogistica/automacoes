-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 21-Abr-2022 às 16:08
-- Versão do servidor: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_dashboard_dispositivos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Entrada_CO_01`
--

CREATE TABLE `Entrada_CO_01` (
  `id` int(11) NOT NULL,
  `ponto` varchar(20) NOT NULL,
  `condicao` varchar(20) NOT NULL,
  `dia` varchar(5) NOT NULL,
  `mes` varchar(5) NOT NULL,
  `ano` varchar(5) NOT NULL,
  `vdata` varchar(12) NOT NULL,
  `vhora` varchar(12) NOT NULL,
  `data_hora` varchar(22) NOT NULL,
  `epc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `Entrada_CO_01`
--

INSERT INTO `Entrada_CO_01` (`id`, `ponto`, `condicao`, `dia`, `mes`, `ano`, `vdata`, `vhora`, `data_hora`, `epc`) VALUES
(1, 'antena1', '5', '21', '04', '2022', '21/04/2022', '08:36:42', '21/04/2022 08:36:42', ''),
(2, 'antena0', '14', '21', '04', '2022', '21/04/2022', '08:36:46', '21/04/2022 08:36:46', ''),
(3, 'antena1', '7', '21', '04', '2022', '21/04/2022', '08:42:43', '21/04/2022 08:42:43', ''),
(4, 'antena0', '11', '21', '04', '2022', '21/04/2022', '08:42:52', '21/04/2022 08:42:52', ''),
(5, 'antena0', '12', '21', '04', '2022', '21/04/2022', '08:43:04', '21/04/2022 08:43:04', ''),
(6, 'antena0', '9', '21', '04', '2022', '21/04/2022', '08:43:06', '21/04/2022 08:43:06', ''),
(7, 'antena0', '5', '21', '04', '2022', '21/04/2022', '08:43:08', '21/04/2022 08:43:08', ''),
(8, 'antena0', '13', '21', '04', '2022', '21/04/2022', '08:43:34', '21/04/2022 08:43:34', ''),
(9, 'antena0', '5', '21', '04', '2022', '21/04/2022', '08:43:40', '21/04/2022 08:43:40', ''),
(10, 'antena0', '10', '21', '04', '2022', '21/04/2022', '08:55:27', '21/04/2022 08:55:27', ''),
(11, 'antena0', '14', '21', '04', '2022', '21/04/2022', '08:55:33', '21/04/2022 08:55:33', ''),
(12, 'antena0', '14', '21', '04', '2022', '21/04/2022', '08:55:54', '21/04/2022 08:55:54', ''),
(13, 'antena0', '13', '21', '04', '2022', '21/04/2022', '08:55:58', '21/04/2022 08:55:58', ''),
(14, 'antena0', '9', '21', '04', '2022', '21/04/2022', '08:56:33', '21/04/2022 08:56:33', ''),
(15, 'antena0', '11', '21', '04', '2022', '21/04/2022', '08:56:48', '21/04/2022 08:56:48', ''),
(16, 'antena0', '13', '21', '04', '2022', '21/04/2022', '08:57:43', '21/04/2022 08:57:43', ''),
(17, 'antena0', '7', '21', '04', '2022', '21/04/2022', '08:57:45', '21/04/2022 08:57:45', ''),
(18, 'antena0', '14', '21', '04', '2022', '21/04/2022', '08:58:06', '21/04/2022 08:58:06', ''),
(19, 'antena0', '13', '21', '04', '2022', '21/04/2022', '08:58:20', '21/04/2022 08:58:20', ''),
(20, 'antena0', '9', '21', '04', '2022', '21/04/2022', '08:59:20', '21/04/2022 08:59:20', ''),
(21, 'antena0', '13', '21', '04', '2022', '21/04/2022', '08:59:25', '21/04/2022 08:59:25', ''),
(22, 'antena0', '12', '21', '04', '2022', '21/04/2022', '09:00:00', '21/04/2022 09:00:00', ''),
(23, 'antena0', '8', '21', '04', '2022', '21/04/2022', '09:00:06', '21/04/2022 09:00:06', ''),
(24, 'antena0', '10', '21', '04', '2022', '21/04/2022', '09:02:27', '21/04/2022 09:02:27', ''),
(25, 'antena0', '9', '21', '04', '2022', '21/04/2022', '09:02:33', '21/04/2022 09:02:33', ''),
(26, 'antena0', '14', '21', '04', '2022', '21/04/2022', '09:05:53', '21/04/2022 09:05:53', ''),
(27, 'antena0', '5', '21', '04', '2022', '21/04/2022', '09:06:00', '21/04/2022 09:06:00', ''),
(28, 'antena0', '12', '21', '04', '2022', '21/04/2022', '09:08:02', '21/04/2022 09:08:02', ''),
(29, 'antena0', '8', '21', '04', '2022', '21/04/2022', '09:08:05', '21/04/2022 09:08:05', ''),
(30, 'antena0', '10', '21', '04', '2022', '21/04/2022', '09:11:48', '21/04/2022 09:11:48', ''),
(31, 'antena0', '10', '21', '04', '2022', '21/04/2022', '09:11:50', '21/04/2022 09:11:50', ''),
(32, 'antena0', '7', '21', '04', '2022', '21/04/2022', '09:17:11', '21/04/2022 09:17:11', ''),
(33, 'antena0', '10', '21', '04', '2022', '21/04/2022', '09:20:49', '21/04/2022 09:20:49', ''),
(34, 'antena0', '5', '21', '04', '2022', '21/04/2022', '09:20:51', '21/04/2022 09:20:51', ''),
(35, 'antena0', '12', '21', '04', '2022', '21/04/2022', '09:22:20', '21/04/2022 09:22:20', ''),
(36, 'antena0', '8', '21', '04', '2022', '21/04/2022', '09:22:30', '21/04/2022 09:22:30', ''),
(37, 'antena0', '8', '21', '04', '2022', '21/04/2022', '09:22:46', '21/04/2022 09:22:46', ''),
(38, 'antena0', '5', '21', '04', '2022', '21/04/2022', '09:23:15', '21/04/2022 09:23:15', ''),
(39, 'antena0', '13', '21', '04', '2022', '21/04/2022', '09:23:33', '21/04/2022 09:23:33', ''),
(40, 'antena0', '8', '21', '04', '2022', '21/04/2022', '09:23:42', '21/04/2022 09:23:42', ''),
(41, 'antena0', '6', '21', '04', '2022', '21/04/2022', '09:25:54', '21/04/2022 09:25:54', ''),
(42, 'antena0', '13', '21', '04', '2022', '21/04/2022', '09:26:03', '21/04/2022 09:26:03', ''),
(43, 'antena0', '12', '21', '04', '2022', '21/04/2022', '09:26:35', '21/04/2022 09:26:35', ''),
(44, 'antena0', '5', '21', '04', '2022', '21/04/2022', '09:26:37', '21/04/2022 09:26:37', ''),
(45, 'antena0', '7', '21', '04', '2022', '21/04/2022', '09:28:16', '21/04/2022 09:28:16', ''),
(46, 'antena0', '13', '21', '04', '2022', '21/04/2022', '09:28:24', '21/04/2022 09:28:24', ''),
(47, 'antena0', '9', '21', '04', '2022', '21/04/2022', '09:33:32', '21/04/2022 09:33:32', ''),
(48, 'antena0', '14', '21', '04', '2022', '21/04/2022', '09:33:35', '21/04/2022 09:33:35', ''),
(49, 'antena0', '6', '21', '04', '2022', '21/04/2022', '09:35:32', '21/04/2022 09:35:32', ''),
(50, 'antena0', '6', '21', '04', '2022', '21/04/2022', '09:35:34', '21/04/2022 09:35:34', ''),
(51, 'antena0', '8', '21', '04', '2022', '21/04/2022', '09:37:04', '21/04/2022 09:37:04', ''),
(52, 'antena0', '6', '21', '04', '2022', '21/04/2022', '09:37:08', '21/04/2022 09:37:08', ''),
(53, 'antena0', '13', '21', '04', '2022', '21/04/2022', '09:47:03', '21/04/2022 09:47:03', ''),
(54, 'antena0', '14', '21', '04', '2022', '21/04/2022', '09:47:13', '21/04/2022 09:47:13', ''),
(55, 'antena0', '13', '21', '04', '2022', '21/04/2022', '09:54:10', '21/04/2022 09:54:10', ''),
(56, 'antena0', '10', '21', '04', '2022', '21/04/2022', '09:54:24', '21/04/2022 09:54:24', ''),
(57, 'antena0', '6', '21', '04', '2022', '21/04/2022', '09:55:07', '21/04/2022 09:55:07', ''),
(58, 'antena0', '6', '21', '04', '2022', '21/04/2022', '09:55:09', '21/04/2022 09:55:09', ''),
(59, 'antena0', '5', '21', '04', '2022', '21/04/2022', '10:00:16', '21/04/2022 10:00:16', ''),
(60, 'antena0', '6', '21', '04', '2022', '21/04/2022', '10:00:24', '21/04/2022 10:00:24', ''),
(61, 'antena0', '9', '21', '04', '2022', '21/04/2022', '10:02:10', '21/04/2022 10:02:10', ''),
(62, 'antena0', '14', '21', '04', '2022', '21/04/2022', '10:02:24', '21/04/2022 10:02:24', ''),
(63, 'antena0', '9', '21', '04', '2022', '21/04/2022', '10:03:28', '21/04/2022 10:03:28', ''),
(64, 'antena1', '8', '21', '04', '2022', '21/04/2022', '10:03:36', '21/04/2022 10:03:36', ''),
(65, 'antena0', '8', '21', '04', '2022', '21/04/2022', '10:04:07', '21/04/2022 10:04:07', ''),
(66, 'antena0', '10', '21', '04', '2022', '21/04/2022', '10:04:29', '21/04/2022 10:04:29', ''),
(67, 'antena0', '12', '21', '04', '2022', '21/04/2022', '10:05:52', '21/04/2022 10:05:52', ''),
(68, 'antena0', '6', '21', '04', '2022', '21/04/2022', '10:05:59', '21/04/2022 10:05:59', ''),
(69, 'antena0', '10', '21', '04', '2022', '21/04/2022', '10:06:31', '21/04/2022 10:06:31', ''),
(70, 'antena0', '7', '21', '04', '2022', '21/04/2022', '10:06:36', '21/04/2022 10:06:36', ''),
(71, 'antena0', '11', '21', '04', '2022', '21/04/2022', '10:13:43', '21/04/2022 10:13:43', ''),
(72, 'antena0', '8', '21', '04', '2022', '21/04/2022', '10:13:56', '21/04/2022 10:13:56', ''),
(73, 'antena0', '5', '21', '04', '2022', '21/04/2022', '10:17:23', '21/04/2022 10:17:23', ''),
(74, 'antena0', '5', '21', '04', '2022', '21/04/2022', '10:17:26', '21/04/2022 10:17:26', ''),
(75, 'antena0', '6', '21', '04', '2022', '21/04/2022', '10:24:37', '21/04/2022 10:24:37', ''),
(76, 'antena0', '9', '21', '04', '2022', '21/04/2022', '10:24:42', '21/04/2022 10:24:42', ''),
(77, 'antena0', '14', '21', '04', '2022', '21/04/2022', '10:27:55', '21/04/2022 10:27:55', ''),
(78, 'antena0', '9', '21', '04', '2022', '21/04/2022', '10:28:03', '21/04/2022 10:28:03', ''),
(79, 'antena0', '9', '21', '04', '2022', '21/04/2022', '10:28:14', '21/04/2022 10:28:14', ''),
(80, 'antena0', '12', '21', '04', '2022', '21/04/2022', '10:28:17', '21/04/2022 10:28:17', ''),
(81, 'antena0', '9', '21', '04', '2022', '21/04/2022', '10:30:18', '21/04/2022 10:30:18', ''),
(82, 'antena0', '14', '21', '04', '2022', '21/04/2022', '10:30:28', '21/04/2022 10:30:28', ''),
(83, 'antena0', '7', '21', '04', '2022', '21/04/2022', '10:42:34', '21/04/2022 10:42:34', ''),
(84, 'antena0', '11', '21', '04', '2022', '21/04/2022', '10:42:39', '21/04/2022 10:42:39', ''),
(85, 'antena0', '9', '21', '04', '2022', '21/04/2022', '10:44:50', '21/04/2022 10:44:50', ''),
(86, 'antena0', '8', '21', '04', '2022', '21/04/2022', '10:45:08', '21/04/2022 10:45:08', ''),
(87, 'antena0', '10', '21', '04', '2022', '21/04/2022', '11:04:05', '21/04/2022 11:04:05', ''),
(88, 'antena0', '8', '21', '04', '2022', '21/04/2022', '11:04:10', '21/04/2022 11:04:10', ''),
(89, 'antena0', '9', '21', '04', '2022', '21/04/2022', '11:05:26', '21/04/2022 11:05:26', ''),
(90, 'antena0', '14', '21', '04', '2022', '21/04/2022', '11:05:34', '21/04/2022 11:05:34', ''),
(91, 'antena1', '5', '21', '04', '2022', '21/04/2022', '11:08:09', '21/04/2022 11:08:09', ''),
(92, 'antena0', '13', '21', '04', '2022', '21/04/2022', '11:08:19', '21/04/2022 11:08:19', ''),
(93, 'antena0', '12', '21', '04', '2022', '21/04/2022', '11:08:21', '21/04/2022 11:08:21', ''),
(94, 'antena0', '14', '21', '04', '2022', '21/04/2022', '11:10:13', '21/04/2022 11:10:13', ''),
(95, 'antena0', '9', '21', '04', '2022', '21/04/2022', '11:10:23', '21/04/2022 11:10:23', ''),
(96, 'antena1', '6', '21', '04', '2022', '21/04/2022', '11:18:39', '21/04/2022 11:18:39', ''),
(97, 'antena0', '14', '21', '04', '2022', '21/04/2022', '11:18:46', '21/04/2022 11:18:46', ''),
(98, 'antena0', '7', '21', '04', '2022', '21/04/2022', '11:18:51', '21/04/2022 11:18:51', ''),
(99, 'antena0', '10', '21', '04', '2022', '21/04/2022', '11:33:12', '21/04/2022 11:33:12', ''),
(100, 'antena0', '5', '21', '04', '2022', '21/04/2022', '11:33:26', '21/04/2022 11:33:26', ''),
(101, 'antena0', '13', '21', '04', '2022', '21/04/2022', '11:35:38', '21/04/2022 11:35:38', ''),
(102, 'antena0', '6', '21', '04', '2022', '21/04/2022', '11:35:48', '21/04/2022 11:35:48', ''),
(103, 'antena0', '9', '21', '04', '2022', '21/04/2022', '11:37:17', '21/04/2022 11:37:17', ''),
(104, 'antena0', '8', '21', '04', '2022', '21/04/2022', '11:37:21', '21/04/2022 11:37:21', ''),
(105, 'antena0', '13', '21', '04', '2022', '21/04/2022', '11:43:33', '21/04/2022 11:43:33', ''),
(106, 'antena0', '15', '21', '04', '2022', '21/04/2022', '11:43:46', '21/04/2022 11:43:46', ''),
(107, 'antena0', '12', '21', '04', '2022', '21/04/2022', '11:48:06', '21/04/2022 11:48:06', ''),
(108, 'antena0', '7', '21', '04', '2022', '21/04/2022', '11:48:10', '21/04/2022 11:48:10', ''),
(109, 'antena0', '14', '21', '04', '2022', '21/04/2022', '11:50:22', '21/04/2022 11:50:22', ''),
(110, 'antena0', '9', '21', '04', '2022', '21/04/2022', '11:50:26', '21/04/2022 11:50:26', ''),
(111, 'antena0', '7', '21', '04', '2022', '21/04/2022', '11:52:55', '21/04/2022 11:52:55', ''),
(112, 'antena0', '10', '21', '04', '2022', '21/04/2022', '11:53:04', '21/04/2022 11:53:04', ''),
(113, 'antena0', '5', '21', '04', '2022', '21/04/2022', '11:56:43', '21/04/2022 11:56:43', ''),
(114, 'antena0', '7', '21', '04', '2022', '21/04/2022', '11:56:47', '21/04/2022 11:56:47', ''),
(115, 'antena0', '7', '21', '04', '2022', '21/04/2022', '11:59:12', '21/04/2022 11:59:12', ''),
(116, 'antena0', '9', '21', '04', '2022', '21/04/2022', '11:59:27', '21/04/2022 11:59:27', ''),
(117, 'antena0', '12', '21', '04', '2022', '21/04/2022', '12:08:20', '21/04/2022 12:08:20', ''),
(118, 'antena0', '10', '21', '04', '2022', '21/04/2022', '12:08:28', '21/04/2022 12:08:28', ''),
(119, 'antena0', '7', '21', '04', '2022', '21/04/2022', '12:12:54', '21/04/2022 12:12:54', ''),
(120, 'antena0', '7', '21', '04', '2022', '21/04/2022', '12:13:01', '21/04/2022 12:13:01', ''),
(121, 'antena0', '14', '21', '04', '2022', '21/04/2022', '12:17:18', '21/04/2022 12:17:18', ''),
(122, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:17:24', '21/04/2022 12:17:24', ''),
(123, 'antena0', '9', '21', '04', '2022', '21/04/2022', '12:20:08', '21/04/2022 12:20:08', ''),
(124, 'antena0', '8', '21', '04', '2022', '21/04/2022', '12:20:13', '21/04/2022 12:20:13', ''),
(125, 'antena0', '8', '21', '04', '2022', '21/04/2022', '12:25:10', '21/04/2022 12:25:10', ''),
(126, 'antena0', '5', '21', '04', '2022', '21/04/2022', '12:25:18', '21/04/2022 12:25:18', ''),
(127, 'antena0', '13', '21', '04', '2022', '21/04/2022', '12:36:12', '21/04/2022 12:36:12', ''),
(128, 'antena0', '5', '21', '04', '2022', '21/04/2022', '12:36:15', '21/04/2022 12:36:15', ''),
(129, 'antena0', '15', '21', '04', '2022', '21/04/2022', '12:37:27', '21/04/2022 12:37:27', ''),
(130, 'antena0', '9', '21', '04', '2022', '21/04/2022', '12:37:36', '21/04/2022 12:37:36', ''),
(131, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:38:29', '21/04/2022 12:38:29', ''),
(132, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:38:35', '21/04/2022 12:38:35', ''),
(133, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:39:36', '21/04/2022 12:39:36', ''),
(134, 'antena0', '9', '21', '04', '2022', '21/04/2022', '12:39:52', '21/04/2022 12:39:52', ''),
(135, 'antena0', '5', '21', '04', '2022', '21/04/2022', '12:43:15', '21/04/2022 12:43:15', ''),
(136, 'antena0', '6', '21', '04', '2022', '21/04/2022', '12:43:28', '21/04/2022 12:43:28', ''),
(137, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:47:23', '21/04/2022 12:47:23', ''),
(138, 'antena0', '13', '21', '04', '2022', '21/04/2022', '12:47:43', '21/04/2022 12:47:43', ''),
(139, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:47:55', '21/04/2022 12:47:55', ''),
(140, 'antena0', '12', '21', '04', '2022', '21/04/2022', '12:48:08', '21/04/2022 12:48:08', ''),
(141, 'antena1', '6', '21', '04', '2022', '21/04/2022', '12:48:17', '21/04/2022 12:48:17', ''),
(142, 'antena0', '10', '21', '04', '2022', '21/04/2022', '12:48:26', '21/04/2022 12:48:26', ''),
(143, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:48:33', '21/04/2022 12:48:33', ''),
(144, 'antena0', '15', '21', '04', '2022', '21/04/2022', '12:48:39', '21/04/2022 12:48:39', ''),
(145, 'antena0', '6', '21', '04', '2022', '21/04/2022', '12:50:40', '21/04/2022 12:50:40', ''),
(146, 'antena0', '6', '21', '04', '2022', '21/04/2022', '12:50:48', '21/04/2022 12:50:48', ''),
(147, 'antena0', '9', '21', '04', '2022', '21/04/2022', '12:58:07', '21/04/2022 12:58:07', ''),
(148, 'antena0', '10', '21', '04', '2022', '21/04/2022', '12:58:14', '21/04/2022 12:58:14', ''),
(149, 'antena0', '6', '21', '04', '2022', '21/04/2022', '12:58:26', '21/04/2022 12:58:26', ''),
(150, 'antena0', '11', '21', '04', '2022', '21/04/2022', '12:58:32', '21/04/2022 12:58:32', ''),
(151, 'antena0', '10', '21', '04', '2022', '21/04/2022', '13:05:47', '21/04/2022 13:05:47', ''),
(152, 'antena0', '13', '21', '04', '2022', '21/04/2022', '13:06:02', '21/04/2022 13:06:02', ''),
(153, 'antena0', '5', '21', '04', '2022', '21/04/2022', '13:13:50', '21/04/2022 13:13:50', ''),
(154, 'antena0', '6', '21', '04', '2022', '21/04/2022', '13:13:57', '21/04/2022 13:13:57', ''),
(155, 'antena0', '13', '21', '04', '2022', '21/04/2022', '13:14:15', '21/04/2022 13:14:15', ''),
(156, 'antena0', '10', '21', '04', '2022', '21/04/2022', '13:14:23', '21/04/2022 13:14:23', ''),
(157, 'antena0', '12', '21', '04', '2022', '21/04/2022', '13:20:42', '21/04/2022 13:20:42', ''),
(158, 'antena0', '8', '21', '04', '2022', '21/04/2022', '13:20:46', '21/04/2022 13:20:46', ''),
(159, 'antena0', '9', '21', '04', '2022', '21/04/2022', '13:21:53', '21/04/2022 13:21:53', ''),
(160, 'antena0', '10', '21', '04', '2022', '21/04/2022', '13:22:09', '21/04/2022 13:22:09', ''),
(161, 'antena0', '7', '21', '04', '2022', '21/04/2022', '13:22:22', '21/04/2022 13:22:22', ''),
(162, 'antena0', '12', '21', '04', '2022', '21/04/2022', '13:22:46', '21/04/2022 13:22:46', ''),
(163, 'antena0', '12', '21', '04', '2022', '21/04/2022', '13:22:58', '21/04/2022 13:22:58', ''),
(164, 'antena1', '7', '21', '04', '2022', '21/04/2022', '13:23:04', '21/04/2022 13:23:04', ''),
(165, 'antena0', '8', '21', '04', '2022', '21/04/2022', '13:23:09', '21/04/2022 13:23:09', ''),
(166, 'antena0', '10', '21', '04', '2022', '21/04/2022', '13:24:24', '21/04/2022 13:24:24', ''),
(167, 'antena0', '13', '21', '04', '2022', '21/04/2022', '13:25:43', '21/04/2022 13:25:43', ''),
(168, 'antena0', '6', '21', '04', '2022', '21/04/2022', '13:30:27', '21/04/2022 13:30:27', ''),
(169, 'antena0', '11', '21', '04', '2022', '21/04/2022', '13:30:31', '21/04/2022 13:30:31', ''),
(170, 'antena0', '13', '21', '04', '2022', '21/04/2022', '13:47:37', '21/04/2022 13:47:37', ''),
(171, 'antena0', '7', '21', '04', '2022', '21/04/2022', '13:47:40', '21/04/2022 13:47:40', ''),
(172, 'antena0', '13', '21', '04', '2022', '21/04/2022', '14:08:16', '21/04/2022 14:08:16', '442001000000000000001779'),
(173, 'antena0', '6', '21', '04', '2022', '21/04/2022', '14:08:21', '21/04/2022 14:08:21', '442002000000000000001315'),
(174, 'antena0', '13', '21', '04', '2022', '21/04/2022', '14:10:33', '21/04/2022 14:10:33', '442001000000000000002109'),
(175, 'antena0', '8', '21', '04', '2022', '21/04/2022', '14:10:37', '21/04/2022 14:10:37', '442002000000000000001427'),
(176, 'antena0', '9', '21', '04', '2022', '21/04/2022', '14:11:32', '21/04/2022 14:11:32', '442001000000000000002867'),
(177, 'antena0', '15', '21', '04', '2022', '21/04/2022', '14:11:47', '21/04/2022 14:11:47', '442002000000000000001437'),
(178, 'antena0', '6', '21', '04', '2022', '21/04/2022', '14:14:10', '21/04/2022 14:14:10', '442001000000000000002828'),
(179, 'antena0', '12', '21', '04', '2022', '21/04/2022', '14:14:21', '21/04/2022 14:14:21', '442002000000000000001431'),
(180, 'antena0', '15', '21', '04', '2022', '21/04/2022', '14:19:02', '21/04/2022 14:19:02', '442001000000000000002885'),
(181, 'antena0', '5', '21', '04', '2022', '21/04/2022', '14:19:11', '21/04/2022 14:19:11', '442002000000000000001744'),
(182, 'antena0', '12', '21', '04', '2022', '21/04/2022', '14:21:50', '21/04/2022 14:21:50', '442001000000000000002018'),
(183, 'antena0', '14', '21', '04', '2022', '21/04/2022', '14:21:54', '21/04/2022 14:21:54', '442002000000000000001490'),
(184, 'antena0', '10', '21', '04', '2022', '21/04/2022', '14:37:02', '21/04/2022 14:37:02', '442001000000000000001361'),
(185, 'antena0', '6', '21', '04', '2022', '21/04/2022', '14:37:08', '21/04/2022 14:37:08', '442002000000000000001473'),
(186, 'antena0', '13', '21', '04', '2022', '21/04/2022', '14:48:46', '21/04/2022 14:48:46', '442001000000000000002857'),
(187, 'antena0', '13', '21', '04', '2022', '21/04/2022', '14:48:54', '21/04/2022 14:48:54', '442002000000000000001285'),
(188, 'antena0', '14', '21', '04', '2022', '21/04/2022', '14:49:09', '21/04/2022 14:49:09', '442001000000000000002826'),
(189, 'antena0', '7', '21', '04', '2022', '21/04/2022', '14:49:25', '21/04/2022 14:49:25', '442002000000000000001733'),
(190, 'antena0', '11', '21', '04', '2022', '21/04/2022', '14:54:03', '21/04/2022 14:54:03', '442001000000000000002864'),
(191, 'antena0', '14', '21', '04', '2022', '21/04/2022', '14:54:08', '21/04/2022 14:54:08', '442002000000000000001613'),
(192, 'antena0', '12', '21', '04', '2022', '21/04/2022', '14:55:21', '21/04/2022 14:55:21', '442001000000000000003037'),
(193, 'antena0', '13', '21', '04', '2022', '21/04/2022', '14:55:30', '21/04/2022 14:55:30', '442002000000000000001379'),
(194, 'antena0', '5', '21', '04', '2022', '21/04/2022', '14:56:34', '21/04/2022 14:56:34', '442001000000000000002831'),
(195, 'antena0', '13', '21', '04', '2022', '21/04/2022', '14:56:37', '21/04/2022 14:56:37', '442002000000000000001455'),
(196, 'antena0', '7', '21', '04', '2022', '21/04/2022', '14:57:12', '21/04/2022 14:57:12', '442001000000000000002180'),
(197, 'antena0', '10', '21', '04', '2022', '21/04/2022', '14:57:18', '21/04/2022 14:57:18', '442002000000000000001046'),
(198, 'antena0', '9', '21', '04', '2022', '21/04/2022', '15:15:35', '21/04/2022 15:15:35', '442001000000000000001796'),
(199, 'antena0', '7', '21', '04', '2022', '21/04/2022', '15:15:41', '21/04/2022 15:15:41', '442002000000000000001681'),
(200, 'antena0', '15', '21', '04', '2022', '21/04/2022', '15:18:17', '21/04/2022 15:18:17', '442001000000000000002834'),
(201, 'antena0', '8', '21', '04', '2022', '21/04/2022', '15:18:27', '21/04/2022 15:18:27', '442002000000000000001220'),
(202, 'antena0', '5', '21', '04', '2022', '21/04/2022', '15:19:00', '21/04/2022 15:19:00', '442001000000000000002873'),
(203, 'antena0', '11', '21', '04', '2022', '21/04/2022', '15:19:07', '21/04/2022 15:19:07', '442002000000000000001419'),
(204, 'antena0', '12', '21', '04', '2022', '21/04/2022', '15:24:31', '21/04/2022 15:24:31', '442001000000000000002836'),
(205, 'antena0', '7', '21', '04', '2022', '21/04/2022', '15:24:53', '21/04/2022 15:24:53', '442002000000000000001690'),
(206, 'antena0', '15', '21', '04', '2022', '21/04/2022', '15:31:01', '21/04/2022 15:31:01', '442001000000000000002843'),
(207, 'antena0', '8', '21', '04', '2022', '21/04/2022', '15:31:30', '21/04/2022 15:31:30', '442002000000000000001377'),
(208, 'antena0', '11', '21', '04', '2022', '21/04/2022', '15:37:54', '21/04/2022 15:37:54', '442001000000000000002829'),
(209, 'antena0', '7', '21', '04', '2022', '21/04/2022', '15:38:00', '21/04/2022 15:38:00', '442002000000000000001281'),
(210, 'antena0', '11', '21', '04', '2022', '21/04/2022', '15:51:00', '21/04/2022 15:51:00', '442001000000000000000344'),
(211, 'antena0', '5', '21', '04', '2022', '21/04/2022', '15:51:05', '21/04/2022 15:51:05', '442002000000000000001297'),
(212, 'antena0', '15', '21', '04', '2022', '21/04/2022', '15:54:14', '21/04/2022 15:54:14', '442001000000000000002838'),
(213, 'antena0', '6', '21', '04', '2022', '21/04/2022', '15:54:16', '21/04/2022 15:54:16', '442002000000000000001703'),
(214, 'antena0', '7', '21', '04', '2022', '21/04/2022', '15:57:20', '21/04/2022 15:57:20', '442001000000000000001147'),
(215, 'antena0', '11', '21', '04', '2022', '21/04/2022', '15:57:23', '21/04/2022 15:57:23', '442002000000000000001309'),
(216, 'antena0', '13', '21', '04', '2022', '21/04/2022', '16:06:19', '21/04/2022 16:06:19', '442001000000000000002661'),
(217, 'antena0', '12', '21', '04', '2022', '21/04/2022', '16:06:31', '21/04/2022 16:06:31', '442002000000000000001409'),
(218, 'antena0', '13', '21', '04', '2022', '21/04/2022', '16:08:38', '21/04/2022 16:08:38', '442001000000000000002586'),
(219, 'antena0', '12', '21', '04', '2022', '21/04/2022', '16:08:45', '21/04/2022 16:08:45', '442002000000000000001403');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Entrada_CO_01`
--
ALTER TABLE `Entrada_CO_01`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Entrada_CO_01`
--
ALTER TABLE `Entrada_CO_01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;