-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2025 às 21:14
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `arcana_games_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos`
--

CREATE TABLE `jogos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `plataforma` varchar(50) DEFAULT NULL,
  `tipo_midia` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `desenvolvedora` varchar(100) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jogos`
--

INSERT INTO `jogos` (`id`, `titulo`, `descricao`, `preco`, `imagem`, `plataforma`, `tipo_midia`, `categoria`, `desenvolvedora`, `banner`) VALUES
(1, 'Demon Slayer - Chronicles 2', NULL, 320.20, './img/Demon_Slayer.png', 'PS5', 'Física', 'AAA', 'CyberConnect2', NULL),
(2, 'Grand Theft Auto V', NULL, 198.90, './img/GrandTheftAutoV.png', 'PS5', 'Física', 'AAA', 'Rockstar Games', './img/carrossel.gtaV.jpg'),
(3, 'FIFA 23', NULL, 149.90, './img/Fifa23Xboxseries.png', 'PS4', 'Física', 'AAA', 'EA Sports', './img/carrossel.fifa.jpeg'),
(4, 'Street Fighter 6', NULL, 96.00, './img/streetfighter6.png', 'PS5', 'Física', 'AAA', 'Capcom', NULL),
(5, 'Assassins Creed Chronicles', NULL, 69.98, './img/Assassinscreed.png', 'PS5', 'Física', 'AAA', 'Ubisoft', NULL),
(6, 'Batman Arkham Knight', NULL, 99.99, './img/Batmanarkhannightxbox.png', 'PS5', 'Física', 'AAA', 'Rocksteady', NULL),
(7, 'Persona 3 Reload', NULL, 269.98, './img/Persona3Reaload.png', 'PS5', 'Física', 'AAA', 'Atlus', './img/p3rbanner.jpg'),
(8, 'Red Dead Redemption 2', NULL, 167.00, './img/RedDead2.png', 'PS5', 'Digital', 'AAA', 'Rockstar Games', NULL),
(9, 'Spider-Man', NULL, 57.95, './img/spider-man2.png', 'PS5', 'Digital', 'AAA', 'Insomniac', NULL),
(10, 'Little Big Planet 3', NULL, 19.99, './img/littlebigplanet3.png', 'PS4', 'Digital', 'AAA', 'Sumo Digital', NULL),
(11, 'Hollow Knight Voidheart', NULL, 19.99, './img/hkv.webp', 'PS5', 'Digital', 'Indie', 'Team Cherry', NULL),
(12, 'Mortal Kombat 11', NULL, 45.00, './img/mortalkombat11.png', 'PS4', 'Digital', 'AAA', 'NetherRealm', NULL),
(13, 'Bully Scholarship Edition', NULL, 121.00, './img/bully_scholarship_edition.png', 'Xbox One', 'Física', 'AAA', 'Rockstar Games', NULL),
(14, 'Forza Horizon 5', NULL, 122.11, './img/forzahorizon5.png', 'Xbox Series', 'Física', 'AAA', 'Playground Games', NULL),
(15, 'FIFA 23 Xbox', NULL, 199.90, './img/Fifa23Xboxseries.png', 'Xbox Series', 'Digital', 'AAA', 'EA Sports', NULL),
(16, 'Forza Horizon 4', NULL, 84.11, './img/forzahorizon4.png', 'Xbox One', 'Digital', 'AAA', 'Playground Games', NULL),
(17, 'Halo 4', NULL, 109.00, './img/Halo4xbox360.png', 'Xbox One', 'Digital', 'AAA', '343 Industries', NULL),
(18, 'Super Mario Odyssey', NULL, 249.00, './img/Supermarioodyssey.png', 'Switch', 'Física', 'AAA', 'Nintendo', NULL),
(19, 'Zelda Breath of the Wild', NULL, 155.00, './img/Zeldanintendo.png', 'Switch', 'Física', 'AAA', 'Nintendo', NULL),
(20, 'Donkey Kong Country', NULL, 116.34, './img/donkeykong.png', 'Switch', 'Digital', 'AAA', 'Retro Studios', NULL),
(21, 'Stardew Valley', NULL, 24.99, './img/stardew_valley.png', 'Xbox Series', 'Digital', 'Indie', 'ConcernedApe', NULL),
(22, 'Cuphead', NULL, 36.99, './img/Cuphead.png', 'Xbox Series', 'Digital', 'Indie', 'Studio MDHR', NULL),
(23, 'Hollow Knight Silksong', NULL, 59.99, './img/HollowKnightSilksong.png', 'PC', 'Digital', 'Indie', 'Team Cherry', NULL),
(24, 'Undertale', NULL, 19.99, './img/undertale.png', 'PC', 'Digital', 'Indie', 'Toby Fox', NULL),
(25, 'Terraria', NULL, 32.99, './img/Terraria.png', 'PC', 'Digital', 'Indie', 'Re-Logic', NULL),
(26, 'Binding of Isaac', NULL, 27.99, './img/isaac.png', 'PC', 'Digital', 'Indie', 'Nicalis', NULL),
(27, 'Inscryption', 'Uma sombria odisseia pavimentada por cartas', 49.50, './img/inscryption.jpg', 'Switch', 'Física', 'Indie', 'Daniel Mullins Games', NULL),
(28, 'Persona 4 Golden', 'Aventuras inesquecíveis envolvendo vínculos sociais e exploração', 104.90, './img/p4g.jpg', 'PS5', 'Física', 'AAA', 'Atlus', NULL),
(29, 'Pro Evolution Soccer 2021 Season Update', 'Aclamado jogo de futebol da fraquina PES (Pro Evolution Soccer)', 199.90, './img/pes21.jpg', 'Xbox Series', 'Física', 'AAA', 'KONAMI', NULL),
(30, 'Another Crab’s Treasure', 'Souls-like” subaquático onde o personagem principal é um caranguejo (“crab”)', 199.90, './img/ACT.jpeg', 'Xbox Series', 'Digital', 'AAA', 'Aggro Crab', NULL),
(31, 'Super Mario Bros. Wonder', 'Bem-vindos ao Reino Flor! Mario e seus amigos foram convidados para visitar o colorido Reino Flor, um lugar não muito distante do Reino Cogumelo.', 339.90, './img/SMW.jpg', 'Switch', 'Física', 'AAA', 'Nintendo', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `data_compra` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_nome`, `cpf`, `endereco`, `cep`, `valor_total`, `data_compra`) VALUES
(1, 'Murillo', '43140088869', 'Rua Edoardo Bizzarri, 158', '04771-060', 0.00, '2025-11-21 12:07:04'),
(2, 'Murillo', '43140088869', 'Rua Edoardo Bizzarri, 158', '04771-060', 199.90, '2025-11-21 17:11:13');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`) VALUES
(1, 'Murillo Gomes Denadai', 'lillogodai@gmail.com', '$2y$10$gKEqf89F0HX8JvmL7btjJ.ilBrDYJgflPj2n07YNFCs4WAovDe0M.', '2025-11-21 11:48:51'),
(2, 'Murillo Gomes Denadai', 'imenso@gmail', '$2y$10$S3LEgpuVx8vrzBN9dy5BA.51qmoVXwRFnU6KOWU20V6R61hkDPrOm', '2025-11-21 14:34:45');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `jogos`
--
ALTER TABLE `jogos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
