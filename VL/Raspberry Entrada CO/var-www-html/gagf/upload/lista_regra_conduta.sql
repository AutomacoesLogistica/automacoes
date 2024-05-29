-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 
-- Tempo de geração: 29-Nov-2021 às 12:11
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
-- Banco de dados: `bd_gagf`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_regra_conduta`
--

CREATE TABLE `lista_regra_conduta` (
  `id` int(11) NOT NULL,
  `nome_infracao` varchar(500) NOT NULL,
  `motorista_1_envento` varchar(100) NOT NULL,
  `motorista_2_envento` varchar(100) NOT NULL,
  `motorista_3_envento` varchar(100) NOT NULL,
  `transportadora_1_envento` varchar(100) NOT NULL,
  `transportadora_2_envento` varchar(100) NOT NULL,
  `transportadora_3_envento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_regra_conduta`
--

INSERT INTO `lista_regra_conduta` (`id`, `nome_infracao`, `motorista_1_envento`, `motorista_2_envento`, `motorista_3_envento`, `transportadora_1_envento`, `transportadora_2_envento`, `transportadora_3_envento`) VALUES
(3, 'É proibido proferir agressões físicas a qualquer indivíduo nas vias, interior das minas e usinas;', 'Exclusão da operação', 'Exclusão da operação', 'Exclusão da operação', 'Zerar nota segurança  e bloqueio geral de 3 dias', 'Zerar nota segurança  e bloqueio geral de 3 dias', 'Zerar nota segurança  e bloqueio geral de 3 dias'),
(4, 'É proibido proferir agressões verbais a qualquer indivíduo nas vias, interior das minas e usinas;', '90 dias de suspensão + Treinamento de reciclagem', '90 dias de suspensão + Treinamento de reciclagem', 'Exclusão da operação', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(5, 'É proibido o uso e porte de drogas, álcool e portar armas no interior das minas e usinas Gerdau', 'Exclusão da operação', 'Exclusão da operação', 'Exclusão da operação', 'Perda de 20 pontos na avaliação mensal', 'Zerar nota segurança', 'Zerar nota de segurança e bloqueio geral de carregamento 3 dias.'),
(6, 'É proibido dirigir nas dependências das Minas e Usinas sob efeitos de álcool e drogas', '90 dias de suspensão + Treinamento de reciclagem', '90 dias de suspensão + Treinamento de reciclagem', '90 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Zerar nota segurança', 'Zerar nota de segurança e bloqueio geral de carregamento 3 dias.'),
(7, 'É proibido efetuar retornos indevidos na BR040, é obrigatório utilizar o acesso da BR040 à BR383 para os veículos que necessitam realizar o retorno para a Mina de Miguel Burnier com entrada pela rodovia OP260.', '180 dias de suspensão + 10 dias bloqueio placa', 'Exclusão da operação', 'Exclusão da operação', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias', 'Zerar nota segurança e bloqueio geral 5 dias'),
(8, 'É obrigatório cumprimento integral da Lei 13.103 no tocante a jornada do motorista Art.235C, válidos para motoristas de frota própria, cooperados, agregados e terceiros.', 'Advertência Verbal + Treinamento de reciclagem', '5 dias de suspensão + Treinamento de reciclagem', 'Exclusão da operação', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias', 'Zerar nota segurança e bloqueio geral 5 dias'),
(9, 'É proibido enlonar e desenlonar os veículos fora da área regulamentada. Em Várzea do Lopes (Antes das balanças 1, 3, 4 e 5; Depois da Balança 2; Na saída da mina, próximo as cancelas). Em Miguel Burnier (Perto do container do recebimento de ROM; Saída das balanças 1 e 2; Na área calçada em frente a balança 3).Em caso de excesso, o veículo não deverá enlonar até que seja retirado o material excedente.', '5 dias de suspensão + Treinamento de reciclagem', '10 dias de suspensão + Treinamento de reciclagem', '90 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(10, 'É proibido trafegar pela contramão de direção em toda e qualquer via de circulação no interior das minas e usinas Gerdau, bem como nas vias públicas cuja sinalização proíba esta prática', '20 dias de suspensão + Treinamento de reciclagem', '20 dias de suspensão + Treinamento de reciclagem', '20 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias'),
(11, 'É obrigatório o uso do cinto de segurança durante toda a permanência no interior no veículo, esteja este em movimento ou parado', 'Advertência Verbal + Treinamento de reciclagem', '7 dias de suspensão + Treinamento de reciclagem', '7 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(12, 'É proibido o uso de celular e/ou fones de ouvido ao dirigir. O uso do mesmo só é permitido com o veículo estacionado em local permitido.', 'Advertência Verbal + Treinamento de reciclagem', '10 dias de suspensão + Treinamento de reciclagem', '10 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias'),
(13, 'É obrigatório uso de todos os EPI´s (capacete com julgular, óculos de segurança, colete refletivo, calça, calçado de segurança cobrindo o dorso e calcanhar e luvas ) ao descer do veículo nos locais permitidos com identificação por sinalização.', 'Advertência Verbal + Treinamento de reciclagem', '5 dias de suspensão + Treinamento de reciclagem', '10 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(14, 'É obrigatório permanencia no veículo nos momentos de basculamento, carregamento / descarga, com o cinto de segurança afivelado', '10 dias de suspensão + Treinamento de reciclagem', 'Exclusão da operação', 'Exclusão da operação', 'Perda de 20 pontos na avaliação mensal', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias'),
(15, 'É proibida a retirada de excesso manualmente do veículo dentro da Gerdau Mineração.', 'Advertência Verbal + Treinamento de reciclagem', '7 dias de suspensão + Treinamento de reciclagem', '7 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(16, 'É proibido fornecer ou emprestar TAG\'s para terceiros.', '45 dias de suspensão e 10 bloqueio veículo + Treinamento de reciclagem', 'Exclusão da operação', 'Exclusão da operação', 'Perda de 20 pontos na avaliação mensal', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias'),
(17, 'É proibido manter a báscula levantada nos pátios aguardando carregamento e nas filas de espera.', 'Advertência Verbal + Treinamento de reciclagem', 'Advertência Verbal + Treinamento de reciclagem', 'Advertência Verbal + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(18, 'É obrigatório respeitar a distância de basculamento 12 metros nos pátios da empresa.', '30 dias de suspensão + Treinamento de reciclagem', 'Exclusão da operação', 'Exclusão da operação', 'Perda de 20 pontos na avaliação mensal', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias'),
(19, 'É proibido tentar aliviar o peso das balanças afim de evitar o excesso de carga.', 'Advertência Verbal + Treinamento de reciclagem', '5 dias de suspensão + Treinamento de reciclagem', '10 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(20, 'É proibido sair carregado das Minas sem a tela obrigatória', '7 dias de suspensão + Treinamento de reciclagem', '7 dias de suspensão + Treinamento de reciclagem', '7 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(21, 'É proibido dirigir de forma perigosa dentro das depedências das Minas e Usinas colocando em risco terceiros e próprios.', '20 dias de suspensão + Treinamento de reciclagem', '20 dias de suspensão + Treinamento de reciclagem', '20 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(22, 'É proibido exceder a velocidade regulamentada no local.', 'Até 10% sem suspensção + Treinamento de reciclagem', 'Acima de 10%, 10 dias de suspensão + Treinamento de reciclagem', 'Acima de 20%, 15 dias de suspensão + Treinamento de reciclagem', 'Zerar nota segurança', 'Zerar nota segurança e bloqueio geral 3 dias', 'Zerar nota segurança e bloqueio geral 5 dias'),
(23, 'É proibido realizar necessidades fisiológicas nas vias do interior das minas e usina. Utilizar exclusivamente sanitários disponibilizados para este fim.', '5 dias de suspensão + Treinamento de reciclagem', '5 dias de suspensão + Treinamento de reciclagem', '5 dias de suspensão + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(24, 'É obrigatório utilizar o giroflex em funcionamento em dias de chuva e neblina, bem como manter os faróis acessos durante toda a permanência no interior das minas em respeito a norma regulamentadora NR 22  ítém  22.7.7.1 do Ministério do Trabalho e Emprego. Para o tráfego nas vias públicas, o mesmo deverá ser desligado de acordo com o Código de Trânsito Brasileiro.', 'Advertência Verbal + Treinamento de reciclagem', 'Advertência Verbal + Treinamento de reciclagem', 'Advertência Verbal + Treinamento de reciclagem', 'Perda de 20 pontos na avaliação mensal', 'Perda de 50 pontos na avaliação mensal', 'Zerar nota segurança'),
(25, 'É obrigatório portar check list de préuso diário do veículo em seu interior de acordo com o plano de manutenção', 'Bloqueio até que seja apresentado o Check List + Treinamento de reciclagem', 'Bloqueio até que seja apresentado o Check List + Treinamento de reciclagem', 'Bloqueio até que seja apresentado o Check List + Treinamento de reciclagem', 'Perda de 10 pontos na avaliação mensal ', 'Perda de 20 pontos na avaliação mensal ', 'Perda de 30 pontos na avaliação mensal '),
(26, 'É obrigatório portar Laudo de Inspeção Veícular/Laudo de Vistoria com validade de 30 dias (exceção frota cativa 3 meses) modelo Gerdau realizado por engenheiro mecânico ou mecânico responsável pela empresa devidamente qualificado.', 'Bloqueio até que seja apresentado o Laudo + Treinamento de reciclagem', 'Bloqueio até que seja apresentado o Laudo + Treinamento de reciclagem', 'Bloqueio até que seja apresentado o Laudo + Treinamento de reciclagem', 'Perda de 10 pontos na avaliação mensal ', 'Perda de 20 pontos na avaliação mensal ', 'Perda de 30 pontos na avaliação mensal '),
(27, 'É proibido abandonar o veículo  dentro das dependências da Gerdau sem aviso prévio.', '10 dias de suspensão + Treinamento de reciclagem', ' 10 dias de suspensão + Treinamento de reciclagem', '10 dias de suspensão + Treinamento de reciclagem', 'Perda de 10 pontos na avaliação mensal', 'Perda de 20 pontos na avaliação mensal', 'Perda de 30 pontos na avaliação mensal ');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `lista_regra_conduta`
--
ALTER TABLE `lista_regra_conduta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `lista_regra_conduta`
--
ALTER TABLE `lista_regra_conduta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
