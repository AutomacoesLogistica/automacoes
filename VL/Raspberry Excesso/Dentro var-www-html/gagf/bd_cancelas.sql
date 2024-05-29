-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 17-Maio-2021 às 11:19
-- Versão do servidor: 10.3.22-MariaDB-0+deb10u1-log
-- PHP Version: 7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_cancelas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acionamentos_cancelas_mb`
--

CREATE TABLE `acionamentos_cancelas_mb` (
  `id` int(11) NOT NULL,
  `id_cancela` varchar(20) NOT NULL,
  `comando` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `registro` varchar(10) NOT NULL,
  `justificativa` varchar(500) NOT NULL,
  `cancela` varchar(50) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL,
  `nome_colaborador` varchar(50) NOT NULL,
  `sitio` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `registro`, `justificativa`, `cancela`, `data`, `hora`, `nome_colaborador`, `sitio`, `area`) VALUES
(1, '37063378', 'Motorista com viagem errada.', 'Entrada Recebimento ROM', '27/10/2020', '11:18:46', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(2, '37063378', 'Problemas no GAGF', 'Saída Alt. Recebimento ROM', '27/10/2020', '11:19:53', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(3, '37063378', 'Problema com o TAG do cavalo ou carreta', 'Saída Recebimento ROM', '27/10/2020', '14:06:47', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(4, '37063378', 'Problema com o TAG do cavalo ou carreta', 'Saída Recebimento ROM', '17/11/2020', '15:02:40', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(5, '37063378', 'Manter cancela aberta', 'Saída Recebimento ROM', '17/11/2020', '15:05:59', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(6, '37063378', 'Problemas no GAGF', 'Saída Recebimento ROM', '17/11/2020', '15:26:44', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(7, '37063378', 'Pipa da Fagundes umidificando a via', 'Saída Recebimento ROM', '17/11/2020', '15:27:12', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(8, '37063378', 'Pipa da Fagundes umidificando a via', 'Saída Recebimento ROM', '17/11/2020', '15:27:17', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(9, '37063378', 'Motorista com viagem errada.', 'Saída UTMII', '17/11/2020', '15:32:58', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(10, '37063378', 'Problema com o TAG do cavalo ou carreta', 'Saída Alt. Recebimento ROM', '20/11/2020', '12:46:43', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(11, '37063378', 'Problema com o TAG do cavalo ou carreta', 'Saída Alt. Recebimento ROM', '20/11/2020', '13:07:41', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB'),
(12, '37063378', 'Motorista teve que trocar o cavalo por causa de problema mecânico', 'Saída Alt. Recebimento ROM', '20/11/2020', '13:11:14', 'Bruno Gonçalves', 'Miguel Burnier - UTMII', 'Logística MB');

-- --------------------------------------------------------

--
-- Estrutura da tabela `id_cancelas_patrag`
--

CREATE TABLE `id_cancelas_patrag` (
  `id` int(11) NOT NULL,
  `nomecancela` varchar(50) NOT NULL,
  `codigo_lora` varchar(10) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `condicao` varchar(20) NOT NULL,
  `tag_lida` varchar(24) NOT NULL,
  `info` varchar(80) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL,
  `comando` varchar(50) NOT NULL,
  `bypass_gagf` varchar(3) NOT NULL,
  `bypass_sva` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_patrag`
--

INSERT INTO `id_cancelas_patrag` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`, `comando`, `bypass_gagf`, `bypass_sva`) VALUES
(17, 'Entrada Patrag', '17', 'Patrag', 'can1_pat', 'Defeito!', '', 'Erro: Motor queimado!', '14/07/2020', '13:33:23', '', '', ''),
(18, 'Saída Patrag', '18', 'Patrag', 'can2_pat', 'Falta Rede!', '00000000000', 'bruno', '14/07/2020', '13:33:23', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `id_cancelas_utmi`
--

CREATE TABLE `id_cancelas_utmi` (
  `id` int(11) NOT NULL,
  `nomecancela` varchar(50) NOT NULL,
  `codigo_lora` varchar(10) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `condicao` varchar(20) NOT NULL,
  `tag_lida` varchar(24) NOT NULL,
  `info` varchar(80) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_utmi`
