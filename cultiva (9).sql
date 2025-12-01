-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2025 às 03:38
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
-- Banco de dados: `cultiva`
--
CREATE DATABASE IF NOT EXISTS `cultiva` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cultiva`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `estado` char(2) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `estado`, `cidade`, `rua`, `cep`, `numero`, `complemento`) VALUES
(8, 'SP', 'São Paulo', 'Avenida Paulista', '01311-925', '1700', 'Andar 15, Conjunto 150'),
(9, 'SP', 'Campinas', 'Rua Barão de Jaguara', '13015-002', '1250', NULL),
(10, 'SP', 'Santos', 'Avenida Ana Costa', '11060-002', '540', 'Torre 3, Apartamento 71'),
(11, 'SP', 'Guarulhos', 'Rodovia Presidente Dutra', '07230-010', '150', 'Galpão Principal'),
(12, 'SP', 'Ribeirão puro', 'Rodovia Presidente Dutra', '33333-333', '234', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `entregas`
--

CREATE TABLE `entregas` (
  `id` int(11) NOT NULL,
  `servico_entrega` tinyint(1) DEFAULT NULL,
  `frete` decimal(10,2) DEFAULT NULL,
  `data_entregue` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `entregas`
--

INSERT INTO `entregas` (`id`, `servico_entrega`, `frete`, `data_entregue`) VALUES
(9, 1, 17.00, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `hortas`
--

CREATE TABLE `hortas` (
  `id` int(11) NOT NULL,
  `nome_horta` varchar(255) DEFAULT NULL,
  `fk_usuario_id` int(11) DEFAULT NULL,
  `frete` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `hortas`
--

INSERT INTO `hortas` (`id`, `nome_horta`, `fk_usuario_id`, `frete`) VALUES
(7, 'Horta da Thaplantando', 5, 12.00),
(8, 'Horta Sol Nascente', 6, 15.00),
(9, 'Horta Raiz Forte', 7, 5.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `caminho` blob DEFAULT NULL,
  `fk_produto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `imagens`
--

INSERT INTO `imagens` (`id`, `caminho`, `fk_produto_id`) VALUES
(8, 0x70726f6475746f732f34506a437a3144766570416e7a4c316e3746526d5973596a63615a526e586f565656644467344b462e6a7067, 9),
(9, 0x70726f6475746f732f63556a4c4676506a32666875756e686c67776b43645939314d436164347551636e417a6c627437332e6a7067, 10),
(10, 0x70726f6475746f732f427358735a50444d32326a556b756f316830497869746d444d62354866324871524836434759306c2e6a7067, 11),
(11, 0x70726f6475746f732f3647525354626a3543707475385967324e767156744f62477769584d4b566d4a6248673356396f442e6a7067, 12),
(12, 0x70726f6475746f732f417135343432624355474c565853714d68396d624f335365633671425573507a7344795a496a30672e6a7067, 13),
(13, 0x70726f6475746f732f625772725951486e58516b68667469436d78354f54514a7248785a39576b5349505139556b3658452e6a7067, 14),
(14, 0x70726f6475746f732f493762475366614431556c624b72397a4b586559414246597a6d65313543444a76684c49316879512e6a7067, 15),
(15, 0x70726f6475746f732f3572533436733050556670516a6871474f7153796c566868675533464734306752326335723373782e6a7067, 16),
(16, 0x70726f6475746f732f314e6f6356586843694342747a7a35306d66417046365532634b567a47697147364c55346c3647302e6a7067, 17),
(17, 0x70726f6475746f732f4a4e48725053786148796633755243397846614137757157634d3169656f70354736315a524831772e6a7067, 18),
(18, 0x70726f6475746f732f59707651516375553031344e414f767a4965596f3870596b674f4278766b5131355245754830776b2e6a7067, 19),
(19, 0x70726f6475746f732f7158424c59366e306d486756715447496d65394a3936446c66325a4759395433333776543342377a2e6a7067, 20),
(20, 0x70726f6475746f732f546f4d596c4776707a6f6649474a4d694f517861494163756c62533673776d594972516b767951372e6a7067, 21),
(21, 0x70726f6475746f732f465531473472703144307a315351694e775239305238644641517857394f706e766474736b7532752e6a7067, 22),
(22, 0x70726f6475746f732f6c4957717979746269496c3736586c4d705a3170666738486973744d436750614e796550586934782e6a7067, 23),
(23, 0x70726f6475746f732f78514d7a463737476f734f78496f695757305431794348316e68497469387153774c4b65464a39492e6a7067, 24);

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_selecionados`
--

CREATE TABLE `itens_selecionados` (
  `fk_produto_id` int(11) DEFAULT NULL,
  `fk_pedido_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `quantidade_item_total` int(11) DEFAULT NULL,
  `preco_item_total` decimal(10,2) DEFAULT NULL,
  `fk_usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `itens_selecionados`
--

INSERT INTO `itens_selecionados` (`fk_produto_id`, `fk_pedido_id`, `id`, `quantidade_item_total`, `preco_item_total`, `fk_usuario_id`) VALUES
(11, 15, 29, 2, 21.00, 8),
(23, 15, 30, 2, 7.60, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2025_10_30_152306_create_endereco_table', 1),
(5, '2025_10_30_152306_create_entrega_table', 1),
(6, '2025_10_30_152306_create_horta_table', 1),
(7, '2025_10_30_152306_create_imagens_table', 1),
(8, '2025_10_30_152306_create_itens_selecionados_table', 1),
(9, '2025_10_30_152306_create_pedido_table', 1),
(10, '2025_10_30_152306_create_produto_table', 1),
(11, '2025_10_30_152306_create_reside_table', 1),
(12, '2025_10_30_152306_create_unidade_medida_table', 1),
(13, '2025_10_30_152306_create_usuario_table', 1),
(14, '2025_10_30_152309_add_foreign_keys_to_horta_table', 1),
(15, '2025_10_30_152309_add_foreign_keys_to_imagens_table', 1),
(16, '2025_10_30_152309_add_foreign_keys_to_itens_selecionados_table', 1),
(17, '2025_10_30_152309_add_foreign_keys_to_pedido_table', 1),
(18, '2025_10_30_152309_add_foreign_keys_to_produto_table', 1),
(19, '2025_10_30_152309_add_foreign_keys_to_reside_table', 1),
(20, '2025_10_31_011335_create_enderecos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `data_hora` datetime DEFAULT NULL,
  `preco_final` decimal(10,2) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `forma_pagamento` varchar(255) DEFAULT NULL,
  `avaliacao` text DEFAULT NULL,
  `fk_entrega_id` int(11) DEFAULT NULL,
  `fk_usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `data_hora`, `preco_final`, `status`, `observacoes`, `forma_pagamento`, `avaliacao`, `fk_entrega_id`, `fk_usuario_id`) VALUES
