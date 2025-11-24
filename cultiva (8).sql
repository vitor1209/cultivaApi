-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2025 às 06:20
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `caminho` blob DEFAULT NULL,
  `fk_produto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `reside`
--

CREATE TABLE `reside` (
  `fk_usuario_id` int(11) DEFAULT NULL,
  `fk_endereco_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `entregas`
--
ALTER TABLE `entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `hortas`
--
ALTER TABLE `hortas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `itens_selecionados`
--
ALTER TABLE `itens_selecionados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `unidade_medida`
--
ALTER TABLE `unidade_medida`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
