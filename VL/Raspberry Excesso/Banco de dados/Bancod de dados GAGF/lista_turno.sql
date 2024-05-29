-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 27/10/2022 às 13:10
-- Versão do servidor: 10.3.27-MariaDB-0+deb10u1
-- Versão do PHP: 7.3.27-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_gagf`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_turno`
--

CREATE TABLE `lista_turno` (
  `id` int(11) NOT NULL,
  `data` varchar(10) NOT NULL,
  `turno1` varchar(2) NOT NULL,
  `turno2` varchar(2) NOT NULL,
  `turno3` varchar(2) NOT NULL,
  `folga` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `lista_turno`
--

INSERT INTO `lista_turno` (`id`, `data`, `turno1`, `turno2`, `turno3`, `folga`) VALUES
(1, '01/01/2022', 'B', 'A', 'C', 'D'),
(2, '02/01/2022', 'B', 'A', 'C', 'D'),
(3, '03/01/2022', 'B', 'A', 'D', 'C'),
(4, '04/01/2022', 'C', 'B', 'D', 'A'),
(5, '05/01/2022', 'C', 'B', 'A', 'D'),
(6, '06/01/2022', 'D', 'C', 'A', 'B'),
(7, '07/01/2022', 'D', 'C', 'B', 'A'),
(8, '08/01/2022', 'A', 'D', 'B', 'C'),
(9, '09/01/2022', 'A', 'D', 'B', 'C'),
(10, '10/01/2022', 'A', 'D', 'C', 'B'),
(11, '11/01/2022', 'B', 'A', 'C', 'D'),
(12, '12/01/2022', 'B', 'A', 'D', 'C'),
(13, '13/01/2022', 'C', 'B', 'D', 'A'),
(14, '14/01/2022', 'C', 'B', 'A', 'D'),
(15, '15/01/2022', 'D', 'C', 'A', 'B'),
(16, '16/01/2022', 'D', 'C', 'A', 'B'),
(17, '17/01/2022', 'D', 'C', 'B', 'A'),
(18, '18/01/2022', 'A', 'D', 'B', 'C'),
(19, '19/01/2022', 'A', 'D', 'C', 'B'),
(20, '20/01/2022', 'B', 'A', 'C', 'D'),
(21, '21/01/2022', 'B', 'A', 'D', 'C'),
(22, '22/01/2022', 'C', 'B', 'D', 'A'),
(23, '23/01/2022', 'C', 'B', 'D', 'A'),
(24, '24/01/2022', 'C', 'B', 'A', 'D'),
(25, '25/01/2022', 'D', 'C', 'A', 'B'),
(26, '26/01/2022', 'D', 'C', 'B', 'A'),
(27, '27/01/2022', 'A', 'D', 'B', 'C'),
(28, '28/01/2022', 'A', 'D', 'C', 'B'),
(29, '29/01/2022', 'B', 'A', 'C', 'D'),
(30, '30/01/2022', 'B', 'A', 'C', 'D'),
(31, '31/01/2022', 'B', 'A', 'D', 'C'),
(32, '01/02/2022', 'C', 'B', 'D', 'A'),
(33, '02/02/2022', 'C', 'B', 'A', 'D'),
(34, '03/02/2022', 'D', 'C', 'A', 'B'),
(35, '04/02/2022', 'D', 'C', 'B', 'A'),
(36, '05/02/2022', 'A', 'D', 'B', 'C'),
(37, '06/02/2022', 'A', 'D', 'B', 'C'),
(38, '07/02/2022', 'A', 'D', 'C', 'B'),
(39, '08/02/2022', 'B', 'A', 'C', 'D'),
(40, '09/02/2022', 'B', 'A', 'D', 'C'),
(41, '10/02/2022', 'C', 'B', 'D', 'A'),
(42, '11/02/2022', 'C', 'B', 'A', 'D'),
(43, '12/02/2022', 'D', 'C', 'A', 'B'),
(44, '13/02/2022', 'D', 'C', 'A', 'B'),
(45, '14/02/2022', 'D', 'C', 'B', 'A'),
(46, '15/02/2022', 'A', 'D', 'B', 'C'),
(47, '16/02/2022', 'A', 'D', 'C', 'B'),
(48, '17/02/2022', 'B', 'A', 'C', 'D'),
(49, '18/02/2022', 'B', 'A', 'D', 'C'),
(50, '19/02/2022', 'C', 'B', 'D', 'A'),
(51, '20/02/2022', 'C', 'B', 'D', 'A'),
(52, '21/02/2022', 'C', 'B', 'A', 'D'),
(53, '22/02/2022', 'D', 'C', 'A', 'B'),
(54, '23/02/2022', 'D', 'C', 'B', 'A'),
(55, '24/02/2022', 'A', 'D', 'B', 'C'),
(56, '25/02/2022', 'A', 'D', 'C', 'B'),
(57, '26/02/2022', 'B', 'A', 'C', 'D'),
(58, '27/02/2022', 'B', 'A', 'C', 'D'),
(59, '28/02/2022', 'B', 'A', 'D', 'C'),
(60, '01/03/2022', 'C', 'B', 'D', 'A'),
(61, '02/03/2022', 'C', 'B', 'A', 'D'),
(62, '03/03/2022', 'D', 'C', 'A', 'B'),
(63, '04/03/2022', 'D', 'C', 'B', 'A'),
(64, '05/03/2022', 'A', 'D', 'B', 'C'),
(65, '06/03/2022', 'A', 'D', 'B', 'C'),
(66, '07/03/2022', 'A', 'D', 'C', 'B'),
(67, '08/03/2022', 'B', 'A', 'C', 'D'),
(68, '09/03/2022', 'B', 'A', 'D', 'C'),
(69, '10/03/2022', 'C', 'B', 'D', 'A'),
(70, '11/03/2022', 'C', 'B', 'A', 'D'),
(71, '12/03/2022', 'D', 'C', 'A', 'B'),
(72, '13/03/2022', 'D', 'C', 'A', 'B'),
(73, '14/03/2022', 'D', 'C', 'B', 'A'),
(74, '15/03/2022', 'A', 'D', 'B', 'C'),
(75, '16/03/2022', 'A', 'D', 'C', 'B'),
(76, '17/03/2022', 'B', 'A', 'C', 'D'),
(77, '18/03/2022', 'B', 'A', 'D', 'C'),
(78, '19/03/2022', 'C', 'B', 'D', 'A'),
(79, '20/03/2022', 'C', 'B', 'D', 'A'),
(80, '21/03/2022', 'C', 'B', 'A', 'D'),
(81, '22/03/2022', 'D', 'C', 'A', 'B'),
(82, '23/03/2022', 'D', 'C', 'B', 'A'),
(83, '24/03/2022', 'A', 'D', 'B', 'C'),
(84, '25/03/2022', 'A', 'D', 'C', 'B'),
(85, '26/03/2022', 'B', 'A', 'C', 'D'),
(86, '27/03/2022', 'B', 'A', 'C', 'D'),
(87, '28/03/2022', 'B', 'A', 'D', 'C'),
(88, '29/03/2022', 'C', 'B', 'D', 'A'),
(89, '30/03/2022', 'C', 'B', 'A', 'D'),
(90, '31/03/2022', 'D', 'C', 'A', 'B'),
(91, '01/04/2022', 'D', 'C', 'B', 'A'),
(92, '02/04/2022', 'A', 'D', 'B', 'C'),
(93, '03/04/2022', 'A', 'D', 'B', 'C'),
(94, '04/04/2022', 'A', 'D', 'C', 'B'),
(95, '05/04/2022', 'B', 'A', 'C', 'D'),
(96, '06/04/2022', 'B', 'A', 'D', 'C'),
(97, '07/04/2022', 'C', 'B', 'D', 'A'),
(98, '08/04/2022', 'C', 'B', 'A', 'D'),
(99, '09/04/2022', 'D', 'C', 'A', 'B'),
(100, '10/04/2022', 'D', 'C', 'A', 'B'),
(101, '11/04/2022', 'D', 'C', 'B', 'A'),
(102, '12/04/2022', 'A', 'D', 'B', 'C'),
(103, '13/04/2022', 'A', 'D', 'C', 'B'),
(104, '14/04/2022', 'B', 'A', 'C', 'D'),
(105, '15/04/2022', 'B', 'A', 'D', 'C'),
(106, '16/04/2022', 'C', 'B', 'D', 'A'),
(107, '17/04/2022', 'C', 'B', 'D', 'A'),
(108, '18/04/2022', 'C', 'B', 'A', 'D'),
(109, '19/04/2022', 'D', 'C', 'A', 'B'),
(110, '20/04/2022', 'D', 'C', 'B', 'A'),
(111, '21/04/2022', 'A', 'D', 'B', 'C'),
(112, '22/04/2022', 'A', 'D', 'C', 'B'),
(113, '23/04/2022', 'B', 'A', 'C', 'D'),
(114, '24/04/2022', 'B', 'A', 'C', 'D'),
(115, '25/04/2022', 'B', 'A', 'D', 'C'),
(116, '26/04/2022', 'C', 'B', 'D', 'A'),
(117, '27/04/2022', 'C', 'B', 'A', 'D'),
(118, '28/04/2022', 'D', 'C', 'A', 'B'),
(119, '29/04/2022', 'D', 'C', 'B', 'A'),
(120, '30/04/2022', 'A', 'D', 'B', 'C'),
(121, '01/05/2022', 'A', 'D', 'B', 'C'),
(122, '02/05/2022', 'A', 'D', 'C', 'B'),
(123, '03/05/2022', 'B', 'A', 'C', 'D'),
(124, '04/05/2022', 'B', 'A', 'D', 'C'),
(125, '05/05/2022', 'C', 'B', 'D', 'A'),
(126, '06/05/2022', 'C', 'B', 'A', 'D'),
(127, '07/05/2022', 'D', 'C', 'A', 'B'),
(128, '08/05/2022', 'D', 'C', 'A', 'B'),
(129, '09/05/2022', 'D', 'C', 'B', 'A'),
(130, '10/05/2022', 'A', 'D', 'B', 'C'),
(131, '11/05/2022', 'A', 'D', 'C', 'B'),
(132, '12/05/2022', 'B', 'A', 'C', 'D'),
(133, '13/05/2022', 'B', 'A', 'D', 'C'),
(134, '14/05/2022', 'C', 'B', 'D', 'A'),
(135, '15/05/2022', 'C', 'B', 'D', 'A'),
(136, '16/05/2022', 'C', 'B', 'A', 'D'),
(137, '17/05/2022', 'D', 'C', 'A', 'B'),
(138, '18/05/2022', 'D', 'C', 'B', 'A'),
(139, '19/05/2022', 'A', 'D', 'B', 'C'),
(140, '20/05/2022', 'A', 'D', 'C', 'B'),
(141, '21/05/2022', 'B', 'A', 'C', 'D'),
(142, '22/05/2022', 'B', 'A', 'C', 'D'),
(143, '23/05/2022', 'B', 'A', 'D', 'C'),
(144, '24/05/2022', 'C', 'B', 'D', 'A'),
(145, '25/05/2022', 'C', 'B', 'A', 'D'),
(146, '26/05/2022', 'D', 'C', 'A', 'B'),
(147, '27/05/2022', 'D', 'C', 'B', 'A'),
(148, '28/05/2022', 'A', 'D', 'B', 'C'),
(149, '29/05/2022', 'A', 'D', 'B', 'C'),
(150, '30/05/2022', 'A', 'D', 'C', 'B'),
(151, '31/05/2022', 'B', 'A', 'C', 'D'),
(152, '01/06/2022', 'B', 'A', 'D', 'C'),
(153, '02/06/2022', 'C', 'B', 'D', 'A'),
(154, '03/06/2022', 'C', 'B', 'A', 'D'),
(155, '04/06/2022', 'D', 'C', 'A', 'B'),
(156, '05/06/2022', 'D', 'C', 'A', 'B'),
(157, '06/06/2022', 'D', 'C', 'B', 'A'),
(158, '07/06/2022', 'A', 'D', 'B', 'C'),
(159, '08/06/2022', 'A', 'D', 'C', 'B'),
(160, '09/06/2022', 'B', 'A', 'C', 'D'),
(161, '10/06/2022', 'B', 'A', 'D', 'C'),
(162, '11/06/2022', 'C', 'B', 'D', 'A'),
(163, '12/06/2022', 'C', 'B', 'D', 'A'),
(164, '13/06/2022', 'C', 'B', 'A', 'D'),
(165, '14/06/2022', 'D', 'C', 'A', 'B'),
(166, '15/06/2022', 'D', 'C', 'B', 'A'),
(167, '16/06/2022', 'A', 'D', 'B', 'C'),
(168, '17/06/2022', 'A', 'D', 'C', 'B'),
(169, '18/06/2022', 'B', 'A', 'C', 'D'),
(170, '19/06/2022', 'B', 'A', 'C', 'D'),
(171, '20/06/2022', 'B', 'A', 'D', 'C'),
(172, '21/06/2022', 'C', 'B', 'D', 'A'),
(173, '22/06/2022', 'C', 'B', 'A', 'D'),
(174, '23/06/2022', 'D', 'C', 'A', 'B'),
(175, '24/06/2022', 'D', 'C', 'B', 'A'),
(176, '25/06/2022', 'A', 'D', 'B', 'C'),
(177, '26/06/2022', 'A', 'D', 'B', 'C'),
(178, '27/06/2022', 'A', 'D', 'C', 'B'),
(179, '28/06/2022', 'B', 'A', 'C', 'D'),
(180, '29/06/2022', 'B', 'A', 'D', 'C'),
(181, '30/06/2022', 'C', 'B', 'D', 'A'),
(182, '01/07/2022', 'C', 'B', 'A', 'D'),
(183, '02/07/2022', 'D', 'C', 'A', 'B'),
(184, '03/07/2022', 'D', 'C', 'A', 'B'),
(185, '04/07/2022', 'D', 'C', 'B', 'A'),
(186, '05/07/2022', 'A', 'D', 'B', 'C'),
(187, '06/07/2022', 'A', 'D', 'C', 'B'),
(188, '07/07/2022', 'B', 'A', 'C', 'D'),
(189, '08/07/2022', 'B', 'A', 'D', 'C'),
(190, '09/07/2022', 'C', 'B', 'D', 'A'),
(191, '10/07/2022', 'C', 'B', 'D', 'A'),
(192, '11/07/2022', 'C', 'B', 'A', 'D'),
(193, '12/07/2022', 'D', 'C', 'A', 'B'),
(194, '13/07/2022', 'D', 'C', 'B', 'A'),
(195, '14/07/2022', 'A', 'D', 'B', 'C'),
(196, '15/07/2022', 'A', 'D', 'C', 'B'),
(197, '16/07/2022', 'B', 'A', 'C', 'D'),
(198, '17/07/2022', 'B', 'A', 'C', 'D'),
(199, '18/07/2022', 'B', 'A', 'D', 'C'),
(200, '19/07/2022', 'C', 'B', 'D', 'A'),
(201, '20/07/2022', 'C', 'B', 'A', 'D'),
(202, '21/07/2022', 'D', 'C', 'A', 'B'),
(203, '22/07/2022', 'D', 'C', 'B', 'A'),
(204, '23/07/2022', 'A', 'D', 'B', 'C'),
(205, '24/07/2022', 'A', 'D', 'B', 'C'),
(206, '25/07/2022', 'A', 'D', 'C', 'B'),
(207, '26/07/2022', 'B', 'A', 'C', 'D'),
(208, '27/07/2022', 'B', 'A', 'D', 'C'),
(209, '28/07/2022', 'C', 'B', 'D', 'A'),
(210, '29/07/2022', 'C', 'B', 'A', 'D'),
(211, '30/07/2022', 'D', 'C', 'A', 'B'),
(212, '31/07/2022', 'D', 'C', 'A', 'B'),
(213, '01/08/2022', 'D', 'C', 'B', 'A'),
(214, '02/08/2022', 'A', 'D', 'B', 'C'),
(215, '03/08/2022', 'A', 'D', 'C', 'B'),
(216, '04/08/2022', 'B', 'A', 'C', 'D'),
(217, '05/08/2022', 'B', 'A', 'D', 'C'),
(218, '06/08/2022', 'C', 'B', 'D', 'A'),
(219, '07/08/2022', 'C', 'B', 'D', 'A'),
(220, '08/08/2022', 'C', 'B', 'A', 'D'),
(221, '09/08/2022', 'D', 'C', 'A', 'B'),
(222, '10/08/2022', 'D', 'C', 'B', 'A'),
(223, '11/08/2022', 'A', 'D', 'B', 'C'),
(224, '12/08/2022', 'A', 'D', 'C', 'B'),
(225, '13/08/2022', 'B', 'A', 'C', 'D'),
(226, '14/08/2022', 'B', 'A', 'C', 'D'),
(227, '15/08/2022', 'B', 'A', 'D', 'C'),
(228, '16/08/2022', 'C', 'B', 'D', 'A'),
(229, '17/08/2022', 'C', 'B', 'A', 'D'),
(230, '18/08/2022', 'D', 'C', 'A', 'B'),
(231, '19/08/2022', 'D', 'C', 'B', 'A'),
(232, '20/08/2022', 'A', 'D', 'B', 'C'),
(233, '21/08/2022', 'A', 'D', 'B', 'C'),
(234, '22/08/2022', 'A', 'D', 'C', 'B'),
(235, '23/08/2022', 'B', 'A', 'C', 'D'),
(236, '24/08/2022', 'B', 'A', 'D', 'C'),
(237, '25/08/2022', 'C', 'B', 'D', 'A'),
(238, '26/08/2022', 'C', 'B', 'A', 'D'),
(239, '27/08/2022', 'D', 'C', 'A', 'B'),
(240, '28/08/2022', 'D', 'C', 'A', 'B'),
(241, '29/08/2022', 'D', 'C', 'B', 'A'),
(242, '30/08/2022', 'A', 'D', 'B', 'C'),
(243, '31/08/2022', 'A', 'D', 'C', 'B'),
(244, '01/09/2022', 'B', 'A', 'C', 'D'),
(245, '02/09/2022', 'B', 'A', 'D', 'C'),
(246, '03/09/2022', 'C', 'B', 'D', 'A'),
(247, '04/09/2022', 'C', 'B', 'D', 'A'),
(248, '05/09/2022', 'C', 'B', 'A', 'D'),
(249, '06/09/2022', 'D', 'C', 'A', 'B'),
(250, '07/09/2022', 'D', 'C', 'B', 'A'),
(251, '08/09/2022', 'A', 'D', 'B', 'C'),
(252, '09/09/2022', 'A', 'D', 'C', 'B'),
(253, '10/09/2022', 'B', 'A', 'C', 'D'),
(254, '11/09/2022', 'B', 'A', 'C', 'D'),
(255, '12/09/2022', 'B', 'A', 'D', 'C'),
(256, '13/09/2022', 'C', 'B', 'D', 'A'),
(257, '14/09/2022', 'C', 'B', 'A', 'D'),
(258, '15/09/2022', 'D', 'C', 'A', 'B'),
(259, '16/09/2022', 'D', 'C', 'B', 'A'),
(260, '17/09/2022', 'A', 'D', 'B', 'C'),
(261, '18/09/2022', 'A', 'D', 'B', 'C'),
(262, '19/09/2022', 'A', 'D', 'C', 'B'),
(263, '20/09/2022', 'B', 'A', 'C', 'D'),
(264, '21/09/2022', 'B', 'A', 'D', 'C'),
(265, '22/09/2022', 'C', 'B', 'D', 'A'),
(266, '23/09/2022', 'C', 'B', 'A', 'D'),
(267, '24/09/2022', 'D', 'C', 'A', 'B'),
(268, '25/09/2022', 'D', 'C', 'A', 'B'),
(269, '26/09/2022', 'D', 'C', 'B', 'A'),
(270, '27/09/2022', 'A', 'D', 'B', 'C'),
(271, '28/09/2022', 'A', 'D', 'C', 'B'),
(272, '29/09/2022', 'B', 'A', 'C', 'D'),
(273, '30/09/2022', 'B', 'A', 'D', 'C'),
(274, '01/10/2022', 'C', 'B', 'D', 'A'),
(275, '02/10/2022', 'C', 'B', 'D', 'A'),
(276, '03/10/2022', 'C', 'B', 'A', 'D'),
(277, '04/10/2022', 'D', 'C', 'A', 'B'),
(278, '05/10/2022', 'D', 'C', 'B', 'A'),
(279, '06/10/2022', 'A', 'D', 'B', 'C'),
(280, '07/10/2022', 'A', 'D', 'C', 'B'),
(281, '08/10/2022', 'B', 'A', 'C', 'D'),
(282, '09/10/2022', 'B', 'A', 'C', 'D'),
(283, '10/10/2022', 'B', 'A', 'D', 'C'),
(284, '11/10/2022', 'C', 'B', 'D', 'A'),
(285, '12/10/2022', 'C', 'B', 'A', 'D'),
(286, '13/10/2022', 'D', 'C', 'A', 'B'),
(287, '14/10/2022', 'D', 'C', 'B', 'A'),
(288, '15/10/2022', 'A', 'D', 'B', 'C'),
(289, '16/10/2022', 'A', 'D', 'B', 'C'),
(290, '17/10/2022', 'A', 'D', 'C', 'B'),
(291, '18/10/2022', 'B', 'A', 'C', 'D'),
(292, '19/10/2022', 'B', 'A', 'D', 'C'),
(293, '20/10/2022', 'C', 'B', 'D', 'A'),
(294, '21/10/2022', 'C', 'B', 'A', 'D'),
(295, '22/10/2022', 'D', 'C', 'A', 'B'),
(296, '23/10/2022', 'D', 'C', 'A', 'B'),
(297, '24/10/2022', 'D', 'C', 'B', 'A'),
(298, '25/10/2022', 'A', 'D', 'B', 'C'),
(299, '26/10/2022', 'A', 'D', 'C', 'B'),
(300, '27/10/2022', 'B', 'A', 'C', 'D'),
(301, '28/10/2022', 'B', 'A', 'D', 'C'),
(302, '29/10/2022', 'C', 'B', 'D', 'A'),
(303, '30/10/2022', 'C', 'B', 'D', 'A'),
(304, '31/10/2022', 'C', 'B', 'A', 'D'),
(305, '01/11/2022', 'D', 'C', 'A', 'B'),
(306, '02/11/2022', 'D', 'C', 'B', 'A'),
(307, '03/11/2022', 'A', 'D', 'B', 'C'),
(308, '04/11/2022', 'A', 'D', 'C', 'B'),
(309, '05/11/2022', 'B', 'A', 'C', 'D'),
(310, '06/11/2022', 'B', 'A', 'C', 'D'),
(311, '07/11/2022', 'B', 'A', 'D', 'C'),
(312, '08/11/2022', 'C', 'B', 'D', 'A'),
(313, '09/11/2022', 'C', 'B', 'A', 'D'),
(314, '10/11/2022', 'D', 'C', 'A', 'B'),
(315, '11/11/2022', 'D', 'C', 'B', 'A'),
(316, '12/11/2022', 'A', 'D', 'B', 'C'),
(317, '13/11/2022', 'A', 'D', 'B', 'C'),
(318, '14/11/2022', 'A', 'D', 'C', 'B'),
(319, '15/11/2022', 'B', 'A', 'C', 'D'),
(320, '16/11/2022', 'B', 'A', 'D', 'C'),
(321, '17/11/2022', 'C', 'B', 'D', 'A'),
(322, '18/11/2022', 'C', 'B', 'A', 'D'),
(323, '19/11/2022', 'D', 'C', 'A', 'B'),
(324, '20/11/2022', 'D', 'C', 'A', 'B'),
(325, '21/11/2022', 'D', 'C', 'B', 'A'),
(326, '22/11/2022', 'A', 'D', 'B', 'C'),
(327, '23/11/2022', 'A', 'D', 'C', 'B'),
(328, '24/11/2022', 'B', 'A', 'C', 'D'),
(329, '25/11/2022', 'B', 'A', 'D', 'C'),
(330, '26/11/2022', 'C', 'B', 'D', 'A'),
(331, '27/11/2022', 'C', 'B', 'D', 'A'),
(332, '28/11/2022', 'C', 'B', 'A', 'D'),
(333, '29/11/2022', 'D', 'C', 'A', 'B'),
(334, '30/11/2022', 'D', 'C', 'B', 'A'),
(335, '01/12/2022', 'A', 'D', 'B', 'C'),
(336, '02/12/2022', 'A', 'D', 'C', 'B'),
(337, '03/12/2022', 'B', 'A', 'C', 'D'),
(338, '04/12/2022', 'B', 'A', 'C', 'D'),
(339, '05/12/2022', 'B', 'A', 'D', 'C'),
(340, '06/12/2022', 'C', 'B', 'D', 'A'),
(341, '07/12/2022', 'C', 'B', 'A', 'D'),
(342, '08/12/2022', 'D', 'C', 'A', 'B'),
(343, '09/12/2022', 'D', 'C', 'B', 'A'),
(344, '10/12/2022', 'A', 'D', 'B', 'C'),
(345, '11/12/2022', 'A', 'D', 'B', 'C'),
(346, '12/12/2022', 'A', 'D', 'C', 'B'),
(347, '13/12/2022', 'B', 'A', 'C', 'D'),
(348, '14/12/2022', 'B', 'A', 'D', 'C'),
(349, '15/12/2022', 'C', 'B', 'D', 'A'),
(350, '16/12/2022', 'C', 'B', 'A', 'D'),
(351, '17/12/2022', 'D', 'C', 'A', 'B'),
(352, '18/12/2022', 'D', 'C', 'A', 'B'),
(353, '19/12/2022', 'D', 'C', 'B', 'A'),
(354, '20/12/2022', 'A', 'D', 'B', 'C'),
(355, '21/12/2022', 'A', 'D', 'C', 'B'),
(356, '22/12/2022', 'B', 'A', 'C', 'D'),
(357, '23/12/2022', 'B', 'A', 'D', 'C'),
(358, '24/12/2022', 'C', 'B', 'D', 'A'),
(359, '25/12/2022', 'C', 'B', 'D', 'A'),
(360, '26/12/2022', 'C', 'B', 'A', 'D'),
(361, '27/12/2022', 'D', 'C', 'A', 'B'),
(362, '28/12/2022', 'D', 'C', 'B', 'A'),
(363, '29/12/2022', 'A', 'D', 'B', 'C'),
(364, '30/12/2022', 'A', 'D', 'C', 'B'),
(365, '31/12/2022', 'B', 'A', 'C', 'D');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `lista_turno`
--
ALTER TABLE `lista_turno`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `lista_turno`
--
ALTER TABLE `lista_turno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;