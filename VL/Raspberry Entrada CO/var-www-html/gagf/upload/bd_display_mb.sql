-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 22-Nov-2021 às 14:49
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_display_mb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `limite` int(2) NOT NULL,
  `dentro` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acessos`
--

INSERT INTO `acessos` (`id`, `limite`, `dentro`) VALUES
(1, 4, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acionamentos_cancelas_rom`
--

CREATE TABLE `acionamentos_cancelas_rom` (
  `id` int(11) NOT NULL,
  `id_cancela` varchar(20) NOT NULL,
  `comando` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acionamentos_cancelas_rom`
--

INSERT INTO `acionamentos_cancelas_rom` (`id`, `id_cancela`, `comando`) VALUES
(239, '04', 'normalizar'),
(240, '04', 'normalizar'),
(241, '04', 'normalizar'),
(242, '04', 'normalizar'),
(243, '04', 'normalizar'),
(244, '04', 'pulso'),
(245, '04', 'normalizar'),
(246, '04', 'normalizar'),
(247, '04', 'normalizar'),
(248, '04', 'pulso'),
(249, '04', 'normalizar'),
(250, '04', 'pulso'),
(251, '04', 'normalizar'),
(252, '04', 'pulso'),
(253, '04', 'normalizar'),
(254, '04', 'pulso'),
(255, '04', 'normalizar'),
(256, '04', 'pulso'),
(257, '04', 'normalizar'),
(258, '04', 'pulso'),
(259, '04', 'normalizar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `acionamentos_efetuados`
--

CREATE TABLE `acionamentos_efetuados` (
  `id` int(11) NOT NULL,
  `codigo_lora` varchar(10) NOT NULL,
  `comando` varchar(100) NOT NULL,
  `data` varchar(10) NOT NULL,
  `hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `nome` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `area`
--

INSERT INTO `area` (`id`, `nome`) VALUES
(1, 'Area 1'),
(2, 'Area 2'),
(3, 'Area 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `baias`
--

CREATE TABLE `baias` (
  `id` int(11) NOT NULL,
  `baia1` varchar(30) NOT NULL,
  `baia2` varchar(30) NOT NULL,
  `baia3` varchar(30) NOT NULL,
  `v_area1` varchar(10) NOT NULL,
  `v_area2` varchar(10) NOT NULL,
  `v_area3` varchar(10) NOT NULL,
  `v_baia1` varchar(10) NOT NULL,
  `v_baia2` varchar(10) NOT NULL,
  `v_baia3` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Extraindo dados da tabela `baias`
--

INSERT INTO `baias` (`id`, `baia1`, `baia2`, `baia3`, `v_area1`, `v_area2`, `v_area3`, `v_baia1`, `v_baia2`, `v_baia3`) VALUES
(1, 'COLÚVIO VL', 'ROM VL', 'COLÚVIO VL', 'Area 2', 'Area 1', 'Area 1', 'Baia 3', 'Baia 3', 'Baia 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `balanca_01`
--

CREATE TABLE `balanca_01` (
  `id` int(11) NOT NULL,
  `mensagem1` varchar(20) NOT NULL,
  `mensagem2` varchar(20) NOT NULL,
  `peso` varchar(6) NOT NULL,
  `semaforo_entrada` varchar(20) NOT NULL,
  `semaforo_saida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `balanca_01`
--

INSERT INTO `balanca_01` (`id`, `mensagem1`, `mensagem2`, `peso`, `semaforo_entrada`, `semaforo_saida`) VALUES
(1, ' Balanca Liberada ! ', 'Placa QQP-1233/RJ   ', '041066', 'avancar', 'parar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `balanca_02`
--

CREATE TABLE `balanca_02` (
  `id` int(11) NOT NULL,
  `mensagem1` varchar(20) NOT NULL,
  `mensagem2` varchar(20) NOT NULL,
  `peso` varchar(6) NOT NULL,
  `semaforo_entrada` varchar(20) NOT NULL,
  `semaforo_saida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `balanca_02`
--

INSERT INTO `balanca_02` (`id`, `mensagem1`, `mensagem2`, `peso`, `semaforo_entrada`, `semaforo_saida`) VALUES
(1, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `balanca_03`
--

CREATE TABLE `balanca_03` (
  `id` int(11) NOT NULL,
  `mensagem1` varchar(20) NOT NULL,
  `mensagem2` varchar(20) NOT NULL,
  `peso` varchar(6) NOT NULL,
  `semaforo_entrada` varchar(20) NOT NULL,
  `semaforo_saida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `nome`) VALUES
(1, 'ROM SEMIL'),
(2, 'COLÚVIO VL'),
(3, 'ROM VL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `nome_baia`
--

CREATE TABLE `nome_baia` (
  `id` int(11) NOT NULL,
  `nome` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `nome_baia`
--

INSERT INTO `nome_baia` (`id`, `nome`) VALUES
(1, 'Baia 1'),
(2, 'Baia 2'),
(3, 'Baia 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `placa_rom`
--

CREATE TABLE `placa_rom` (
  `id` int(11) NOT NULL,
  `local` varchar(20) NOT NULL,
  `sigla` varchar(80) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `localidade` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `placa_rom`
--

INSERT INTO `placa_rom` (`id`, `local`, `sigla`, `placa`, `localidade`) VALUES
(1, 'Entrada', 'Tora', 'PRR4166', 'GO'),
(2, 'Saida', 'Tora', 'PRR4166', 'GO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rom`
--

CREATE TABLE `rom` (
  `id` int(11) NOT NULL,
  `msg_sva` varchar(3) NOT NULL,
  `msg_gscs` varchar(3) NOT NULL,
  `info` varchar(200) NOT NULL,
  `foto` varchar(3) NOT NULL,
  `sigla` varchar(80) NOT NULL,
  `placa` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rom`
--

INSERT INTO `rom` (`id`, `msg_sva`, `msg_gscs`, `info`, `foto`, `sigla`, `placa`) VALUES
(1, '--', 'OK', 'ATENÇÃO!</BR>Validado apenas GSCS!</BR>Descarga não autorizada!</BR></BR>Favor acionar o CCl para verificar a câmera!', '6', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tela_acesso_rom`
--

CREATE TABLE `tela_acesso_rom` (
  `id` int(11) NOT NULL,
  `mensagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tela_acesso_rom`
--

INSERT INTO `tela_acesso_rom` (`id`, `mensagem`) VALUES
(1, 'NOK2');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `acionamentos_cancelas_rom`
--
ALTER TABLE `acionamentos_cancelas_rom`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `acionamentos_efetuados`
--
ALTER TABLE `acionamentos_efetuados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `baias`
--
ALTER TABLE `baias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `balanca_01`
--
ALTER TABLE `balanca_01`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `balanca_02`
--
ALTER TABLE `balanca_02`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `balanca_03`
--
ALTER TABLE `balanca_03`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `nome_baia`
--
ALTER TABLE `nome_baia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `placa_rom`
--
ALTER TABLE `placa_rom`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `rom`
--
ALTER TABLE `rom`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tela_acesso_rom`
--
ALTER TABLE `tela_acesso_rom`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `acionamentos_cancelas_rom`
--
ALTER TABLE `acionamentos_cancelas_rom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT de tabela `acionamentos_efetuados`
--
ALTER TABLE `acionamentos_efetuados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `baias`
--
ALTER TABLE `baias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `balanca_01`
--
ALTER TABLE `balanca_01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `balanca_02`
--
ALTER TABLE `balanca_02`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `balanca_03`
--
ALTER TABLE `balanca_03`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `nome_baia`
--
ALTER TABLE `nome_baia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `placa_rom`
--
ALTER TABLE `placa_rom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `rom`
--
ALTER TABLE `rom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tela_acesso_rom`
--
ALTER TABLE `tela_acesso_rom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