(15, '2025-11-26 23:36:47', 45.60, 1, NULL, 'Dinheiro', NULL, 9, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(34, 'App\\Models\\User', 5, 'api-token', '8284a5acddbd3a1573a1d2f2d431ac94bb1242891fb0c3dda2126affb7995b01', '[\"*\"]', '2025-11-27 01:32:12', NULL, '2025-11-24 05:43:05', '2025-11-27 01:32:12'),
(35, 'App\\Models\\User', 6, 'api-token', '654949c285dfcc9ea874e08f5ba4d82e10c258e462f93c6c27638803228b84f4', '[\"*\"]', '2025-11-27 01:34:35', NULL, '2025-11-27 01:33:36', '2025-11-27 01:34:35'),
(36, 'App\\Models\\User', 7, 'api-token', 'bb28e79a66d1599ed3442dafae2206fe6473316600241e88dffb2bd44ca9456d', '[\"*\"]', '2025-11-27 01:36:00', NULL, '2025-11-27 01:35:33', '2025-11-27 01:36:00'),
(37, 'App\\Models\\User', 8, 'api-token', '0fcd0f1d59f1dba3f29fb5b16c8dc5220c79df690a3dc45fbbc3cfecf4bac1a1', '[\"*\"]', '2025-11-27 01:44:05', NULL, '2025-11-27 01:36:43', '2025-11-27 01:44:05'),
(38, 'App\\Models\\User', 5, 'api-token', 'fa1c6b06d91379c6d490b46de74f99e87c6b68fe23a06159b1a166b4466eb57d', '[\"*\"]', '2025-11-27 01:48:02', NULL, '2025-11-27 01:44:59', '2025-11-27 01:48:02'),
(39, 'App\\Models\\User', 5, 'api-token', '57a47ad8eb5d7e34eb30e6c1f3c4f8b465ce63816becd9ead9185ad661d7a617', '[\"*\"]', '2025-11-27 01:54:46', NULL, '2025-11-27 01:48:11', '2025-11-27 01:54:46'),
(40, 'App\\Models\\User', 6, 'api-token', '87d431c9438ca86029c6d79abde7d8d0cef4a517d6cf1cb8984fd830d33867e3', '[\"*\"]', '2025-11-27 02:09:49', NULL, '2025-11-27 02:00:25', '2025-11-27 02:09:49'),
(41, 'App\\Models\\User', 7, 'api-token', 'd5c10a69d47e6c49bcea27892238ec68e98333c79aa5a6a6eb2fdb3ae0cb8707', '[\"*\"]', '2025-11-27 02:22:52', NULL, '2025-11-27 02:10:16', '2025-11-27 02:22:52'),
(42, 'App\\Models\\User', 8, 'api-token', 'dd6554b1b816f25c20c9cfd3bf2427b312b0ad584ac61ecce959ddb351b2a05e', '[\"*\"]', '2025-11-27 02:37:27', NULL, '2025-11-27 02:23:22', '2025-11-27 02:37:27'),
(43, 'App\\Models\\User', 5, 'api-token', 'bbf5aea66fc8b0a28fa065169b84eee97d9d12de1023cb912818bd3dd947ef5d', '[\"*\"]', '2025-11-27 02:29:33', NULL, '2025-11-27 02:25:11', '2025-11-27 02:29:33');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `preco_unit` decimal(10,2) DEFAULT NULL,
  `quantidade_estoque` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `validade` date DEFAULT NULL,
  `quant_unit_medida` double DEFAULT NULL,
  `fk_horta_id` int(11) DEFAULT NULL,
  `fk_unidade_medida_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco_unit`, `quantidade_estoque`, `descricao`, `validade`, `quant_unit_medida`, `fk_horta_id`, `fk_unidade_medida_id`) VALUES