--

INSERT INTO `id_cancelas_utmi` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`) VALUES
(6, 'Entrada UTMI', '07', 'Miguel Burnier - UTMI', 'can6_mb', '0', '0', '', '14/07/2020', '13:33:23'),
(7, 'Saída UTMI', '08', 'Miguel Burnier - UTMI', 'can7_mb', '0', '0', '', '14/07/2020', '13:33:23'),
(8, 'Entrada UTMI - Baia 01', '09', 'Miguel Burnier - UTMI', 'can8_mb', '0', '0', '', '14/07/2020', '13:33:23'),
(9, 'Saída UTMI - Baia 01', '10', 'Miguel Burnier - UTMI', 'can9_mb', '0', '0', '', '14/07/2020', '13:33:23'),
(10, 'Saída do Baldeio Ônibus', '11', 'Miguel Burnier - UTMI', 'can10_mb', '0', '0', '', '14/07/2020', '13:33:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `id_cancelas_utmii`
--

CREATE TABLE `id_cancelas_utmii` (
  `id` int(11) NOT NULL,
  `nomecancela` varchar(50) NOT NULL,
  `codigo_lora` varchar(10) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `condicao` varchar(20) NOT NULL,
  `tag_lida` varchar(24) NOT NULL,
  `info` varchar(80) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_utmii`
--

INSERT INTO `id_cancelas_utmii` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`) VALUES
(1, 'Entrada UTMII', '02', 'Miguel Burnier - UTMII', 'can1_mb', 'Fechada!', '', '', '24/10/2020', '15:00:39'),
(2, 'Saída UTMII', '03', 'Miguel Burnier - UTMII', 'can2_mb', 'Fechada!', '', '', '14/07/2020', '13:33:23'),
(3, 'Entrada Recebimento ROM', '04', 'Miguel Burnier - UTMII', 'can3_mb', 'Fechada!', '', '', '14/07/2020', '13:33:23'),
(4, 'Saída Recebimento ROM', '05', 'Miguel Burnier - UTMII', 'can4_mb', 'Aberta!', '', '</br>17/11/2020 - 14:57:13', '17/11/2020', '14:57:13'),
(5, 'Saída Alt. Recebimento ROM', '06', 'Miguel Burnier - UTMII', 'can5_mb', 'Aberta!', '', '</br>20/11/2020 - 13:11:23', '20/11/2020', '13:11:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `id_cancelas_vl`
--

CREATE TABLE `id_cancelas_vl` (
  `id` int(11) NOT NULL,
  `nomecancela` varchar(50) NOT NULL,
  `codigo_lora` varchar(10) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `condicao` varchar(20) NOT NULL,
  `tag_lida` varchar(24) NOT NULL,
  `info` varchar(80) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_vl`
--

INSERT INTO `id_cancelas_vl` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`) VALUES
(11, 'Entrada Congonhas', '12', 'Várzea do Lopes', 'can1_vl', '0', '0', '', '14/07/2020', '13:33:23'),
(12, 'Saída Belo Horizonte', '13', 'Várzea do Lopes', 'can2_vl', '', '', '', '14/07/2020', '13:33:23'),
(13, 'Entrada Belo Horizonte', '14', 'Várzea do Lopes', 'can3_vl', '0', '0', '', '14/07/2020', '13:33:23'),
(14, 'Saída 01 Congonhas', '15', 'Várzea do Lopes', 'can4_vl', '0', '0', '', '14/07/2020', '13:33:23'),
(15, 'Saída 02 Congonhas', '16', 'Várzea do Lopes', 'can5_vl', '0', '0', '', '14/07/2020', '13:33:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `id_cancelas_vln`
--

CREATE TABLE `id_cancelas_vln` (
  `id` int(11) NOT NULL,
  `nomecancela` varchar(50) NOT NULL,
  `codigo_lora` varchar(10) NOT NULL,
  `local_instalacao` varchar(50) NOT NULL,
  `cod` varchar(10) NOT NULL,
  `condicao` varchar(20) NOT NULL,
  `tag_lida` varchar(24) NOT NULL,
  `info` varchar(80) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_vln`
--

