-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Fev-2023 às 11:35
-- Versão do servidor: 10.3.36-MariaDB-0+deb10u2
-- PHP Version: 7.3.31-1~deb10u1

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
  `registro` varchar(10) DEFAULT NULL,
  `justificativa` varchar(500) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `cancela` varchar(50) DEFAULT NULL,
  `data` varchar(10) DEFAULT NULL,
  `hora` varchar(8) DEFAULT NULL,
  `nome_colaborador` varchar(50) DEFAULT NULL,
  `sitio` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `hora` varchar(8) NOT NULL,
  `comando` varchar(50) NOT NULL,
  `bypass_gagf` varchar(3) NOT NULL,
  `bypass_sva` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_utmi`
--

INSERT INTO `id_cancelas_utmi` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`, `comando`, `bypass_gagf`, `bypass_sva`) VALUES
(6, 'Entrada UTMI', '07', 'Miguel Burnier - UTMI', 'can6_mb', '0', '0', '', '14/07/2020', '13:33:23', '', '', ''),
(7, 'Saída UTMI', '08', 'Miguel Burnier - UTMI', 'can7_mb', '0', '0', '', '14/07/2020', '13:33:23', '', '', ''),
(8, 'Entrada UTMI - Baia 01', '09', 'Miguel Burnier - UTMI', 'can8_mb', '0', '0', '', '14/07/2020', '13:33:23', '', '', ''),
(9, 'Saída UTMI - Baia 01', '10', 'Miguel Burnier - UTMI', 'can9_mb', '0', '0', '', '14/07/2020', '13:33:23', '', '', ''),
(10, 'Saída do Baldeio Ônibus', '11', 'Miguel Burnier - UTMI', 'can10_mb', '0', '0', '', '14/07/2020', '13:33:23', '', '', '');

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
  `hora` varchar(8) NOT NULL,
  `comando` varchar(50) NOT NULL,
  `bypass_gagf` varchar(3) NOT NULL,
  `bypass_sva` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_utmii`
--

INSERT INTO `id_cancelas_utmii` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`, `comando`, `bypass_gagf`, `bypass_sva`) VALUES
(1, 'Entrada UTMII', '02', 'Miguel Burnier - UTMII', 'can1_mb', 'Aberta!', '', '', '25/05/2021', '10:24:56', '', '', ''),
(2, 'Saída UTMII', '03', 'Miguel Burnier - UTMII', 'can2_mb', 'Fechada!', '', '', '14/07/2020', '13:33:23', '', '', ''),
(3, 'Entrada Recebimento ROM', '04', 'Miguel Burnier - UTMII', 'can3_mb', 'Fechada!', '', '', '14/07/2020', '13:33:23', '', '', ''),
(4, 'Saída Recebimento ROM', '05', 'Miguel Burnier - UTMII', 'can4_mb', 'Aberta!', '', '', '16/11/2020', '14:43:25', '', '', ''),
(5, 'Saída Alt. Recebimento ROM', '06', 'Miguel Burnier - UTMII', 'can5_mb', 'Fechada!', '', '', '14/07/2020', '13:33:23', '', '', '');

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
  `hora` varchar(8) NOT NULL,
  `comando` varchar(50) NOT NULL,
  `bypass_gagf` varchar(3) NOT NULL,
  `bypass_sva` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_vl`
--

INSERT INTO `id_cancelas_vl` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`, `comando`, `bypass_gagf`, `bypass_sva`) VALUES
(11, 'Entrada Congonhas', '12', 'Várzea do Lopes', 'can1_vl', '0', '0', '', '14/07/2020', '13:33:23', '', '', ''),
(12, 'Saída Belo Horizonte', '13', 'Várzea do Lopes', 'can2_vl', '', '', '', '14/07/2020', '13:33:23', '', '', ''),
(13, 'Entrada Belo Horizonte', '14', 'Várzea do Lopes', 'can3_vl', '0', '0', '', '14/07/2020', '13:33:23', '', '', ''),
(14, 'Saída 01 Congonhas', '15', 'Várzea do Lopes', 'can4_vl', '0', '0', '', '14/07/2020', '13:33:23', '', '', ''),
(15, 'Saída 02 Congonhas', '16', 'Várzea do Lopes', 'can5_vl', '0', '0', '', '14/07/2020', '13:33:23', '', '', '');

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
  `hora` varchar(8) NOT NULL,
  `comando` varchar(50) NOT NULL,
  `bypass_gagf` varchar(3) NOT NULL,
  `bypass_sva` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `id_cancelas_vln`