(9, 'Milho Doce (Espiga)', 25.00, 200, 'Milho doce colhido e ensacado por unidade, ótimo para churrasco.', '2026-01-10', 1, 7, 5),
(10, 'Alface Crespa Orgânica', 4.99, 120, 'Pé de alface orgânica, fresco e pronto para consumo.', '2025-12-05', 1, 7, 5),
(11, 'Morango Fresco', 10.50, 80, 'Caixa de morangos vermelhos e doces.', '2025-11-30', 250, 7, 2),
(12, 'Tomate Italiano', 6.80, 300, 'Tomate italiano maduro, ideal para molhos e saladas.', '2025-12-15', 1, 7, 1),
(13, 'Ovos Caipiras Grandes', 14.00, 50, 'Ovos caipiras de galinhas livres. Venda por dúzia.', '2026-01-20', 1, 7, 6),
(14, 'Azeite Artesanal (Garrafa)', 35.00, 40, 'Azeite de oliva extra virgem, produzido artesanalmente.', '2027-04-01', 500, 7, 4),
(15, 'Pimentão Amarelo', 3.99, 95, 'Pimentão amarelo doce, excelente para rechear.', '2025-12-08', 1, 7, 5),
(16, 'Batata Doce Roxa', 4.50, 250, 'Batata doce roxa ideal para assar ou cozinhar.', '2026-01-30', 1, 7, 1),
(17, 'Abobrinha Italiana', 5.20, 180, 'Abobrinha fresca, ideal para refogados e massas.', '2026-02-15', 1, 8, 1),
(18, 'Salsinha (Maço)', 2.00, 90, 'Maço grande de salsinha fresca.', '2025-12-01', 1, 8, 5),
(19, 'Limão Taiti', 12.00, 60, 'Limões grandes e suculentos, vendidos por dúzia.', '2026-03-01', 1, 8, 6),
(20, 'Geléia Artesanal de Morango', 22.00, 35, 'Pote de geléia de morango sem conservantes.', '2026-10-01', 300, 8, 2),
(21, 'Pão de Fermentação Natural', 18.90, 50, 'Pão rústico, integral, feito com fermento natural.', '2025-11-30', 1, 9, 5),
(22, 'Suco de Laranja Natural', 8.50, 75, 'Suco natural de laranja, engarrafado em vidro.', '2025-12-10', 1, 9, 3),
(23, 'Cenoura Laranja (kg)', 3.80, 220, 'Cenouras doces e crocantes, vendidas a peso.', '2026-01-20', 1, 9, 1),
(24, 'Pimenta Dedo-de-Moça', 5.00, 45, 'Pacote de pimenta dedo-de-moça fresca e picante.', '2025-12-25', 50, 9, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reside`
--

CREATE TABLE `reside` (
  `fk_usuario_id` int(11) DEFAULT NULL,
  `fk_endereco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `reside`
--

INSERT INTO `reside` (`fk_usuario_id`, `fk_endereco_id`) VALUES
(5, 8),
(6, 9),
(7, 10),
(8, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidade_medida`
--

CREATE TABLE `unidade_medida` (
  `id` int(11) NOT NULL,
  `tipo_medida` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `unidade_medida`
--

INSERT INTO `unidade_medida` (`id`, `tipo_medida`) VALUES
(1, 'kg'),
(2, 'g'),
(3, 'l'),
(4, 'ml'),
(5, 'und'),
(6, 'dz'),
(7, 'cm');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  `banner` blob DEFAULT NULL,
  `Tipo_usuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `nome`, `password`, `telefone`, `datanasc`, `foto`, `banner`, `Tipo_usuario`) VALUES
(5, 'thaisq.abe@gmail.com', 'Thaís petacular', '$2y$12$l4ExJTxKetk9LBo9fv62qeg0px4QVeIxs7dXQq1ZSV1pIJ.9Hs3MS', '(11) 95383-7190', '2009-09-12', 0x666f746f732f6537556330464b57325a6b6b484a53497a3735743347464b776743423165456c71796f75545377692e6a7067, NULL, 'produtor'),
(6, 'produtora.daiana@hortasol.com', 'Daiana Ferreira Lima', '$2y$12$LZrQAvHiGgU9.Z4UxpPNtuIVFsnOg6snYF/pNuRVLHMNmi5ChITZy', '(11) 99555-4455', '1999-05-13', 0x666f746f732f76686c33416b515731754d31596e527676706f30726e6f6f496d69567a71524b6d6339784f4558422e6a7067, NULL, 'produtor'),
(7, 'joao.horta_raiz@exemplo.com', 'João Carlos Menezes', '$2y$12$M9wlnMYYsPfzaE1bIrCC8uDEhBC69utELBAinEVtexQyK/FDtiO66', '(11) 9888-8888', '1989-07-22', 0x666f746f732f4c475a31723673446a4c4b4b434932494d795453594e735237784b497a77465035694431455865652e706e67, NULL, 'produtor'),
(8, 'ana.compradora@exemplo.com.br', 'Ana Beatriz Costa', '$2y$12$TP3866mDNsEN1M9XeZuw4e.VpaF4DTT.3gH9VrzEauWx5F/4TSfQy', '(11) 9565-4656', '2009-07-09', 0x666f746f732f396673736d51494b66636e30324e61666c6a4339536976737947536c6e7a39687032654f446967732e6a7067, NULL, 'consumidor');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `entregas`
--
ALTER TABLE `entregas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `hortas`
--
ALTER TABLE `hortas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_horta_2` (`fk_usuario_id`);

--
-- Índices de tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_imagens_2` (`fk_produto_id`);

--
-- Índices de tabela `itens_selecionados`
--
ALTER TABLE `itens_selecionados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_itens_selecionados_2` (`fk_produto_id`),
  ADD KEY `fk_itens_selecionados_3` (`fk_pedido_id`),
  ADD KEY `fk_usuario_id` (`fk_usuario_id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_2` (`fk_entrega_id`),
  ADD KEY `fk_pedido_3` (`fk_usuario_id`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_2` (`fk_horta_id`),
  ADD KEY `fk_produto_3` (`fk_unidade_medida_id`);

--
-- Índices de tabela `reside`
--
ALTER TABLE `reside`
  ADD KEY `fk_reside_1` (`fk_usuario_id`),
  ADD KEY `fk_reside_2` (`fk_endereco_id`);

--
-- Índices de tabela `unidade_medida`
--
ALTER TABLE `unidade_medida`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `hortas`
--
ALTER TABLE `hortas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `itens_selecionados`
--
ALTER TABLE `itens_selecionados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `unidade_medida`
--
ALTER TABLE `unidade_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `hortas`
--
ALTER TABLE `hortas`
  ADD CONSTRAINT `FK_horta_2` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `imagens`
--
ALTER TABLE `imagens`
  ADD CONSTRAINT `FK_imagens_2` FOREIGN KEY (`fk_produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `itens_selecionados`
--
ALTER TABLE `itens_selecionados`
  ADD CONSTRAINT `FK_itens_selecionados_2` FOREIGN KEY (`fk_produto_id`) REFERENCES `produtos` (`id`),
  ADD CONSTRAINT `FK_itens_selecionados_3` FOREIGN KEY (`fk_pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_pedido_2` FOREIGN KEY (`fk_entrega_id`) REFERENCES `entregas` (`id`),
  ADD CONSTRAINT `FK_pedido_3` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuario` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `FK_produto_2` FOREIGN KEY (`fk_horta_id`) REFERENCES `hortas` (`id`),
  ADD CONSTRAINT `FK_produto_3` FOREIGN KEY (`fk_unidade_medida_id`) REFERENCES `unidade_medida` (`id`);

--
-- Restrições para tabelas `reside`
--
ALTER TABLE `reside`
  ADD CONSTRAINT `FK_reside_1` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_reside_2` FOREIGN KEY (`fk_endereco_id`) REFERENCES `enderecos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
