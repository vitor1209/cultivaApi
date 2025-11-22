-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/11/2025 às 15:30
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
(1, 'SP', 'São Paulo', 'Avenida Brasil', '01000-000', '1500-A', 'Bloco A, Apartamento 101');

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
(1, 1, 15.00, NULL),
(2, 1, 27.00, NULL);

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
(1, 'Horta da Carlacomce', 1, 15.00),
(5, 'thais', 3, 12.00);

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
(1, 0x646b666e62696566626e6f696574, NULL),
(2, 0x70726f6475746f732f65437873634d4e32684a316b706f7a67333974514346424a32493834504f356c4b4c39426c6134562e706e67, 3),
(3, 0x70726f6475746f732f77446a6a7030514869755565434f464274764d4975526162325271634643597a6a436d7a663268302e706e67, 4),
(4, 0x70726f6475746f732f4242443866736258696c436c5736594f4146416f5245794d59747559754c46357330596a574c5a4f2e706e67, 5),
(5, 0x70726f6475746f732f7971585870506c676f4846416f524c38513348647341434e42634e4254533944416358346f47364e2e706e67, 6);

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
(1, 3, 1, 3, 41.70, NULL),
(1, 4, 2, 3, 41.70, NULL),
(1, 5, 3, 3, 41.70, NULL),
(1, 6, 4, 2, 27.80, NULL),
(1, NULL, 5, 3, 41.70, NULL),
(1, NULL, 6, 3, 41.70, NULL),
(1, NULL, 7, 3, 41.70, NULL),
(1, NULL, 8, 3, 41.70, NULL),
(1, 7, 9, 3, 41.70, 2),
(1, 8, 10, 3, 41.70, 2),
(6, 8, 11, 3, 30.00, 2);

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
(1, '2025-11-15 23:40:47', NULL, 1, NULL, NULL, NULL, NULL, 2),
(2, '2025-11-15 23:43:30', NULL, 1, NULL, NULL, NULL, NULL, 2),
(3, '2025-11-15 23:45:02', 41.70, 1, NULL, NULL, NULL, NULL, 2),
(4, '2025-11-15 23:45:25', 41.70, 1, NULL, NULL, NULL, NULL, 2),
(5, '2025-11-15 23:45:48', 41.70, 1, NULL, NULL, NULL, NULL, 2),
(6, '2025-11-16 01:55:13', 27.80, 1, NULL, NULL, NULL, NULL, 2),
(7, '2025-11-20 17:25:04', 56.70, 1, NULL, 'pix', NULL, 1, 2),
(8, '2025-11-21 21:11:22', 98.70, 1, NULL, 'cartao', NULL, 2, 2);

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
(1, 'App\\Models\\User', 1, 'api-token', 'bec08f943940ecec72b43ef7828286fa0882fccdedbd40c357094291e786cf21', '[\"*\"]', NULL, NULL, '2025-11-02 04:52:57', '2025-11-02 04:52:57'),
(2, 'App\\Models\\User', 1, 'api-token', '0dfcf7fb629cf2439b2f9bcc17bff5785b4d8f972e36e312e42bdf0e395ad8e5', '[\"*\"]', '2025-11-02 04:57:26', NULL, '2025-11-02 04:53:23', '2025-11-02 04:57:26'),
(3, 'App\\Models\\User', 2, 'api-token', 'f9c650f8d32240d9ddb54fd7948a24390e9765dc626c811fd866a28f9759c1ce', '[\"*\"]', NULL, NULL, '2025-11-02 05:02:37', '2025-11-02 05:02:37'),
(4, 'App\\Models\\User', 2, 'api-token', '0677d176d1391480fa957204a8dddb941150b52a48eac78dc314ab941b0c46d0', '[\"*\"]', '2025-11-02 05:38:12', NULL, '2025-11-02 05:02:55', '2025-11-02 05:38:12'),
(5, 'App\\Models\\User', 1, 'api-token', '300207fb620bd2e0adb74206d94077e8a433ece75373844a46b9bba3cf24e4cd', '[\"*\"]', '2025-11-04 20:35:23', NULL, '2025-11-02 05:43:27', '2025-11-04 20:35:23'),
(6, 'App\\Models\\User', 1, 'api-token', '58bbc4f6b347afd3009213a5740ae06877a6a7002c8749dff98f076964429ebe', '[\"*\"]', '2025-11-06 19:25:38', NULL, '2025-11-04 20:56:40', '2025-11-06 19:25:38'),
(7, 'App\\Models\\User', 2, 'api-token', '5e0bf3fa561e8a90ed9d5c52bbcbef290f76be6d6135e7d4ae95437f1248c157', '[\"*\"]', '2025-11-16 04:55:13', NULL, '2025-11-16 02:29:02', '2025-11-16 04:55:13'),
(8, 'App\\Models\\User', 3, 'api-token', 'fedbaebdd5631933d9e1d4829e2f5dd665f789f5d0bc8c94ccf703bc1c505ac0', '[\"*\"]', NULL, NULL, '2025-11-19 04:05:11', '2025-11-19 04:05:11'),
(9, 'App\\Models\\User', 3, 'api-token', '18f630444355bc4db1aa12c91319546e3c4ae77ece5e651088c92f385510b138', '[\"*\"]', NULL, NULL, '2025-11-19 04:06:30', '2025-11-19 04:06:30'),
(10, 'App\\Models\\User', 2, 'api-token', '69fbda94559f416b3eedfc0c54898431d5052d075ea5f5110191d7620ad993c4', '[\"*\"]', '2025-11-20 20:25:04', NULL, '2025-11-20 18:02:48', '2025-11-20 20:25:04'),
(11, 'App\\Models\\User', 3, 'api-token', '755fc008482ad35b50fe37f970a0167b5ace6fc028c6b439ac29bf4eac386a44', '[\"*\"]', '2025-11-21 00:53:03', NULL, '2025-11-20 19:36:54', '2025-11-21 00:53:03'),
(12, 'App\\Models\\User', 3, 'api-token', 'b6e79adc053111bbf865559e948809151b1d7725dfd352e5f210712d02acef22', '[\"*\"]', '2025-11-21 01:04:29', NULL, '2025-11-21 00:55:31', '2025-11-21 01:04:29'),
(13, 'App\\Models\\User', 3, 'api-token', 'c1599a41c7978ebc32e04370be3dbcbd6e59262185dd2f3a50e96cffa43c82bf', '[\"*\"]', NULL, NULL, '2025-11-21 14:12:43', '2025-11-21 14:12:43'),
(14, 'App\\Models\\User', 3, 'api-token', '587d0129896cd1956f31d16ad61a2da3ed0d013d1acf0a5238f130aeec484c9e', '[\"*\"]', '2025-11-21 15:49:18', NULL, '2025-11-21 14:12:44', '2025-11-21 15:49:18'),
(15, 'App\\Models\\User', 3, 'api-token', '79adf99bc1f3031c437100bf142e70ab4f68469d2b58a35de42151e73d9a4778', '[\"*\"]', '2025-11-21 17:23:12', NULL, '2025-11-21 17:01:42', '2025-11-21 17:23:12'),
(16, 'App\\Models\\User', 3, 'api-token', 'c74b496c6203e999bd49c3a378b3306f86ae47c09a31cff04ac9eb4e301b301b', '[\"*\"]', '2025-11-21 17:43:32', NULL, '2025-11-21 17:24:11', '2025-11-21 17:43:32'),
(17, 'App\\Models\\User', 2, 'api-token', '49c06cff056cc9344f0729b616af323aca76c228a2bbe6678e1fcffc26ea1d56', '[\"*\"]', '2025-11-21 17:48:55', NULL, '2025-11-21 17:44:34', '2025-11-21 17:48:55'),
(18, 'App\\Models\\User', 3, 'api-token', 'a65196a46bb4ad2a3c67ca9fe6b4891022aaf5ff3c3e802edcc8f0aab3a84612', '[\"*\"]', '2025-11-21 18:39:06', NULL, '2025-11-21 17:58:13', '2025-11-21 18:39:06'),
(19, 'App\\Models\\User', 2, 'api-token', '613867b65b7c45b324ef039b165bb7092a641b9cf23638aaeb33bc516e6adca6', '[\"*\"]', '2025-11-22 00:11:22', NULL, '2025-11-22 00:07:39', '2025-11-22 00:11:22');

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
(1, 'Tomate Cereja Orgânico', 13.90, 45, 'Tomate cereja fresco, cultivado sem pesticidas. Ideal para saladas e petiscos.', '2026-03-15', 200, 1, 1),
(3, 'Produto Teste', 10.00, 50, 'descricao', '2025-12-31', 2, 1, 2),
(4, 'Produto Teste', 10.00, 50, 'descricao', '2025-12-31', 2, 1, 2),
(5, 'kdnvw', 10.00, 50, 'descricao', '2025-12-31', 2, 1, 2),
(6, 'isdcsdcsdcsdcwgbv', 10.00, 50, 'descricao', '2025-12-31', 2, 5, 2);

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
(1, 1);

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
  `foto` text DEFAULT NULL,
  `banner` text DEFAULT NULL,
  `Tipo_usuario` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `nome`, `password`, `telefone`, `datanasc`, `foto`, `banner`, `Tipo_usuario`) VALUES
(1, 'carla.hortaorganica@exemplo.com.br', 'Carla Teixeira', '$2y$12$nPSwlJ3xMVep1sgZFT9Qweq6ZH2I2cBhnZq2iL/FgM4DLsuQeoXMy', '5521998765432', '1995-02-14', 'uploads/usuarios/produtor_carla.webp', 'uploads/banners/horta_carla_vista_aerea.jpg', 'produtor'),
(2, 'pedro.santos.cliente@exemplo.com', 'Pedro Henrique Santos', '$2y$12$4gqvmUGpSlMrZY/Xrh8QEekNE65BmL7/5ZQh0OnY0/dPL.V95M6Nu', '5521991234567', '1998-08-25', NULL, NULL, 'consumidor'),
(3, 'thaisq.abe@gmail.com', 'Thaís Abe', '$2y$12$6xBDk4yYAiLm6FxdAors1.SXaCMXIzzobOUTy2M0UZbU1tQXnucNS', '1199999999', '2008-07-22', NULL, NULL, 'produtor');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `hortas`
--
ALTER TABLE `hortas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `itens_selecionados`
--
ALTER TABLE `itens_selecionados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `unidade_medida`
--
ALTER TABLE `unidade_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