--

INSERT INTO `id_cancelas_vln` (`id`, `nomecancela`, `codigo_lora`, `local_instalacao`, `cod`, `condicao`, `tag_lida`, `info`, `data`, `hora`, `comando`, `bypass_gagf`, `bypass_sva`) VALUES
(1, 'Entrada 1 VLN', '19', 'Várzea do Lopes Norte', 'can1_vln', '', '', '', '', '', '', '', ''),
(2, 'Entrada 2 VLN', '20', 'Várzea do Lopes Norte', 'can2_vln', '', '', '', '', '', '', '', ''),
(3, 'Saida 1 VLN', '21', 'Várzea do Lopes Norte', 'can3_vln', '', '', '', '', '', '', '', ''),
(4, 'Saida 2 VLN', '22', 'Várzea do Lopes Norte', 'can4_vln', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mes`
--

CREATE TABLE `mes` (
  `id` int(11) NOT NULL,
  `nome_mes` varchar(30) NOT NULL,
  `valor_mes` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `mes`
--

INSERT INTO `mes` (`id`, `nome_mes`, `valor_mes`) VALUES
(1, 'Janeiro', '01'),
(2, 'Fevereiro', '02'),
(3, 'Março', '03'),
(4, 'Abril', '04'),
(5, 'Maio', '05'),
(6, 'Junho', '06'),
(7, 'Julho', '07'),
(8, 'Agosto', '08'),
(9, 'Setembro', '09'),
(10, 'Outubro', '10'),
(11, 'Novembro', '11'),
(12, 'Dezembro', '12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `motivos_acionamentos`
--

CREATE TABLE `motivos_acionamentos` (
  `id` int(11) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `mensagem` varchar(100) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `motivos_acionamentos`
--

INSERT INTO `motivos_acionamentos` (`id`, `motivo`, `mensagem`, `tipo`) VALUES
(5, 'Pipa da Fagundes umectando a via ', 'outro', 'entrada'),
(14, 'Validou apenas SVA', 'manter', 'entrada'),
(15, 'Validou apenas GSCS', 'manter', 'entrada'),
(18, 'SVA não validou a saída', 'saida_ccl', 'saida'),
(19, 'Saída de outro tipo de veiculo', 'outro', 'saida'),
(20, 'Entrada de outro tipo de veiculo', 'outro', 'entrada'),
(21, 'Pipa da Fagundes umectando a via ', 'outro', 'saida'),
(22, 'Troca de turno, bloqueado atento!', 'manter', 'entrada2'),
(23, 'Troca de Turno - Erro GSCS', 'manter', 'entrada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `registro` varchar(8) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `area` varchar(50) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `criptografia` varchar(20) NOT NULL,
  `alterar` varchar(1) NOT NULL,
  `acesso_portal` int(10) NOT NULL,
  `acesso_excesso` int(10) NOT NULL,
  `acesso_aciona_cancela` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `registro`, `senha`, `area`, `tipo_usuario`, `criptografia`, `alterar`, `acesso_portal`, `acesso_excesso`, `acesso_aciona_cancela`) VALUES
(1, 'BRUNO GONCALVES', '37063378', 'gerdau', 'Logística MB', 'Desenvolvedor', '55595067', '0', 92, 0, 64),
(2, 'ADRIANO MIRANDA LUPPI', '37063200', 'luppi', 'Logística VL', 'Administrador', '55594800', '0', 2, 0, 0),
(3, 'DENISE ALOMA DE ALMEIDA BRITO', '37063201', 'denise', 'Logística MB', 'Gestão GAGF', '55594801.5', '0', 0, 0, 0),
(4, 'ALEXANDRE BALDOINO', '37077902', 'Alebal1976', 'Logística MB', 'Operador CCL MB', '55616853', '0', 17, 0, 184),
(5, 'AMANDA APARECIDA XAVIER', '37071407', 'GERDAU2023', 'Logística MB', 'Operador CCL MB', '55607110,5', '0', 44, 0, 158),
(6, 'BEATRIZ ELUISE BITTENCOURT LOBO', '37080627', '37080627', 'Logística MB', 'Gestão CCL MB', '55620940,5', '1', 0, 0, 0),
(7, 'CAROLINA BEATRIZ DOS SANTOS SILVA', '37081503', 'bELLOC@09', 'Logística MB', 'Operador CCL MB', '55622254,5', '0', 3, 0, 0),
(8, 'ELIMAR LUCAS ELEOTERIO NEVES', '37077887', '37077887', 'Logística MB', 'Operador CCL MB', '55616830,5', '1', 0, 0, 0),
(9, 'ERICK FABIANE PACHECO', '37078311', '37078311', 'Logística MB', 'Operador CCL MB', '55617466,5', '1', 0, 0, 53),
(10, 'GERVESOM ALVES LIMA', '37080458', '495681', 'Logística MB', 'Operador CCL MB', '55620687', '0', 94, 0, 513),
(11, 'HUIGO FILIPE LOBO BARBOSA', '37077598', '70936', 'Logística MB', 'Operador CCL MB', '55616397', '0', 17, 0, 304),
(12, 'JOSE CARLOS GUIMARÃES', '37078567', '37078567', 'Logística MB', 'Gestão CCL MB', '55617850,5', '1', 0, 0, 0),
(13, 'LORRANE APARECIDA DE JESUS PEREIRA', '37080260', '12345678', 'Logística MB', 'Operador CCL MB', '55620390', '0', 35, 0, 468),
(14, 'PABLO ANTONIO NAVAIS ALVES', '37072078', 'pablo2022', 'Logística MB', 'Operador CCL MB', '55608117', '0', 11, 0, 20),
(15, 'PABLO GARCIA BARBOSA', '37077894', 'p@blim15', 'Logística MB', 'Operador CCL MB', '55616841', '0', 28, 0, 218),
(16, 'PHAGNER PHILIPE DE OLIVEIRA TEIXEIRA', '37077592', 'gerdau', 'Logística MB', 'Operador CCL MB', '55616388', '0', 3, 0, 21),
(17, 'THAIS APARECIDA COIMBRA DE QUEIRÓS TEIXEIRA', '37096468', 'cabuloso1921', 'Logística MB', 'Operador CCL MB', '55644702', '0', 2, 0, 77),
(18, 'YANEZ ELVIO SANTOS SILVA', '37077594', 'yanez2020', 'Logística MB', 'Operador CCL MB', '55616391', '0', 1, 0, 7),
(19, 'ROMULO CEZAR APARECIDO TAVARES', '37085870', 'rtavare1', 'Logística MB', 'Operador CCL MB', '55628805', '0', 10, 0, 169),
(20, 'AMANDA DA MATA CASTILIO', '37106411', '37106411', 'Logística MB', 'Operador CCL MB', '55659616,5', '1', 0, 0, 0),
(21, 'SIMONE APARECIDA DA SILVA', '37095811', 'gerdau16', 'Logística MB', 'Operador CCL MB', '55643716,5', '0', 8, 0, 133),
(22, 'ROBSON CESAR TEIXEIRA', '37095778', 'iphone2022', 'Logística MB', 'Operador CCL MB', '55643667', '0', 11, 0, 305);

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
-- Indexes for table `mes`
--
ALTER TABLE `mes`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `mes`
--
ALTER TABLE `mes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `motivos_acionamentos`
--
ALTER TABLE `motivos_acionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sitios`
--
ALTER TABLE `sitios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