INSERT INTO `id_cancelas_vln` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`) VALUES
(1, 'Entrada 1 VLN', '19', 'Várzea do Lopes Norte', 'can1_vln', '', '', '', '', ''),
(2, 'Entrada 2 VLN', '20', 'Várzea do Lopes Norte', 'can2_vln', '', '', '', '', ''),
(3, 'Saida 1 VLN', '21', 'Várzea do Lopes Norte', 'can3_vln', '', '', '', '', ''),
(4, 'Saida 2 VLN', '22', 'Várzea do Lopes Norte', 'can4_vln', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motivos_acionamentos`
--

CREATE TABLE `motivos_acionamentos` (
  `id` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `motivos_acionamentos`
--

INSERT INTO `motivos_acionamentos` (`id`, `motivo`) VALUES
(2, 'Material contaminado do pátio de produto '),
(3, 'Motorista com viagem errada.'),
(4, 'Motorista teve que trocar o cavalo por causa de problema mecânico '),
(5, 'Pipa da Fagundes umidificando a via '),
(6, 'Problema com o TAG do cavalo ou carreta '),
(7, 'Processo foi aberto manual em Várzea do Lopes'),
(8, 'Processo foi finalizado mais a carreta teve que sair por causa de problema mecânico '),
(9, 'Processo foi finalizado de forma manual '),
(10, 'Problemas no GAGF'),
(12, 'Manter cancela aberta'),
(13, 'Retirar condição de manter aberta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `registro` varchar(8) NOT NULL,
  `senha` varchar(10) NOT NULL,
  `area` varchar(50) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `criptografia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `registro`, `senha`, `area`, `tipo_usuario`, `criptografia`) VALUES
(1, 'Bruno Gonçalves', '37063378', 'gerdau', 'Logística MB', 'Desenvolvedor', '55595067'),
(2, 'Higor da Silva Souza', '37099636', 'gerdau19', 'Logística MB', 'Administrador', '55649454'),
(13, 'Adriano Miranda Luppi', '37063200', 'luppi', 'Logística VL', 'Administrador', '55594800'),
(14, 'Denise Aloma de Almeida Brito', '37063201', 'denise', 'Logística MB', 'Gestão GAGF', '55594801.5'),
(15, 'Beatriz Eluise Bittencourt', '37080627', '123', 'Logística MB', 'Gestão CCL MB', '55620940.5'),
(16, 'Usuarios CCL Miguel Burnier', '12345678', '12345678', 'Logística MB', 'Gestão CCL MB', '18518517');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sitios`
--

CREATE TABLE `sitios` (
  `id` int(11) NOT NULL,
  `nomesitios` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sitios`
--

INSERT INTO `sitios` (`id`, `nomesitios`) VALUES
(1, 'Miguel Burnier - UTMI'),
(2, 'Miguel Burnier - UTMII'),
(3, 'Várzea do Lopes'),
(4, 'Usina Ouro Branco'),
(5, 'Patrag');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acionamentos_cancelas_mb`
--
ALTER TABLE `acionamentos_cancelas_mb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_cancelas_patrag`
--
ALTER TABLE `id_cancelas_patrag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_cancelas_utmi`
--
ALTER TABLE `id_cancelas_utmi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_cancelas_utmii`
--
ALTER TABLE `id_cancelas_utmii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_cancelas_vl`
--
ALTER TABLE `id_cancelas_vl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_cancelas_vln`
--
ALTER TABLE `id_cancelas_vln`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motivos_acionamentos`
--
ALTER TABLE `motivos_acionamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitios`
--
ALTER TABLE `sitios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acionamentos_cancelas_mb`
--
ALTER TABLE `acionamentos_cancelas_mb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `id_cancelas_patrag`
--
ALTER TABLE `id_cancelas_patrag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `id_cancelas_utmi`
--
ALTER TABLE `id_cancelas_utmi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `id_cancelas_utmii`
--
ALTER TABLE `id_cancelas_utmii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `id_cancelas_vl`
--
ALTER TABLE `id_cancelas_vl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `id_cancelas_vln`
--
ALTER TABLE `id_cancelas_vln`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `motivos_acionamentos`
--
ALTER TABLE `motivos_acionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sitios`
--
ALTER TABLE `sitios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
